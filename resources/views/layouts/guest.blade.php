<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SMKN 4 BOGOR</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Smooth scroll to section if hash exists in URL
            if (window.location.hash) {
                setTimeout(function() {
                    const target = document.querySelector(window.location.hash);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 100);
            }
        });
    </script>

    <!-- Navbar (Floating Full-Width) -->
    <nav class="fixed top-0 left-0 right-0 z-50">
        <div class="mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between gap-4 bg-gradient-to-br from-blue-600 via-sky-500 to-indigo-600 text-white shadow-md px-4 py-3 md:px-6 md:py-3 rounded-full ring-1 ring-white/10">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMK Negeri 4 Bogor" class="h-10 w-10 object-contain">
                <div class="flex flex-col">
                    <span class="font-bold text-base md:text-lg text-white">SMKN 4 BOGOR</span>
                </div>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('guest.home') }}#beranda" class="text-white/90 hover:text-white font-semibold transition">Beranda</a>
                <a href="{{ route('guest.home') }}#profil" class="text-white/90 hover:text-white font-semibold transition">Profil</a>
                <a href="{{ route('guest.home') }}#berita" class="text-white/90 hover:text-white font-semibold transition">Berita</a>
                <a href="{{ route('guest.home') }}#galeri" class="text-white/90 hover:text-white font-semibold transition">Galeri</a>
                <a href="{{ route('login') }}" class="bg-white text-blue-700 px-4 py-2 rounded-lg shadow hover:bg-blue-50 transition">Login</a>
            </div>

            <!-- Hamburger Mobile -->
            <button id="menu-btn" class="md:hidden text-white focus:outline-none text-2xl">
                ☰
            </button>
            </div>
        </div>

        <!-- Mobile Menu (Dropdown full-width) -->
        <div id="mobile-menu" class="hidden md:hidden bg-gradient-to-br from-blue-600 via-sky-500 to-indigo-600 text-white border-t border-blue-600/40 shadow-lg px-4 py-3 space-y-2 rounded-xl mx-4 md:mx-6">
            <a href="{{ route('guest.home') }}#beranda" class="block text-white/90 hover:text-white py-2 transition">Beranda</a>
            <a href="{{ route('guest.home') }}#profil" class="block text-white/90 hover:text-white py-2 transition">Profil</a>
            <a href="{{ route('guest.home') }}#berita" class="block text-white/90 hover:text-white py-2 transition">Berita</a>
            <a href="{{ route('guest.home') }}#galeri" class="block text-white/90 hover:text-white py-2 transition">Galeri</a>
            <a href="{{ route('login') }}" class="block bg-white text-blue-700 text-center px-4 py-2 rounded-lg shadow hover:bg-blue-50 transition mt-2">
                Login
            </a>
        </div>
    </nav>

    <!-- Spacer to prevent overlap with floating nav -->
    <div class="h-16 md:h-20"></div>



    <!-- Main Content -->
    <main class="@if(Request::routeIs('guest.home')) beranda-main @else mt-12 max-w-7xl mx-auto px-6 @endif">
        @yield('content')
    </main>

<!-- Footer (Blue-Sky-Indigo gradient, modern clean) -->
<footer class="relative bg-gradient-to-br from-blue-600 via-sky-500 to-indigo-600 text-white mt-12">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-start gap-3">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMKN 4 Bogor" class="h-12 w-12 object-contain rounded-lg ring-2 ring-white/20">
                    <div>
                        <h3 class="text-2xl font-bold">SMKN 4 BOGOR</h3>
                        <p class="text-white/80 text-sm">Nebrazka - Pusat Keunggulan</p>
                    </div>
                </div>
                <p class="text-white/90 text-sm leading-relaxed bg-white/10 rounded-xl p-4 backdrop-blur border border-white/20">
                    Mencetak generasi unggul berakhlak mulia dan kompeten di era digital dengan kolaborasi industri dan pembelajaran berbasis proyek.
                </p>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/smkn4kotabogor?igsh=MXJvNGw4ZHA4bjZnOA==" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 transition"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@smknegeri4bogor905?si=BrHvDQOsAedVrvhj" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 transition"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@smkn4kotabogor" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 transition"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold tracking-wide uppercase text-white/90 mb-3">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a class="flex items-center gap-2 text-white/90 hover:text-white" href="{{ route('guest.home') }}"><i class="fas fa-chevron-right text-xs"></i> Beranda</a></li>
                    <li><a class="flex items-center gap-2 text-white/90 hover:text-white" href="{{ route('guest.profil') }}"><i class="fas fa-chevron-right text-xs"></i> Profil Sekolah</a></li>
                    <li><a class="flex items-center gap-2 text-white/90 hover:text-white" href="{{ route('guest.berita') }}"><i class="fas fa-chevron-right text-xs"></i> Berita & Artikel</a></li>
                    <li><a class="flex items-center gap-2 text-white/90 hover:text-white" href="{{ route('guest.galeri') }}"><i class="fas fa-chevron-right text-xs"></i> Galeri Foto</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-sm font-semibold tracking-wide uppercase text-white/90 mb-3">Kontak</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex gap-2"><i class="fas fa-map-marker-alt mt-1 text-white/80"></i><span class="text-white/90">Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Muarasari, Bogor Selatan, Kota Bogor, Jawa Barat 16137</span></li>
                    <li class="flex gap-2"><i class="fas fa-phone mt-1 text-white/80"></i><span class="text-white/90">(0251) 7547381</span></li>
                    <li class="flex gap-2"><i class="fas fa-envelope mt-1 text-white/80"></i><span class="text-white/90">info@smkn4bogor.sch.id</span></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-white/20 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-xs text-white/90">{{ date('Y') }} SMKN 4 BOGOR. All Rights Reserved.</p>
            <div class="flex items-center gap-4 text-xs">
                <a href="#" class="text-white/80 hover:text-white">Privacy</a>
                <a href="#" class="text-white/80 hover:text-white">Terms</a>
                <a href="{{ route('login') }}" class="text-white/80 hover:text-white">Admin</a>
            </div>
        </div>
    </div>
</footer>


