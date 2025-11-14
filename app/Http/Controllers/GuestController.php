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
}
