<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestGalleryController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryLikeController;
use App\Http\Controllers\GalleryCommentController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;

// Guest/Home
Route::get('/', [GuestController::class, 'home'])->name('guest.home');
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');
Route::get('/berita', [GuestController::class, 'berita'])->name('guest.berita');
Route::get('/berita/{id}', [GuestController::class, 'showBerita'])->name('guest.berita.show'); // detail
Route::get('/profil', [GuestController::class, 'profil'])->name('guest.profil');
Route::get('/galeri', [GuestGalleryController::class, 'index'])->name('guest.galeri');
Route::get('/galeri/{id}', [GuestGalleryController::class, 'show'])->name('guest.galeri.show');
Route::get('/galeri/{id}/download', [GuestGalleryController::class, 'download'])->name('guest.galeri.download');
Route::get('/kategori/{id}', [GuestGalleryController::class, 'kategori'])->name('guest.kategori.show');
Route::get('/kontak', [GuestController::class, 'kontak'])->name('guest.kontak');
Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');

// Gallery Comments - Public (dapat diakses tanpa login)
Route::get('/gallery/{gallery}/comments', [GalleryCommentController::class, 'index'])->name('gallery.comments.index');
Route::post('/gallery/{gallery}/comments/guest', [GalleryCommentController::class, 'storeGuest'])->name('gallery.comments.guest');

// Gallery Likes - Public (Guest can like)
Route::post('/gallery/{gallery}/like', [GalleryLikeController::class, 'toggleLike'])->name('gallery.like.toggle');
Route::get('/gallery/{gallery}/likes', [GalleryLikeController::class, 'getLikes'])->name('gallery.likes');

// Like dan Comment Routes (memerlukan autentikasi)
Route::middleware('auth')->group(function() {
    // Gallery Comments (Authenticated)
    Route::post('/gallery/{gallery}/comments', [GalleryCommentController::class, 'store'])->name('gallery.comments.store');
    Route::delete('/comments/{comment}', [GalleryCommentController::class, 'destroy'])->name('gallery.comments.destroy');
    
    // Admin: Manage Comments
    Route::get('/admin/comments', [GalleryCommentController::class, 'adminIndex'])->name('admin.comments.index');
});

// Admin (dashboard & CRUD)
Route::middleware(['auth', 'verified', PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Site Settings
    Route::prefix('admin/settings')->name('admin.settings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SiteSettingController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('update');
    });

    Route::resource('galleries', GalleryController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('beritas', BeritaController::class);
    Route::resource('visitss', VisitController::class);

    // Petugas (Admin)
    Route::resource('admin/petugas', AdminPetugasController::class)->names('admin.petugas');
    Route::get('/petugas', [AdminPetugasController::class, 'index'])->name('petugas.index');
    Route::post('admin/petugas/{id}/approve', [AdminPetugasController::class, 'approveUser'])->name('admin.petugas.approve');
    Route::post('admin/petugas/{id}/reject', [AdminPetugasController::class, 'rejectUser'])->name('admin.petugas.reject');

    
    // Admin: Manage Gallery Comments
    Route::get('/galleries-comments', function() { return view('galleries.comments'); })->name('galleries.comments');

    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
    Route::get('/admin/visitor-stats', [\App\Http\Controllers\DashboardController::class, 'getVisitorStats'])
        ->name('admin.visitor.stats');
});

require __DIR__.'/auth.php';

