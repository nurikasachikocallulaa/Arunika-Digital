
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Berita;
use App\Models\Announcement;
use App\Models\Agenda;

class GuestHomeController extends Controller
{
    public function index()
    {
        // Ambil data terbaru untuk masing-masing section
        $latestGalleries = Gallery::latest()->take(8)->get();
        $latestBeritas = Berita::latest()->take(3)->get();
        $latestAnnouncements = Announcement::latest()->take(3)->get();
        $latestAgendas = Agenda::latest()->take(3)->get();

        // Kirim data ke view guest.home
        return view('guest.home', compact(
            'latestGalleries',
            'latestBeritas',
            'latestAnnouncements',
            'latestAgendas'
        ));
    }
}
