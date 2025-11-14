@extends('layouts.admin')

@section('title', $berita->title)

@push('styles')
<style>
    .article-content {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.8;
        color: #374151;
    }
    .article-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1.25rem;
        color: #111827;
    }
    .article-content p {
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        color: #4b5563;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 2rem 0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .article-content ul, .article-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    .article-content li {
        margin-bottom: 0.5rem;
    }
    .back-button {
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
    .back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .article-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .article-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.366.366-3.58 9.205H60V.52L54.627 0zM.52 0v60h5.093V0H.52zm8.2 0l9.204 3.58L12.515 0H8.72zM0 59.48L5.373 60l-.366-.366 3.58-9.204H0v5.646zM60 8.72v3.796l-9.205-3.58L60 .52V8.72zM0 12.515v3.796l9.204 3.58L0 5.373v7.142zM60 54.627l-9.205-3.58 3.58 9.205L60 59.48v-4.853zM0 54.627v-3.796l9.204-3.58L0 60v-5.373zm0-9.826v-3.796l9.204-3.58L0 50.227v-5.426zM60 50.227l-9.205-3.58 3.58 9.205L60 59.48v-9.253zM0 35.18v-3.796l9.204-3.58L0 30.78v4.4zm60-4.4l-9.205-3.58 3.58 9.205L60 40.38v-9.6zM0 25.383v-3.796l9.204-3.58L0 20.983v4.4zM60 20.983l-9.205-3.58 3.58 9.205L60 26.18v-5.197zM0 15.586v-3.07l9.204 3.58L0 20.983v-5.397zM60 15.586l-9.205-3.58 3.58 9.204L60 20.983v-5.397z" fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }
    .article-meta {
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header with Gradient Background -->
    <div class="article-header pt-16 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('beritas.index') }}" class="inline-flex items-center px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-indigo-700 hover:bg-white transition-all duration-300 border border-white shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
                <span class="px-4 py-2 rounded-lg text-sm font-bold bg-yellow-400 text-gray-900 shadow-md hover:bg-yellow-300 transition-all duration-300">
                    {{ $berita->category ?? 'Berita' }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight mb-6 text-shadow-lg" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">{{ $berita->title }}</h1>
            
            <div class="article-meta inline-flex items-center text-sm text-white px-4 py-3 rounded-lg space-x-4">
                <div class="flex items-center bg-white/90 px-4 py-2 rounded-lg shadow">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-semibold text-gray-800">{{ $berita->created_at->translatedFormat('l, d F Y') }}</span>
                </div>
                
                <div class="flex items-center bg-white/90 px-4 py-2 rounded-lg shadow">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold text-gray-800">{{ $berita->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10">
        <!-- Featured Image -->
        @if($berita->image)
        <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-8 transform transition-all duration-300 hover:shadow-2xl">
            <img src="{{ asset('storage/' . $berita->image) }}" 
                 alt="{{ $berita->title }}" 
                 class="w-full h-auto max-h-[500px] object-cover">
        </div>
        @endif

        <!-- Article Content -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden p-8 mb-8">
            <div class="article-content">
                {!! $berita->content !!}
            </div>

            <!-- Tags (if any) -->
            @if($berita->tags)
            <div class="mt-10 pt-6 border-t border-gray-100">
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $berita->tags) as $tag)
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">
                        #{{ trim($tag) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Author Info -->
            <div class="mt-10 pt-6 border-t border-gray-100">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-12 w-12 rounded-full" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($berita->user->name ?? 'Admin') }}&background=4f46e5&color=fff" 
                             alt="{{ $berita->user->name ?? 'Admin' }}">
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $berita->user->name ?? 'Administrator' }}
                        </p>
                        <div class="flex space-x-1 text-sm text-gray-500">
                            <span>Diposting pada</span>
                            <time datetime="{{ $berita->created_at->format('Y-m-d') }}">
                                {{ $berita->created_at->format('d M Y') }}
                            </time>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Navigation Buttons -->
        <div class="flex flex-col sm:flex-row justify-between gap-4 mb-12">
            <a href="{{ route('beritas.edit', $berita) }}" 
               class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 md:text-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                Edit Berita
            </a>
            
            <form action="{{ route('beritas.destroy', $berita) }}" method="POST" class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                        class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 md:text-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Berita
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add smooth scrolling for anchor links in the content
    document.querySelectorAll('.article-content a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add animation to images when they come into view
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeIn');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.article-content img').forEach(img => {
        img.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        observer.observe(img);
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.6s ease-out forwards;
    }
</style>
@endpush
@endsection
