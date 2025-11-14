@extends('layouts.guest')
@section('title','Beranda')

@section('content')
<style>
.beranda-main {
    margin-top: 0 !important;
    max-width: none !important;
    padding: 0 !important;
}
</style>

<script>
// Simple background slideshow for hero
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('#beranda .slideshow-bg');
  let idx = 0;
  setInterval(() => {
    if (slides.length < 2) return;
    const current = slides[idx];
    idx = (idx + 1) % slides.length;
    const next = slides[idx];
    current.classList.remove('opacity-100');
    current.classList.add('opacity-0');
    next.classList.remove('opacity-0');
    next.classList.add('opacity-100');
  }, 7000);
});
</script>
<!-- Hero Section with Slideshow Background -->
<section id="beranda" class="min-h-screen flex items-center justify-center text-white relative overflow-hidden">
    <!-- Slideshow background images -->
    <img src="{{ asset('images/hero-1.jpg') }}" alt="Hero 1" class="absolute inset-0 w-full h-full object-cover slideshow-bg opacity-100 transition-opacity duration-1000">
    <img src="{{ asset('images/hero-2.jpg') }}" alt="Hero 2" class="absolute inset-0 w-full h-full object-cover slideshow-bg opacity-0 transition-opacity duration-1000">
    <!-- Overlay for readability -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-indigo-900/30 to-purple-900/40"></div>
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
            Selamat Datang di SMKN 4 BOGOR
        </h1>
        <p class="text-lg md:text-xl mb-8 text-blue-100 leading-relaxed opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="60">
            Pendidikan Unggul, Masa Depan Gemilang - Tempat di mana inovasi dan tradisi bersatu untuk membentuk generasi pemimpin masa depan.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#galeri" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-100 transition transform hover:scale-105 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="120">
                Jelajahi Galeri
            </a>
            <a href="#profil" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-100 transition transform hover:scale-105 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="180">
                Tentang Kami
            </a>
        </div>
    </div>
</section>

<!-- Profil Section - White Background Design -->
<section id="profil" class="py-20 bg-white relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full blur-3xl opacity-40"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full blur-3xl opacity-40"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Left: Logo & Title -->
            <div class="text-center md:text-left space-y-6">
                <div class="inline-block">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full blur-lg opacity-50 group-hover:opacity-75 transition duration-1000"></div>
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMKN 4 Bogor" class="relative w-32 h-32 md:w-40 md:h-40 object-cover rounded-full border-4 border-white shadow-2xl">
                    </div>
                </div>
                
                <div>
                    <div class="inline-flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-full mb-4 border border-gray-200 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                        <i class="fas fa-star text-gray-700"></i>
                        <span class="text-sm font-semibold text-gray-700">Terakreditasi A</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black mb-4 leading-tight text-gray-900 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="60">
                        SMKN 4<br/>
                        <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">BOGOR</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 font-medium mb-6 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="120">Nebrazka - Pusat Keunggulan Pendidikan Kejuruan</p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="{{ route('guest.profil') }}" class="inline-flex items-center justify-center bg-gray-900 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors shadow opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="180">
                            <i class="fas fa-info-circle mr-2"></i>
                            Profil Lengkap
                        </a>
                        <a href="{{ route('guest.galeri') }}" class="inline-flex items-center justify-center bg-white text-gray-700 px-6 py-3 rounded-xl font-semibold border border-gray-300 hover:bg-gray-100 transition-colors shadow-sm opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="240">
                            <i class="fas fa-images mr-2"></i>
                            Galeri Foto
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right: Quick Stats -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-2xl p-6 border border-gray-200 hover:shadow-md transition-shadow cursor-pointer opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-4xl md:text-5xl font-black text-gray-900">15+</div>
                        <i class="fas fa-trophy text-gray-500"></i>
                    </div>
                    <p class="text-sm text-gray-700 font-semibold">Tahun Pengalaman</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-gray-200 hover:shadow-md transition-shadow cursor-pointer opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="60">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-4xl md:text-5xl font-black text-gray-900">1200+</div>
                        <i class="fas fa-users text-gray-500"></i>
                    </div>
                    <p class="text-sm text-gray-700 font-semibold">Siswa Aktif</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-gray-200 hover:shadow-md transition-shadow cursor-pointer opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="120">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-4xl md:text-5xl font-black text-gray-900">50+</div>
                        <i class="fas fa-chalkboard-teacher text-gray-500"></i>
                    </div>
                    <p class="text-sm text-gray-700 font-semibold">Tenaga Pendidik</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-gray-200 hover:shadow-md transition-shadow cursor-pointer opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="180">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-4xl md:text-5xl font-black text-gray-900">4</div>
                        <i class="fas fa-tools text-gray-500"></i>
                    </div>
                    <p class="text-sm text-gray-700 font-semibold">Program Keahlian</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if ('IntersectionObserver' in window) {
            const els = document.querySelectorAll('[data-reveal]');
            const io = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const delay = parseInt(el.getAttribute('data-delay') || '0', 10);
                        setTimeout(() => {
                            el.classList.remove('opacity-0');
                            el.classList.remove('translate-y-4');
                            el.classList.add('opacity-100');
                            el.classList.add('translate-y-0');
                        }, delay);
                        io.unobserve(el);
                    }
                });
            }, { threshold: 0.1 });
            els.forEach((el) => io.observe(el));
        } else {
            // Fallback: show immediately
            document.querySelectorAll('[data-reveal]').forEach((el) => {
                el.classList.remove('opacity-0', 'translate-y-4');
                el.classList.add('opacity-100', 'translate-y-0');
            });
        }
    });
</script>

<!-- Berita Section - Clean Neutral White -->
<section id="berita" class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-100 to-purple-100 px-4 py-2 rounded-full mb-4 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                <i class="fas fa-newspaper text-blue-600"></i>
                <span class="text-sm font-bold text-blue-600">Berita & Artikel</span>
            </div>
             <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="60">
                Informasi <span class="bg-gradient-to-r from-blue-400 via-white-600 to-blue-600 bg-clip-text text-transparent">Terkini</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="120">Update berita, kegiatan, dan prestasi terbaru dari SMKN 4 Bogor</p>
        </div>
        
        <!-- News Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($latestBeritas as $berita)
            <div class="group bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md hover:border-gray-300 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="{{ $loop->iteration * 80 }}">
                <!-- Image with Overlay -->
                <div class="relative overflow-hidden h-56">
                    @if($berita->image)
                        <img src="{{ asset('storage/'.$berita->image) }}" 
                             alt="{{ $berita->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-newspaper text-gray-400 text-6xl"></i>
                        </div>
                    @endif
                    
                    <!-- Subtle Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Date Badge -->
                    <div class="absolute top-4 left-4 bg-white/95 px-3 py-2 rounded-lg shadow">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-gray-600 text-sm"></i>
                            <span class="text-xs font-semibold text-gray-800">{{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    <!-- Category Badge (if you have categories) -->
                    <div class="absolute top-4 right-4 bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold border border-gray-200">Berita</div>
                </div>
                
                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-gray-700 transition-colors">
                        {{ $berita->title }}
                    </h3>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($berita->content), 120) }}
                    </p>
                    
                    <!-- Read More Link -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a href="{{ route('guest.berita') }}" class="inline-flex items-center gap-2 text-gray-700 font-semibold hover:gap-3 transition-all group">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                        
                        <!-- Share Icon -->
                        <button class="text-gray-400 hover:text-gray-700 transition-colors">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- CTA Button -->
        <div class="text-center">
            <a href="{{ route('guest.berita') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-400 via-white-600 to-blue-600 text-white px-10 py-4 rounded-full font-bold text-lg hover:from-blue-500 hover:via-white-700 hover:to-blue-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                <i class="fas fa-newspaper"></i>
                <span>Lihat Semua Berita</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Galeri Section - New Modern Design with White Background -->
<section id="galeri" class="py-20 bg-white relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full blur-3xl opacity-30"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-indigo-100 to-pink-100 rounded-full blur-3xl opacity-30"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-100 to-purple-100 px-4 py-2 rounded-full mb-4 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                <i class="fas fa-images text-blue-600"></i>
                <span class="text-sm font-bold text-blue-600">Galeri Foto</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="60">
                Dokumentasi <span class="bg-gradient-to-r from-blue-400 via-white-600 to-blue-600 bg-clip-text text-transparent">Kegiatan</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="120">Momen berharga dan prestasi membanggakan dari berbagai kegiatan sekolah</p>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @foreach($latestGalleries as $gallery)
            <div class="group relative">
                <!-- Card -->
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl border border-gray-100 hover:border-purple-200 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="{{ $loop->iteration * 80 }}">
                    <!-- Image Container -->
                    <div class="relative aspect-square overflow-hidden cursor-pointer"
                         onclick="event.stopPropagation(); openLightbox('{{ asset('storage/'.$gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->created_at->format('d M Y') }}')">
                        @if($gallery->image)
                            <img src="{{ asset('storage/'.$gallery->image) }}"
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center">
                                <i class="fas fa-image text-white text-6xl opacity-50"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-white font-bold text-base mb-2 line-clamp-2">
                                    {{ $gallery->title }}
                                </h3>
                                <div class="flex items-center gap-2 text-white/80 text-sm">
                                    <i class="fas fa-calendar-alt text-xs"></i>
                                    <span>{{ $gallery->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Zoom Icon -->
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-blue-600 to-purple-600 p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100 shadow-lg">
                            <i class="fas fa-search-plus text-white text-sm"></i>
                        </div>
                    </div>
                    
                    <!-- Stats Bar -->
                    <div class="p-4 bg-gradient-to-r from-gray-50 to-blue-50">
                        <div class="flex items-center justify-between text-sm">
                            <a href="{{ route('guest.galeri.show', $gallery->id) }}" 
                               class="flex items-center gap-2 text-pink-600 hover:text-pink-700 transition font-semibold"
                               onclick="event.stopPropagation()">
                                <i class="fas fa-heart"></i>
                                <span>{{ $gallery->likes_count ?? 0 }}</span>
                            </a>
                            
                            <a href="{{ route('guest.galeri.show', $gallery->id) }}" 
                               class="flex items-center gap-2 text-blue-600 hover:text-blue-700 transition font-semibold"
                               onclick="event.stopPropagation()">
                                <i class="fas fa-comment"></i>
                                <span>{{ $gallery->comments_count ?? 0 }}</span>
                            </a>
                            
                            <a href="{{ route('guest.galeri.show', $gallery->id) }}" 
                               class="flex items-center gap-2 text-purple-600 hover:text-purple-700 transition font-semibold"
                               onclick="event.stopPropagation()">
                                <i class="fas fa-eye"></i>
                                <span class="text-xs">Lihat</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- CTA Button -->
        <div class="text-center">
            <a href="{{ route('guest.galeri') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-400 via-white-600 to-blue-600 text-white px-10 py-4 rounded-full font-bold text-lg hover:from-blue-500 hover:via-white-700 hover:to-blue-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                <i class="fas fa-images"></i>
                <span>Jelajahi Semua Galeri</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Kontak & Lokasi Section -->
<section id="kontak" class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-100 to-purple-100 px-4 py-2 rounded-full mb-4 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="0">
                <i class="fas fa-address-book text-blue-600"></i>
                <span class="text-sm font-bold text-blue-600">Informasi Kontak & Informasi</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 opacity-0 translate-y-4 transition duration-500 ease-out" data-reveal data-delay="60">
                Informasi Kontak & <span class="bg-gradient-to-r from-blue-400 via-white-600 to-blue-600 bg-clip-text text-transparent">Lokasi </span>
            </h2>
            <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <!-- Informasi Kontak -->
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Informasi Kontak
                </h3>
                
                <div class="space-y-5">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 text-blue-600 mt-1">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Alamat</h4>
                            <p class="text-gray-600 mt-1">{{ $siteSettings->address ?? 'Jl. Raya Tajur No. 69, Bogor, Jawa Barat' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 text-blue-600 mt-1">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Telepon</h4>
                            <p class="text-gray-600 mt-1">{{ $siteSettings->phone ?? '(021) 1234 5678' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 text-blue-600 mt-1">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Email</h4>
                            <p class="text-gray-600 mt-1">{{ $siteSettings->email ?? 'info@smkn4bogor.sch.id' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 text-blue-600 mt-1">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
                            <p class="text-gray-600 mt-1">Senin - Jumat: 07.00 - 16.00 WIB</p>
                            <p class="text-gray-600">Sabtu: 08.00 - 14.00 WIB</p>
                            <p class="text-gray-600">Minggu: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Peta Lokasi -->
            <div class="bg-white p-1 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 px-4 pt-4">
                    <i class="fas fa-map-marked-alt text-blue-600 mr-2"></i>
                    Lokasi Kami
                </h3>
                <div class="w-full h-[400px] rounded-b-lg overflow-hidden">
                    <iframe 
                        src="{{ $siteSettings->map_embed ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.049882521692!2d106.82211897364498!3d-6.640728064914838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1763079992486!5m2!1sid!2sid' }}" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
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
    </div>
</div>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 1s ease-out;
}

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

html {
    scroll-behavior: smooth;
}
</style>

<script>
// Lightbox functionality
function openLightbox(imageSrc, title, date) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDate = document.getElementById('lightbox-date');
    
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
        if (e.key === 'Escape') {
            closeLightbox();
        }
    }
});
</script>
@endsection
