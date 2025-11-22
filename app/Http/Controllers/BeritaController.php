<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('beritas.index', compact('beritas'));
    }
    
    public function show(Berita $berita)
    {
        return view('beritas.show', compact('berita'));
    }

    public function create()
    {
        return view('beritas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'required|image',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('beritas', 'public');
            }

            $berita = Berita::create($validated);

            return redirect()->route('beritas.index')
                            ->with('success', 'Berita berhasil ditambahkan!');
                            
        } catch (\Exception $e) {
            \Log::error('Error creating berita: ' . $e->getMessage());
            return back()->withInput()
                        ->with('error', 'Gagal menambahkan berita. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('beritas.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        try {
            $berita = Berita::findOrFail($id);
            
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'nullable|image',
                'remove_image' => 'sometimes|boolean'
            ], [
                'title.required' => 'Judul berita harus diisi',
                'content.required' => 'Konten berita harus diisi',
                'image.image' => 'File harus berupa gambar',
            ]);

            // Handle image removal if requested
            if ($request->has('remove_image') && $request->remove_image) {
                if ($berita->image) {
                    \Storage::delete('public/' . $berita->image);
                    $data['image'] = null;
                }
            } 
            // Handle new image upload
            elseif ($request->hasFile('image')) {
                // Delete old image if exists
                if ($berita->image) {
                    \Storage::delete('public/' . $berita->image);
                }
                $data['image'] = $request->file('image')->store('beritas', 'public');
            }

            $berita->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $data['image'] ?? $berita->image
            ]);

            return redirect()->route('beritas.index')
                            ->with('success', 'Berita berhasil diupdate!');
                            
        } catch (\Exception $e) {
            \Log::error('Error updating berita: ' . $e->getMessage());
            return back()->withInput()
                        ->with('error', 'Gagal mengupdate berita. Silakan coba lagi.');
        }
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('beritas.index')->with('success','Berita berhasil dihapus!');
    }
}
