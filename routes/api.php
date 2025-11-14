<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestGalleryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API Routes (No Authentication Required)
Route::prefix('v1')->group(function () {
    
    // Gallery API Routes - using GuestController and GuestGalleryController
    Route::get('/galleries', [GuestGalleryController::class, 'index']);
    Route::get('/galleries/{id}', [GuestController::class, 'galeri']);
    Route::get('/categories/{id}/galleries', [GuestGalleryController::class, 'kategori']);
    
    // Category API Routes - using CategoryController
    Route::get('/categories', [CategoryController::class, 'index']);
    
    // Berita (News) API Routes - using GuestController
    Route::get('/berita', [GuestController::class, 'berita']);
    Route::get('/berita/{id}', [GuestController::class, 'showBerita']);
    
    // Pengumuman (Announcements) API Routes - using GuestController
    Route::get('/pengumuman', [GuestController::class, 'pengumuman']);
    Route::get('/pengumuman/{id}', [GuestController::class, 'showPengumuman']);
    
    // Agenda API Routes - using GuestController
    Route::get('/agenda', [GuestController::class, 'agenda']);
    Route::get('/agenda/{id}', [GuestController::class, 'showAgenda']);
    
    // Profile API Routes - using GuestController
    Route::get('/profil', [GuestController::class, 'profil']);
    
    // Home API Route - using GuestController
    Route::get('/home', [GuestController::class, 'home']);
});

// Protected API Routes (Authentication Required) - using existing controllers
Route::middleware(['auth:sanctum'])->prefix('v1/admin')->group(function () {
    
    // Gallery Management - using GalleryController
    Route::apiResource('galleries', GalleryController::class);
    
    // Category Management - using CategoryController
    Route::apiResource('categories', CategoryController::class);
    
    // Berita Management - using BeritaController
    Route::apiResource('berita', BeritaController::class);
    
    // Pengumuman Management - using PengumumanController
    Route::apiResource('pengumuman', PengumumanController::class);
    
    // Agenda Management - using AgendaController
    Route::apiResource('agenda', AgendaController::class);
});
