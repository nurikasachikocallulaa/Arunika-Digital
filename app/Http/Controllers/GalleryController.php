<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    // Tampilkan semua galeri
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('galleries.index', compact('galleries'));
    }

    // Form tambah galeri
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('galleries.create', compact('categories'));
    }

    // Simpan galeri baru
    public function store(Request $request)
    {
        try {
            // Log request info
            \Log::info('Gallery upload attempt', [
                'has_file' => $request->hasFile('image'),
                'file_size' => $request->hasFile('image') ? $request->file('image')->getSize() : 0,
                'file_mime' => $request->hasFile('image') ? $request->file('image')->getMimeType() : null,
            ]);

            $data = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:15360',
            ]);

            // Check if file exists
            if (!$request->hasFile('image')) {
                \Log::error('Gallery upload: No file in request');
                return back()->withErrors(['image' => 'File gambar tidak ditemukan.'])->withInput();
            }

            $file = $request->file('image');

            // Check if file is valid
            if (!$file->isValid()) {
                $errorCode = $file->getError();
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'File terlalu besar (melebihi upload_max_filesize di php.ini)',
                    UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (melebihi MAX_FILE_SIZE di form)',
                    UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
                    UPLOAD_ERR_NO_FILE => 'Tidak ada file yang diupload',
                    UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary tidak ditemukan',
                    UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk',
                    UPLOAD_ERR_EXTENSION => 'Upload dihentikan oleh PHP extension',
                ];
                
                $errorMsg = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : 'Unknown error code: ' . $errorCode;
                
                \Log::error('Gallery upload: Invalid file', [
                    'error_code' => $errorCode,
                    'error_message' => $errorMsg,
                    'file_size' => $file->getSize(),
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                    'post_max_size' => ini_get('post_max_size'),
                ]);
                
                return back()->withErrors(['image' => 'Upload gagal: ' . $errorMsg . ' (Error code: ' . $errorCode . ')'])->withInput();
            }

            // Check storage path exists
            $storagePath = storage_path('app/public/galleries');
            if (!file_exists($storagePath)) {
                \Log::info('Creating galleries directory: ' . $storagePath);
                mkdir($storagePath, 0755, true);
            }

            // Store the image
            try {
                $imagePath = $file->store('galleries', 'public');
                \Log::info('Gallery upload: File stored', ['path' => $imagePath]);
            } catch (\Exception $storeException) {
                \Log::error('Gallery upload: Store failed', [
                    'error' => $storeException->getMessage(),
                    'trace' => $storeException->getTraceAsString()
                ]);
                return back()->withErrors(['image' => 'Gagal menyimpan gambar: ' . $storeException->getMessage()])->withInput();
            }
            
            if (!$imagePath) {
                \Log::error('Gallery upload: Store returned false');
                return back()->withErrors(['image' => 'Gagal menyimpan gambar. Periksa permission folder storage.'])->withInput();
            }

            $data['image'] = $imagePath;

            Gallery::create($data);

            \Log::info('Gallery created successfully', ['image' => $imagePath]);
            return redirect()->route('galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Gallery upload: Validation failed', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Gallery upload error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['image' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // Form edit galeri
    public function edit(Gallery $gallery)
    {
        $categories = \App\Models\Category::all();
        return view('galleries.edit', compact('gallery', 'categories'));
    }

    // Simpan perubahan galeri
    public function update(Request $request, Gallery $gallery)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360'
            ]);

            if ($request->hasFile('image')) {
                // Check if file is valid
                if (!$request->file('image')->isValid()) {
                    return back()->withErrors(['image' => 'File gambar tidak valid atau corrupt.'])->withInput();
                }

                // Delete old image
                if ($gallery->image && \Storage::disk('public')->exists($gallery->image)) {
                    \Storage::disk('public')->delete($gallery->image);
                }
                
                // Store new image
                $imagePath = $request->file('image')->store('galleries', 'public');
                
                if (!$imagePath) {
                    return back()->withErrors(['image' => 'Gagal menyimpan gambar. Periksa permission folder storage.'])->withInput();
                }
                
                $data['image'] = $imagePath;
            }

            $gallery->update($data);

            return redirect()->route('galleries.index')->with('success', 'Galeri berhasil diupdate!');
            
        } catch (\Exception $e) {
            \Log::error('Gallery update error: ' . $e->getMessage());
            return back()->withErrors(['image' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // Hapus galeri
    public function destroy(Gallery $gallery)
    {
        if($gallery->image && \Storage::disk('public')->exists($gallery->image)){
            \Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('galleries.index')->with('success','Galeri berhasil dihapus!');
    }

    // Detail galeri (opsional)
    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }
}
