@extends('layouts.guest')
@section('title','Profil')

@section('content')
<!-- Hero Section with Parallax Effect -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-sky-500 to-indigo-600 text-white">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute w-96 h-96 bg-blue-500/20 rounded-full blur-3xl -top-48 -left-48 animate-blob"></div>
        <div class="absolute w-96 h-96 bg-purple-500/20 rounded-full blur-3xl -bottom-48 -right-48 animate-blob animation-delay-2000"></div>
        <div class="absolute w-96 h-96 bg-pink-500/20 rounded-full blur-3xl top-1/2 left-1/2 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-32">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Left: Logo & Title -->
            <div class="text-center md:text-left space-y-6">
                <div class="inline-block">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-pink-500 rounded-full blur-lg opacity-75 group-hover:opacity-100 transition duration-1000"></div>
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMKN 4 Bogor" class="relative w-40 h-40 md:w-48 md:h-48 object-cover rounded-full border-4 border-white shadow-2xl">
                    </div>
                </div>
                
                <div>
                    <div class="inline-flex items-center gap-2 bg-yellow-400/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4 border border-yellow-400/30">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-sm font-bold text-yellow-300">Terakreditasi A</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black mb-4 leading-tight">
                        SMKN 4<br/>
                        <span class="bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 bg-clip-text text-transparent">BOGOR</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 font-medium">Nebrazka - Pusat Keunggulan Pendidikan Kejuruan</p>
                </div>
            </div>
            
            <!-- Right: Quick Info Cards -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                    <div class="text-5xl font-black text-yellow-400 mb-2">15+</div>
                    <p class="text-sm text-blue-100">Tahun Pengalaman</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                    <div class="text-5xl font-black text-green-400 mb-2">1200+</div>
                    <p class="text-sm text-blue-100">Siswa Aktif</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                    <div class="text-5xl font-black text-purple-400 mb-2">50+</div>
                    <p class="text-sm text-blue-100">Tenaga Pendidik</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all hover:scale-105 cursor-pointer">
                    <div class="text-5xl font-black text-orange-400 mb-2">4+</div>
                    <p class="text-sm text-blue-100">Program Keahlian</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-6 py-16 space-y-16">
    
    <!-- About Section with Image -->
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="order-2 md:order-1">
            <div class="inline-flex items-center gap-2 bg-blue-100 px-4 py-2 rounded-full mb-4">
                <i class="fas fa-school text-blue-600"></i>
                <span class="text-sm font-bold text-blue-600">Tentang Kami</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                Membangun Masa Depan <span class="text-blue-600">Cemerlang</span>
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed mb-4">
                SMKN 4 BOGOR (Nebrazka) adalah lembaga pendidikan kejuruan yang berfokus pada pengembangan karakter, keterampilan profesional, dan ilmu pengetahuan bagi para siswa.
            </p>
            <p class="text-lg text-gray-600 leading-relaxed mb-6">
                Kami menyediakan sarana belajar modern, fasilitas lengkap, dan mendukung kegiatan ekstrakurikuler yang beragam untuk menghasilkan lulusan yang siap kerja dan berdaya saing tinggi.
            </p>
            
            <!-- Features List -->
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Kurikulum Berbasis Industri</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Fasilitas Modern & Lengkap</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <span class="text-gray-700 font-medium">Kerjasama dengan Industri Terkemuka</span>
                </div>
            </div>
        </div>
        
        <div class="order-1 md:order-2">
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-3xl blur-2xl opacity-20"></div>
                <div class="relative bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 shadow-xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <i class="fas fa-trophy text-yellow-500 text-4xl mb-3"></i>
                            <h4 class="font-bold text-gray-800">Prestasi</h4>
                            <p class="text-sm text-gray-600">Tingkat Nasional</p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <i class="fas fa-certificate text-blue-500 text-4xl mb-3"></i>
                            <h4 class="font-bold text-gray-800">Sertifikasi</h4>
                            <p class="text-sm text-gray-600">Kompetensi Siswa</p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <i class="fas fa-handshake text-green-500 text-4xl mb-3"></i>
                            <h4 class="font-bold text-gray-800">Kemitraan</h4>
                            <p class="text-sm text-gray-600">Dunia Industri</p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <i class="fas fa-briefcase text-purple-500 text-4xl mb-3"></i>
                            <h4 class="font-bold text-gray-800">Job Placement</h4>
                            <p class="text-sm text-gray-600">Lulusan Terserap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Vision & Mission - Modern Cards -->
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Vision Card -->
        <div class="group relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
            <div class="relative bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-gradient-to-br from-blue-500 to-cyan-500 p-4 rounded-2xl">
                        <i class="fas fa-eye text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900">Visi</h3>
                </div>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Menjadi <span class="font-bold text-blue-600">pusat keunggulan</span> pendidikan kejuruan yang menghasilkan lulusan <span class="font-bold text-blue-600">berkompeten</span>, <span class="font-bold text-blue-600">berakhlak mulia</span>, dan <span class="font-bold text-blue-600">siap menghadapi tantangan global</span>.
                </p>
            </div>
        </div>
        
        <!-- Mission Card -->
        <div class="group relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
            <div class="relative bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-4 rounded-2xl">
                        <i class="fas fa-bullseye text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900">Misi</h3>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-purple-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700">Menyelenggarakan pendidikan yang berkualitas dan inovatif</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-purple-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700">Membina karakter siswa dengan nilai-nilai akhlak mulia</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-purple-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700">Mendorong kreativitas dan keterampilan melalui kegiatan ekstrakurikuler</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-purple-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700">Menyediakan sarana belajar modern dan mendukung teknologi</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Programs Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 bg-orange-100 px-4 py-2 rounded-full mb-4">
            <i class="fas fa-graduation-cap text-orange-600"></i>
            <span class="text-sm font-bold text-orange-600">Program Keahlian</span>
        </div>
        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
            Pilihan <span class="text-orange-600">Kompetensi</span> Unggulan
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Berbagai program keahlian yang disesuaikan dengan kebutuhan industri modern
        </p>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white hover:scale-105 transition-transform cursor-pointer shadow-xl">
            <i class="fas fa-laptop-code text-5xl mb-4 opacity-80"></i>
            <h4 class="text-xl font-bold mb-2">Rekayasa Perangkat Lunak</h4>
            <p class="text-blue-100 text-sm">Pengembangan aplikasi & software</p>
        </div>
        
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white hover:scale-105 transition-transform cursor-pointer shadow-xl">
            <i class="fas fa-network-wired text-5xl mb-4 opacity-80"></i>
            <h4 class="text-xl font-bold mb-2">Teknik Komputer & Jaringan</h4>
            <p class="text-green-100 text-sm">Infrastruktur IT & networking</p>
        </div>
        
        <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 text-white hover:scale-105 transition-transform cursor-pointer shadow-xl">
            <i class="fas fa-fire text-5xl mb-4 opacity-80"></i>
            <h4 class="text-xl font-bold mb-2">Teknik Pengelasan Fabrikasi Logam</h4>
            <p class="text-orange-100 text-sm">Welding & metal fabrication</p>
        </div>
        
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white hover:scale-105 transition-transform cursor-pointer shadow-xl">
            <i class="fas fa-car text-5xl mb-4 opacity-80"></i>
            <h4 class="text-xl font-bold mb-2">Teknik Otomotif</h4>
            <p class="text-purple-100 text-sm">Perawatan & perbaikan kendaraan</p>
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

@endsection
