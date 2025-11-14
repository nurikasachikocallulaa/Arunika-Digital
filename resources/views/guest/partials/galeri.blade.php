@extends('layouts.guest')
@section('title', isset($category) ? $category->name : 'Galeri SMKN 4 BOGOR')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- Judul -->
    <h1 class="text-3xl font-bold mb-6 text-center">
        {{ isset($category) ? 'Galeri: '.$category->name : 'Galeri Kegiatan' }}
    </h1>

    <!-- Kategori -->
    <div class="mb-6 flex flex-wrap gap-3 justify-center">
        @foreach($categories as $cat)
            <a href="{{ url('/galeri?kategori='.$cat->id) }}"
               class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full hover:bg-blue-100 transition font-medium">
               {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <!-- Galeri -->
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition overflow-hidden relative group">
                    @if($gallery->image)
                        <img src="{{ asset('storage/'.$gallery->image) }}"
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-3 absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="text-white font-semibold truncate">{{ $gallery->title }}</h3>
                        <p class="text-gray-300 text-sm mt-1">{{ $gallery->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $galleries->links() }}
        </div>
    @else
        <p class="text-gray-500 text-center mt-6">Belum ada galeri {{ isset($category) ? 'di kategori ini' : '' }}.</p>
    @endif

</div>
@endsection
