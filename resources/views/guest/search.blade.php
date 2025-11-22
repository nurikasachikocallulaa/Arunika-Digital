@extends('layouts.guest')
@section('title', 'Pencarian')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Hasil Pencarian</h1>

    @if($query === '')
        <p class="text-gray-600">Silakan ketik kata kunci di kotak pencarian di atas.</p>
    @else
        <p class="text-gray-600 mb-6">Kata kunci: <span class="font-semibold">"{{ $query }}"</span></p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Hasil Berita -->
            <div>
                <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
                    <i class="fas fa-newspaper text-blue-600"></i>
                    Berita
                </h2>
                @if($beritaResults->isEmpty())
                    <p class="text-gray-500 text-sm">Tidak ada berita yang cocok.</p>
                @else
                    <div class="space-y-4">
                        @foreach($beritaResults as $berita)
                            <article class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                                <h3 class="font-bold text-gray-800 mb-1">
                                    <a href="{{ route('guest.berita.show', $berita->id) }}" class="hover:text-blue-600">
                                        {{ $berita->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500 mb-2">{{ $berita->created_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($berita->content), 120) }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Galeri -->
            <div>
                <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
                    <i class="fas fa-images text-green-600"></i>
                    Galeri
                </h2>
                @if($galleryResults->isEmpty())
                    <p class="text-gray-500 text-sm">Tidak ada galeri yang cocok.</p>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleryResults as $gallery)
                            <a href="{{ route('guest.galeri.show', $gallery->id) }}" class="block bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
                                @if($gallery->image)
                                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-28 object-cover">
                                @endif
                                <div class="p-2">
                                    <p class="text-sm font-semibold text-gray-800 line-clamp-2">{{ $gallery->title }}</p>
                                    @if($gallery->category)
                                        <p class="text-xs text-gray-500 mt-1">{{ $gallery->category->name }}</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
