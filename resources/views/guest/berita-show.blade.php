@extends('layouts.guest')

@section('title', $berita->title)

@section('content')
<!-- Article Header -->
<div class="bg-white py-6 border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm mb-4">
            <a href="{{ route('guest.home') }}" class="text-gray-600 hover:text-blue-600 transition">
                <i class="fas fa-home"></i> Beranda
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('guest.berita') }}" class="text-gray-600 hover:text-blue-600 transition">
                Berita
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-gray-900 font-semibold">Detail</span>
        </nav>

        <!-- Category Badge -->
        <div class="mb-3">
            <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold border border-gray-200">
                <i class="fas fa-newspaper"></i>
                Berita
            </span>
        </div>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 leading-tight">
            {{ $berita->title }}
        </h1>

        <!-- Meta Info -->
        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <i class="fas fa-user-circle text-gray-500"></i>
                <span class="font-semibold text-gray-700">Admin SMKN 4</span>
            </div>
            <span class="text-gray-300">•</span>
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar-alt text-gray-500"></i>
                <span>{{ $berita->created_at->format('d M Y') }}</span>
            </div>
            <span class="text-gray-300">•</span>
            <div class="flex items-center gap-2">
                <i class="fas fa-clock text-gray-500"></i>
                <span>{{ $berita->created_at->format('H:i') }} WIB</span>
            </div>
        </div>
    </div>
</div>

<!-- Article Content -->
<article class="max-w-4xl mx-auto px-6 py-8">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 md:p-8">
    <!-- Featured Image -->
    @if($berita->image)
    <div class="mb-6 rounded-lg overflow-hidden">
        <img src="{{ asset('storage/'.$berita->image) }}" 
             alt="{{ $berita->title }}" 
             class="w-full h-auto object-cover">
    </div>
    @endif

    <!-- Content -->
    <div class="prose max-w-none">
        <div class="text-gray-700 leading-relaxed text-base md:text-lg">
            {!! nl2br(e($berita->content)) !!}
        </div>
    </div>

    <!-- Share Section -->
    <div class="mt-8 pt-5 border-t border-gray-100">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Bagikan Artikel Ini</h3>
                <div class="flex items-center gap-2">
                    <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 transition text-sm font-medium">
                        <i class="fab fa-facebook-f"></i>
                        Facebook
                    </button>
                    <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 transition text-sm font-medium">
                        <i class="fab fa-twitter"></i>
                        Twitter
                    </button>
                    <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 transition text-sm font-medium">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('guest.berita') }}" class="inline-flex items-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-colors shadow">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Berita
        </a>
    </div>
        </div>
    </div>
</article>

<!-- Related News Section -->
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-2">
                Berita <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">Lainnya</span>
            </h2>
            <p class="text-gray-600">Artikel dan informasi terkini lainnya</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @php
                $relatedNews = App\Models\Berita::where('id', '!=', $berita->id)
                    ->latest()
                    ->take(3)
                    ->get();
            @endphp

            @foreach($relatedNews as $news)
            <a href="{{ route('guest.berita.show', $news->id) }}" class="group bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md hover:border-gray-300 transition-all duration-300 transform hover:-translate-y-1">
                @if($news->image)
                <div class="relative overflow-hidden h-48">
                    <img src="{{ asset('storage/'.$news->image) }}" 
                         alt="{{ $news->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-white/95 border border-gray-200 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">Berita</div>
                </div>
                @endif
                
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $news->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors">
                        {{ $news->title }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm line-clamp-3">
                        {{ Str::limit(strip_tags($news->content), 100) }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<style>
.prose {
    color: #374151;
}

.prose p {
    margin-bottom: 1.25rem;
    line-height: 1.8;
}

.prose h2 {
    font-size: 1.875rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #111827;
}

.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #1f2937;
}

.prose ul, .prose ol {
    margin-left: 1.5rem;
    margin-bottom: 1.25rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
