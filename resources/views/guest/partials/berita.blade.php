@extends('layouts.guest')

@section('title', 'Berita')
@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-8">

    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-2">Berita Sekolah</h1>
        <p class="text-gray-600 text-lg md:text-xl">Informasi terbaru seputar kegiatan, pengumuman, dan prestasi SMKN 4 Bogor</p>
    </div>

    <!-- News Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 hover:shadow-2xl">
            @if($berita->image)
                <img src="{{ asset('storage/'.$berita->image) }}" alt="{{ $berita->title }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-lg font-semibold">
                    No Image
                </div>
            @endif
            <div class="p-6 flex flex-col justify-between h-full">
                <div>
                    <h2 class="text-xl font-bold text-indigo-700 mb-2 hover:text-indigo-900 transition-colors">
                        <a href="{{ route('guest.berita.show', $berita->id) }}">
                            {{ $berita->title }}
                        </a>
                    </h2>
                    <p class="text-gray-500 text-sm mb-3">{{ $berita->created_at->format('d M Y') }}</p>
                    <p class="text-gray-700">{{ Str::limit($berita->content, 120) }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('guest.berita.show', $berita->id) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 transition-colors">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Custom Pagination -->
    <div class="flex justify-center mt-8 space-x-2">
        @if ($beritas->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 rounded-md">Prev</span>
        @else
            <a href="{{ $beritas->previousPageUrl() }}" class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Prev</a>
        @endif

        @foreach ($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
            @if ($page == $beritas->currentPage())
                <span class="px-3 py-1 bg-indigo-700 text-white rounded-md">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 transition">{{ $page }}</a>
            @endif
        @endforeach

        @if ($beritas->hasMorePages())
            <a href="{{ $beritas->nextPageUrl() }}" class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Next</a>
        @else
            <span class="px-3 py-1 bg-gray-200 rounded-md">Next</span>
        @endif
    </div>
</div>
@endsection
