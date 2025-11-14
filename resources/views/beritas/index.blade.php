@extends('layouts.admin_new')

@section('title', 'Berita')
@section('page-title', 'Manajemen Berita')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor {
        min-height: 200px;
    }
    .image-preview {
        display: none;
        max-width: 100%;
        height: auto;
        margin-top: 1rem;
        border-radius: 0.5rem;
        border: 2px dashed #e2e8f0;
    }
    .drop-zone {
        border: 2px dashed #cbd5e0;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .drop-zone:hover {
        border-color: #4299e1;
        background-color: #f8fafc;
    }
    .drop-zone.dragover {
        background-color: #ebf8ff;
        border-color: #63b3ed;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="p-1">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0 flex items-start">
                    <div class="mr-4 hidden sm:flex items-center justify-center w-12 h-12 rounded-xl bg-white/20 text-white shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M9 8h6M5 7a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-1">Manajemen Berita</h2>
                        <p class="text-blue-100 text-sm md:text-base">Kelola konten berita dan artikel sekolah</p>
                    </div>
                </div>
                <a href="{{ route('beritas.create') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:from-blue-600 hover:to-indigo-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                    </svg>
                    Buat Berita Baru
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Filter Only -->
    <div class="bg-white p-4 rounded-xl shadow">
        <div class="flex items-center justify-end">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Urutkan:</span>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option>Terbaru</option>
                    <option>Terlama</option>
                    <option>A-Z</option>
                    <option>Z-A</option>
                </select>
            </div>
        </div>
    </div>

    @if($beritas->count() > 0)
    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
            <!-- Image Section -->
            <div class="h-48 overflow-hidden relative">
                @if($berita->image)
                    <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold shadow-md bg-white/90 text-blue-700 flex items-center">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-600 mr-1.5"></span>
                        Foto
                    </div>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs font-medium">Tidak Ada Gambar</p>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <div class="flex items-center text-white text-xs space-x-2">
                        <span class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $berita->created_at->format('d M Y') }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $berita->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-5">
                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
                    <a href="{{ route('beritas.show', $berita->id) }}">{{ $berita->title }}</a>
                </h3>

                <!-- Content Preview -->
                <div class="text-gray-600 text-sm mb-4 line-clamp-3">
                    {{ Str::limit(strip_tags($berita->content), 150) }}
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <a href="{{ route('beritas.show', $berita->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <div class="flex space-x-2">
                        <a href="{{ route('beritas.edit', $berita->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('beritas.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="bg-white p-4 rounded-xl shadow">
        {{ $beritas->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white p-12 rounded-2xl shadow-lg text-center border-2 border-dashed border-gray-200">
        <div class="w-24 h-24 mx-auto mb-6 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum ada berita</h3>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan menambahkan berita baru untuk dibagikan kepada pengunjung website</p>
        <a href="{{ route('beritas.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Berita Pertama
        </a>
    </div>
    @endif
</div>

 
@endsection
