@extends('layouts.guest')

@section('title', 'Berita')
@section('content')
<div class="max-w-7xl mx-auto p-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Berita, Aktivitas dan Kabar Galeri SMKN 4</h1>
        <p class="text-gray-600">Informasi terbaru seputar kegiatan dan berita galeri</p>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
        <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            @if($berita->image)
                <div class="w-full">
                    <img src="{{ asset('storage/'.$berita->image) }}" alt="{{ $berita->title }}" class="w-full h-48 object-cover">
                </div>
            @endif
            <div class="p-4">
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Berita</span>
                </div>
                
                <h2 class="text-lg font-bold text-gray-900 mb-2 hover:text-red-600 transition-colors line-clamp-2">
                    <a href="{{ route('guest.berita.show', $berita->id) }}">
                        {{ $berita->title }}
                    </a>
                </h2>
                
                <div class="flex items-center gap-2 mb-3 text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <i class="fas fa-user"></i>
                        Admin Galeri
                    </span>
                    <span>•</span>
                    <span>{{ $berita->created_at->format('M j, Y') }}</span>
                    <span>•</span>
                    <span>{{ $berita->created_at->format('g:i a') }}</span>
                </div>
                
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($berita->content), 100) }}</p>
                
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1 text-xs text-gray-500">
                        <i class="fas fa-eye"></i>
                        Views: {{ rand(100, 999) }}
                    </span>
                    <a href="{{ route('guest.berita.show', $berita->id) }}" class="text-red-600 hover:text-red-700 font-semibold text-xs hover:underline">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($beritas->hasPages())
    <div class="mt-8">
        {{ $beritas->links() }}
    </div>
    @endif
</div>
@endsection
