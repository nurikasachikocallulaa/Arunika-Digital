@extends('layouts.guest')
@section('title', 'Beranda')

@section('content')

<!-- Main Content Grid -->
<div class="max-w-7xl mx-auto p-6">
    <!-- Quick Access Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-12">
        <!-- Profil -->
        <a href="{{ route('guest.profil') }}" class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-t-4 border-blue-500">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user text-blue-600 text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Profil</h3>
            <p class="text-sm text-gray-600">Tentang Kami</p>
        </a>

        <!-- Galeri -->
        <a href="{{ route('guest.galeri') }}" class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-t-4 border-indigo-500">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-images text-indigo-600 text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Galeri</h3>
            <p class="text-sm text-gray-600">Foto Kegiatan</p>
        </a>

        <!-- Berita -->
        <a href="{{ route('guest.berita') }}" class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-t-4 border-red-500">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-newspaper text-red-600 text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Berita</h3>
            <p class="text-sm text-gray-600">Artikel Terbaru</p>
        </a>
    </div>
    
    <!-- Profile Section - New Design -->
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 text-white rounded-3xl shadow-2xl mb-12">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute w-96 h-96 bg-blue-500/20 rounded-full blur-3xl -top-48 -left-48 animate-blob"></div>
            <div class="absolute w-96 h-96 bg-purple-500/20 rounded-full blur-3xl -bottom-48 -right-48 animate-blob animation-delay-2000"></div>
            <div class="absolute w-96 h-96 bg-pink-500/20 rounded-full blur-3xl top-1/2 left-1/2 animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="relative px-6 py-16 md:py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto">
                <!-- Left: Logo & Title -->
                <div class="text-center md:text-left space-y-6">
                    <div class="inline-block">
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-pink-500 rounded-full blur-lg opacity-75 group-hover:opacity-100 transition duration-1000"></div>
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMKN 4 Bogor" class="relative w-32 h-32 md:w-40 md:h-40 object-cover rounded-full border-4 border-white shadow-2xl">
                        </div>
                    </div>
                    
                    <div>
                        <div class="inline-flex items-center gap-2 bg-yellow-400/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4 border border-yellow-400/30">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span class="text-sm font-bold text-yellow-300">Terakreditasi A</span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-black mb-4 leading-tight">
                            SMKN 4<br/>
                            <span class="bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 bg-clip-text text-transparent">BOGOR</span>
                        </h1>
                        <p class="text-lg md:text-xl text-blue-100 font-medium mb-6">Nebrazka - Pusat Keunggulan Pendidikan Kejuruan</p>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                            <a href="{{ route('guest.profil') }}" class="inline-flex items-center justify-center bg-white text-blue-900 px-6 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all shadow-xl">
                                <i class="fas fa-info-circle mr-2"></i>
                                Profil Lengkap
                            </a>
                            <a href="{{ route('guest.galeri') }}" class="inline-flex items-center justify-center bg-yellow-400 text-blue-900 px-6 py-3 rounded-xl font-bold hover:bg-yellow-300 transition-all shadow-xl">
                                <i class="fas fa-images mr-2"></i>
                                Galeri Foto
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Quick Stats -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                        <div class="text-4xl md:text-5xl font-black text-yellow-400 mb-2">15+</div>
                        <p class="text-sm text-blue-100">Tahun Pengalaman</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                        <div class="text-4xl md:text-5xl font-black text-green-400 mb-2">1200+</div>
                        <p class="text-sm text-blue-100">Siswa Aktif</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                        <div class="text-4xl md:text-5xl font-black text-purple-400 mb-2">50+</div>
                        <p class="text-sm text-blue-100">Tenaga Pendidik</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                        <div class="text-4xl md:text-5xl font-black text-orange-400 mb-2">4</div>
                        <p class="text-sm text-blue-100">Program Keahlian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <!-- Content Sections - Vertical Layout -->
    <div class="space-y-8 mb-12">
        <!-- Berita Section -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <i class="fas fa-newspaper text-red-600"></i> Artikel & Berita
                </h2>
                <a href="{{ route('guest.berita') }}" class="text-red-600 hover:text-red-700 font-semibold text-sm">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($beritas->take(6) as $berita)
                    <div class="bg-gray-50 rounded-xl p-4 hover:shadow-md transition-all duration-300">
                        @if($berita->image)
                            <img src="{{ asset('storage/'.$berita->image) }}" alt="{{ $berita->title }}" class="w-full h-40 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-40 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                                <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                            </div>
                        @endif
                        <a href="{{ route('guest.berita.show', $berita->id) }}" class="font-semibold text-gray-800 hover:text-red-600 line-clamp-2 mb-2 block">{{ $berita->title }}</a>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ Str::limit($berita->content, 80) }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span><i class="fas fa-calendar mr-1"></i>{{ $berita->created_at->format('d M Y') }}</span>
                            <span><i class="fas fa-eye mr-1"></i>{{ rand(100, 999) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Gallery Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <!-- Header -->
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-indigo-100 p-3 rounded-xl">
                        <i class="fas fa-images text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Galeri Foto</h2>
                        <p class="text-gray-600 text-sm">Dokumentasi kegiatan sekolah</p>
                    </div>
                </div>
                <a href="{{ route('guest.galeri') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors font-semibold text-sm shadow-md">
                    Lihat Semua
                </a>
            </div>
        </div>
        
        <!-- Gallery Grid -->
        <div class="p-8">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galleries->take(6) as $index => $gallery)
                        <div class="group relative">
                            <div class="block cursor-pointer" onclick="openLightbox('{{ asset('storage/'.$gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->created_at->format('d M Y') }}')">
                                <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2">
                                    @if($gallery->image)
                                        <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    
                                    <!-- Content -->
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-6 group-hover:translate-y-0 transition-transform duration-300">
                                        <h3 class="font-bold text-lg mb-2 line-clamp-2">{{ $gallery->title }}</h3>
                                        @if($gallery->category)
                                            <div class="flex items-center gap-2">
                                                <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium">
                                                    {{ $gallery->category->name }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- View Icon -->
                                    <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-search-plus text-white text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- View More Button -->
                @if($galleries->count() > 6)
                    <div class="text-center mt-8">
                        <a href="{{ route('guest.galeri') }}" class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-8 py-3 rounded-xl transition-colors shadow-sm">
                            <span>Jelajahi Lebih Banyak Foto</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-images text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Foto Galeri</h3>
                    <p class="text-gray-500 mb-6">Galeri foto kegiatan sekolah akan segera hadir</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Contact & Maps Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Contact Section -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-3xl font-bold mb-4 text-gray-800 flex items-center gap-3">
                <i class="fas fa-address-book text-blue-600"></i> Kontak Kami
            </h2>
            <p class="text-gray-600 mb-6">Silakan hubungi kami melalui informasi berikut:</p>

            <div class="space-y-4">
                <!-- Alamat -->
                <div class="flex items-start space-x-4 bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="text-blue-600 text-2xl">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Alamat</h3>
                        <p class="text-gray-500 text-sm">Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan, RT.03/RW.08, Muarasari, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16137</p>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="flex items-start space-x-4 bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="text-green-600 text-2xl">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Telepon</h3>
                        <p class="text-gray-500">(0251) 7547381</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start space-x-4 bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="text-red-600 text-2xl">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Email</h3>
                        <p class="text-gray-500">info@smkn4bogor.sch.id</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Maps Section -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                    <i class="fas fa-map-marked-alt text-blue-600"></i> Lokasi Kami
                </h2>
                <p class="text-gray-600">Temukan SMKN 4 Bogor di peta</p>
            </div>
            
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-4 border border-blue-100">
                <div class="relative overflow-hidden rounded-xl shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15852.200055797124!2d106.80623977536085!3d-6.640711744308134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1757510841376!5m2!1sid!2sid" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="rounded-xl">
                    </iframe>
                </div>
                <div class="mt-4 text-center">
                    <p class="text-gray-700 text-sm flex items-center justify-center gap-2 mb-2">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                        <span class="font-medium">SMKN 4 Bogor (Nebrazka)</span>
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 text-xs text-gray-600">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-phone text-green-600"></i>
                            <span>(0251) 7547381</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fas fa-envelope text-red-600"></i>
                            <span>info@smkn4bogor.sch.id</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <i class="fas fa-times text-2xl"></i>
        </button>
        
        <!-- Image Container -->
        <div class="relative bg-white rounded-lg overflow-hidden shadow-2xl">
            <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
            
            <!-- Image Info -->
            <div class="p-4 bg-white">
                <h3 id="lightbox-title" class="text-xl font-bold text-gray-800 mb-2"></h3>
                <p id="lightbox-date" class="text-gray-600 text-sm"></p>
            </div>
        </div>
        
        <!-- Navigation Buttons -->
        <button onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-colors">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-colors">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<script>
let currentImageIndex = 0;
let galleryImages = [];

// Initialize gallery images array
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('[onclick^="openLightbox"]');
    galleryImages = Array.from(galleryItems).map(item => {
        const onclick = item.getAttribute('onclick');
        const matches = onclick.match(/openLightbox\('([^']+)', '([^']+)', '([^']+)'\)/);
        return {
            src: matches[1],
            title: matches[2],
            date: matches[3]
        };
    });
});

function openLightbox(imageSrc, title, date) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDate = document.getElementById('lightbox-date');
    
    // Find current image index
    currentImageIndex = galleryImages.findIndex(img => img.src === imageSrc);
    
    lightboxImage.src = imageSrc;
    lightboxImage.alt = title;
    lightboxTitle.textContent = title;
    lightboxDate.textContent = date;
    
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function previousImage() {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : galleryImages.length - 1;
    updateLightboxImage();
}

function nextImage() {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = currentImageIndex < galleryImages.length - 1 ? currentImageIndex + 1 : 0;
    updateLightboxImage();
}

function updateLightboxImage() {
    const currentImage = galleryImages[currentImageIndex];
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDate = document.getElementById('lightbox-date');
    
    lightboxImage.src = currentImage.src;
    lightboxImage.alt = currentImage.title;
    lightboxTitle.textContent = currentImage.title;
    lightboxDate.textContent = currentImage.date;
}

// Close lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                previousImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    }
});
</script>
@endsection
