@extends('layouts.admin_new')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@push('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .gradient-text {
        background: linear-gradient(90deg, #4F46E5 0%, #7C3AED 50%, #EC4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endpush

@section('content')

<!-- Welcome Section -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-white">Selamat Datang, Admin</h2>
                <p class="text-blue-100 text-sm">Selamat datang kembali di Dashboard Admin</p>
            </div>
            <div class="flex items-center space-x-2 bg-white/20 px-3 py-1 rounded-full">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <span class="text-xs font-medium text-white">Status: Online</span>
            </div>
        </div>
    </div>
    
    <!-- Content -->
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- User Info Card -->
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Admin</p>
                        <p class="text-sm font-semibold text-gray-800">Administrator</p>
                    </div>
                </div>
            </div>
            
            <!-- Date Card -->
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Hari Ini</p>
                        <p class="text-sm font-semibold text-gray-800">{{ date('l, d F Y') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Time Card -->
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Jam</p>
                        <p class="text-sm font-semibold text-gray-800" id="current-time">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Overview -->
<div class="mb-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-gray-800">Ringkasan Statistik</h2>
            <p class="text-gray-500 text-sm">Data terbaru dan ringkasan aktivitas sistem</p>
        </div>
        <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span>Diperbarui: <span class="font-medium text-gray-700">Baru saja</span></span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card Galeri -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 hover:border-indigo-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-gradient-to-b from-blue-500 to-indigo-600"></div>
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Galeri</p>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">
                        {{ \App\Models\Gallery::count() }}
                    </h3>
                    <p class="text-sm text-gray-500">Foto tersimpan</p>
                </div>
                <div class="bg-blue-50 text-blue-600 p-3 rounded-xl group-hover:bg-blue-100 transition-colors ml-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-500">Status</span>
                <div class="flex items-center space-x-1.5 bg-green-50 text-green-600 text-xs font-medium px-2 py-1 rounded-full">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                    <span>Aktif</span>
                </div>
            </div>
        </div>

        <!-- Card Admin -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 hover:border-purple-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-gradient-to-b from-purple-500 to-fuchsia-600"></div>
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full flex-shrink-0"></div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Admin</p>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">
                        {{ \App\Models\User::count() }}
                    </h3>
                    <p class="text-sm text-gray-500">Pengguna terdaftar</p>
                </div>
                <div class="bg-purple-50 text-purple-600 p-3 rounded-xl group-hover:bg-purple-100 transition-colors ml-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-500">Status</span>
                <div class="flex items-center space-x-1.5 bg-green-50 text-green-600 text-xs font-medium px-2 py-1 rounded-full">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                    <span>Online</span>
                </div>
            </div>
        </div>

        <!-- Card Kategori -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 hover:border-emerald-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-gradient-to-b from-emerald-500 to-teal-600"></div>
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full flex-shrink-0"></div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</p>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">
                        {{ \App\Models\Category::count() }}
                    </h3>
                    <p class="text-sm text-gray-500">Klasifikasi tersedia</p>
                </div>
                <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl group-hover:bg-emerald-100 transition-colors ml-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-500">Status</span>
                <div class="flex items-center space-x-1.5 bg-emerald-50 text-emerald-600 text-xs font-medium px-2 py-1 rounded-full">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span>Tersedia</span>
                </div>
            </div>
        </div>

        <!-- Card Total Konten -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 hover:border-amber-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-gradient-to-b from-amber-500 to-orange-600"></div>
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-3">
                        <div class="w-2 h-2 bg-amber-500 rounded-full flex-shrink-0"></div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Konten</p>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">
                        {{ \App\Models\Berita::count() }}
                    </h3>
                    <p class="text-sm text-gray-500">Publikasi aktif</p>
                </div>
                <div class="bg-amber-50 text-amber-600 p-3 rounded-xl group-hover:bg-amber-100 transition-colors ml-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-500">Status</span>
                <div class="flex items-center space-x-1.5 bg-amber-50 text-amber-600 text-xs font-medium px-2 py-1 rounded-full">
                    <div class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></div>
                    <span>Terbaru</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Section (Full Width) -->
<div class="mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-600 p-3 rounded-2xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Galeri Terbaru</h2>
                            <p class="text-gray-600 text-sm mt-1">{{ \App\Models\Gallery::count() }} foto tersimpan dalam sistem</p>
                        </div>
                    </div>
                    <a href="{{ route('galleries.create') }}"
                       class="bg-blue-600 text-white px-6 py-3 rounded-xl shadow-sm hover:bg-blue-700 transition-all duration-200 hover:shadow-md flex items-center space-x-2 w-fit">
                       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                       </svg>
                       <span class="font-medium">Tambah Galeri</span>
                    </a>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="p-8">
                @if(\App\Models\Gallery::count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(\App\Models\Gallery::latest()->take(6)->get() as $gallery)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/'.$gallery->image) }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-2">
                                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-gray-900 font-semibold text-lg truncate mb-3 group-hover:text-blue-600 transition-colors">
                                {{ $gallery->title }}
                            </h3>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full font-medium">
                                    {{ $gallery->category->name ?? 'Umum' }}
                                </span>
                                <a href="{{ route('galleries.edit', $gallery->id) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-semibold hover:underline transition-colors flex items-center space-x-1">
                                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                   </svg>
                                   <span>Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if(\App\Models\Gallery::count() > 6)
                <div class="mt-8 text-center">
                    <a href="{{ route('galleries.index') }}" 
                       class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-xl transition-colors">
                       <span>Lihat Semua Galeri</span>
                       <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                       </svg>
                    </a>
                </div>
                @endif
                @else
                <div class="text-center py-16">
                    <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada foto galeri</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan foto pertama ke galeri sekolah</p>
                    <a href="{{ route('galleries.create') }}" 
                       class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors">
                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                       </svg>
                       <span>Tambah Foto Pertama</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
</div>

<!-- Visitor Statistics Section -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-white">📊 Statistik Pengunjung</h2>
                <p class="text-indigo-100 text-sm">Analisis data kunjungan website</p>
            </div>
            <div class="mt-2 sm:mt-0">
                <select id="dateRange" class="appearance-none bg-white/20 backdrop-blur-sm text-white border border-white/20 rounded-lg px-4 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-white transition-colors">
                    <option value="7">7 Hari Terakhir</option>
                    <option value="14">14 Hari Terakhir</option>
                    <option value="30" selected>30 Hari Terakhir</option>
                    <option value="60">60 Hari Terakhir</option>
                </select>
            </div>
        </div>
    </div>

    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <!-- Total Kunjungan -->
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all hover:border-indigo-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengunjung</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1" data-stats="total">1,248</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                                12.5%
                            </span>
                            <span class="text-xs text-gray-500 ml-2">vs bulan lalu</span>
                        </div>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pengunjung Hari Ini -->
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all hover:border-green-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Hari Ini</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1" data-stats="today">124</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                                5.8%
                            </span>
                            <span class="text-xs text-gray-500 ml-2">vs kemarin</span>
                        </div>
                    </div>
                    <div class="p-3 bg-green-50 rounded-xl text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pengunjung Unik -->
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all hover:border-purple-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pengunjung Unik</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1" data-stats="unique">984</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                                7.2%
                            </span>
                            <span class="text-xs text-gray-500 ml-2">vs bulan lalu</span>
                        </div>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-xl text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Halaman Populer -->
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all hover:border-amber-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Halaman Populer</p>
                        <h3 class="text-lg font-bold text-gray-900 mt-1 truncate" data-stats="popular-page" title="/galeri">/galeri</h3>
                        <p class="text-xs text-gray-500 mt-2" data-stats="popular-page-count">328 kunjungan</p>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Ringkasan Kunjungan</h3>
                    <p class="text-sm text-gray-500">Jumlah kunjungan per hari dalam 30 hari terakhir</p>
                </div>
                <div class="flex items-center space-x-3 mt-2 sm:mt-0">
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                        <span class="text-xs text-gray-600">Kunjungan</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-indigo-200 rounded-full mr-2"></span>
                        <span class="text-xs text-gray-600">Pengunjung Unik</span>
                    </div>
                </div>
            </div>
            
            <div class="chart-container" style="height: 300px;">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize chart with empty data
    const ctx = document.getElementById('visitorChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Pengunjung',
                data: [],
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderColor: 'rgba(59, 130, 246, 0.8)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: 'white',
                pointBorderColor: 'rgba(59, 130, 246, 1)',
                pointBorderWidth: 2,
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'white',
                    titleColor: '#1F2937',
                    bodyColor: '#4B5563',
                    borderColor: '#E5E7EB',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Pengunjung: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        maxTicksLimit: 15
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        precision: 0,
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Function to load visitor stats
    function loadVisitorStats(days = 30) {
        fetch(`/admin/visitor-stats?days=${days}`)
            .then(response => response.json())
            .then(data => {
                // Update chart
                chart.data.labels = data.chart.labels;
                chart.data.datasets[0].data = data.chart.data;
                chart.update();

                // Update cards
                document.querySelector('[data-stats="today"]').textContent = data.today_visits.toLocaleString();
                document.querySelector('[data-stats="total"]').textContent = data.total_visits.toLocaleString();
                document.querySelector('[data-stats="unique"]').textContent = data.unique_visitors.toLocaleString();
                
                // Update popular page
                const popularPage = data.popular_pages[0] ? data.popular_pages[0].page_visited : '-';
                const popularPageElement = document.querySelector('[data-stats="popular-page"]');
                popularPageElement.textContent = popularPage.length > 20 ? 
                    popularPage.substring(0, 20) + '...' : popularPage;
                popularPageElement.title = popularPage;
                
                // Update popular page count
                const popularPageCount = data.popular_pages[0] ? 
                    data.popular_pages[0].visit_count + ' kunjungan' : 'Tidak ada data';
                document.querySelector('[data-stats="popular-page-count"]').textContent = popularPageCount;
            })
            .catch(error => {
                console.error('Error loading visitor stats:', error);
            });
    }

    // Initial load
    loadVisitorStats(30);

    // Handle date range changes
    document.getElementById('dateRange').addEventListener('change', function() {
        loadVisitorStats(this.value);
    });
});
</script>
@endpush


<!-- Quick Actions and Recent Activity Section -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions Panel -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden xl:col-span-1">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
            <div class="flex items-center space-x-3">
                <div class="bg-white/20 p-2 rounded-xl backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">Aksi Cepat</h2>
                    <p class="text-indigo-100 text-sm">Akses fitur dengan cepat</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <!-- Upload Gambar -->
                <a href="{{ route('galleries.create') }}" class="group flex items-center p-4 rounded-xl bg-white border border-gray-100 hover:border-indigo-100 hover:shadow-md transition-all">
                    <div class="flex-shrink-0 bg-indigo-50 p-3 rounded-xl text-indigo-600 group-hover:bg-indigo-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="font-medium text-gray-900 group-hover:text-indigo-600">Unggah Gambar</h3>
                        <p class="text-sm text-gray-500">Tambahkan foto ke galeri</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- Buat Berita -->
                <a href="{{ route('beritas.create') }}" class="group flex items-center p-4 rounded-xl bg-white border border-gray-100 hover:border-emerald-100 hover:shadow-md transition-all">
                    <div class="flex-shrink-0 bg-emerald-50 p-3 rounded-xl text-emerald-600 group-hover:bg-emerald-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="font-medium text-gray-900 group-hover:text-emerald-600">Tulis Berita</h3>
                        <p class="text-sm text-gray-500">Publikasikan berita terbaru</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- Kelola Kategori -->
                <a href="{{ route('categories.index') }}" class="group flex items-center p-4 rounded-xl bg-white border border-gray-100 hover:border-purple-100 hover:shadow-md transition-all">
                    <div class="flex-shrink-0 bg-purple-50 p-3 rounded-xl text-purple-600 group-hover:bg-purple-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="font-medium text-gray-900 group-hover:text-purple-600">Kelola Kategori</h3>
                        <p class="text-sm text-gray-500">Atur kategori galeri</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity Timeline -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden xl:col-span-2">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-indigo-600 p-2 rounded-xl">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Aktivitas Terbaru</h2>
                        <p class="text-gray-600 text-sm">Riwayat aktivitas sistem</p>
                    </div>
                </div>
                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
            </div>
        </div>
        <div class="divide-y divide-gray-100">
            @php
                $activities = [
                    [
                        'type' => 'berita',
                        'title' => 'Pembaruan Jadwal Ujian Akhir Semester',
                        'time' => 'Baru saja',
                        'user' => 'Admin',
                        'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                        'color' => 'bg-blue-100 text-blue-600'
                    ],
                    [
                        'type' => 'gallery',
                        'title' => 'Foto Kegiatan Pramuka Terbaru',
                        'time' => '1 jam yang lalu',
                        'user' => 'Admin',
                        'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'color' => 'bg-purple-100 text-purple-600'
                    ],
                    [
                        'type' => 'user',
                        'title' => 'Admin baru ditambahkan',
                        'time' => '2 jam yang lalu',
                        'user' => 'Super Admin',
                        'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'color' => 'bg-green-100 text-green-600'
                    ]
                ];
            @endphp

            @if(count($activities) > 0)
                @foreach($activities as $activity)
                <div class="p-5 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 {{ $activity['color'] }} rounded-lg mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon'] }}"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 mb-1">{{ $activity['title'] }}</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <span>{{ $activity['user'] }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $activity['time'] }}</span>
                            </div>
                        </div>
                        <button type="button" class="ml-4 text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada aktivitas</h3>
                    <p class="text-gray-500 text-sm">Semua aktivitas akan muncul di sini</p>
                </div>
            @endif
        </div>
        
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 text-center">
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                Lihat riwayat lengkap
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>
    </div>
</div>

@endsection
