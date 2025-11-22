<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Berita;
use App\Models\SiteSetting;

class GuestController extends Controller
{
    public function index()
    {
        // Ambil 6 galeri terbaru
        $latestGalleries = Gallery::latest()->take(6)->get();

        return view('guest.beranda', compact('latestGalleries'));
    }

    public function home() {
        // Ambil data terbaru untuk masing-masing section dengan likes dan comments count
        $latestGalleries = Gallery::withCount(['likes', 'comments'])
            ->latest()
            ->take(8)
            ->get();
        $latestBeritas = Berita::latest()->take(3)->get();

        // Ambil data pengaturan situs
        $siteSettings = SiteSetting::first();
        
        // Kirim data ke view guest.beranda (single page)
        return view('guest.beranda', compact(
            'latestGalleries',
            'latestBeritas',
            'siteSettings'
        ));
    }

    public function profil() {
        return view('guest.profil');
    }

    public function berita() {
         $beritas = Berita::latest()->paginate(10); // atau ->get()
    return view('guest.berita', compact('beritas'));
    }

    public function showBerita($id){
        $berita = Berita::findOrFail($id);
        return view('guest.berita-show', compact('berita'));
    }


    public function kategori($id)
{
    $category = \App\Models\Category::findOrFail($id);
    $galleries = $category->galleries()->latest()->paginate(12); // pastikan relasi ada

    $categories = \App\Models\Category::all(); // untuk daftar kategori di atas

    return view('guest.galeri.index', compact('category', 'galleries', 'categories'));
}


    public function galeri() {
        $galleries = Gallery::latest()->paginate(12);
    return view('guest.galeri', compact('galleries'));
    }

    public function kontak() {
        return view('guest.kontak');
    }

    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));

        // Shortcut untuk kata kunci tertentu -> redirect ke halaman utama terkait
        if ($query !== '') {
            $lower = mb_strtolower($query, 'UTF-8');

            if (in_array($lower, ['galeri', 'gallery', 'galery', 'galeri foto'])) {
                return redirect()->route('guest.galeri');
            }

            if (in_array($lower, ['berita', 'news'])) {
                return redirect()->route('guest.berita');
            }

            if (in_array($lower, ['profil', 'profile', 'tentang', 'tentang kami'])) {
                return redirect()->route('guest.profil');
            }

            if (in_array($lower, ['kontak', 'contact', 'hubungi', 'hubungi kami'])) {
                return redirect()->route('guest.kontak');
            }

            if (in_array($lower, ['home', 'beranda', 'smkn 4', 'smkn4'])) {
                return redirect()->route('guest.home');
            }
        }

        $beritaResults = collect();
        $galleryResults = collect();

        if ($query !== '') {
            $beritaResults = Berita::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->latest()
                ->take(10)
                ->get();

            $galleryResults = Gallery::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->latest()
                ->take(12)
                ->get();
        }

        return view('guest.search', [
            'query' => $query,
            'beritaResults' => $beritaResults,
            'galleryResults' => $galleryResults,
        ]);
    }
}
