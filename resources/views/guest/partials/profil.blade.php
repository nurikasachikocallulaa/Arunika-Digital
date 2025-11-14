@extends('layouts.guest')
@section('title','Profil')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-md p-8 flex flex-col md:flex-row items-center gap-6">
        <img src="{{ asset('images/school-logo.png') }}" alt="Logo SMKN 4 Bogor" class="w-32 h-32 object-cover rounded-full border-2 border-gray-300">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">SMKN 4 BOGOR</h1>
            <p class="text-gray-600 text-lg md:text-xl">Mencetak generasi unggul dengan akhlak mulia dan ilmu pengetahuan.</p>
        </div>
    </div>

    <!-- About Section -->
    <div class="bg-gray-50 rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tentang Sekolah</h2>
        <p class="text-gray-700 leading-relaxed mb-4">
            SMKN 4 BOGOR adalah lembaga pendidikan yang fokus pada pengembangan karakter, keterampilan, dan ilmu pengetahuan bagi para siswa.
            Kami menyediakan sarana belajar modern dan mendukung kegiatan ekstrakurikuler yang beragam.
        </p>
        <p class="text-gray-700 leading-relaxed">
            Website ini memberikan informasi lengkap mengenai berita, agenda, pengumuman, dan galeri kegiatan sekolah, sehingga seluruh civitas dan masyarakat dapat mengikuti perkembangan sekolah dengan mudah.
        </p>
    </div>

    <!-- Vision & Mission Section -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200 hover:shadow-lg transition duration-300">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Visi</h3>
            <p class="text-gray-700">
                Menjadi sekolah kejuruan unggulan yang menghasilkan lulusan berkompeten, berakhlak mulia, dan siap menghadapi tantangan global.
            </p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200 hover:shadow-lg transition duration-300">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Misi</h3>
            <ul class="list-disc ml-5 text-gray-700 space-y-1">
                <li>Menyelenggarakan pendidikan yang berkualitas dan inovatif.</li>
                <li>Membina karakter siswa dengan nilai-nilai akhlak mulia.</li>
                <li>Mendorong kreativitas dan keterampilan melalui kegiatan ekstrakurikuler.</li>
                <li>Menyediakan sarana belajar yang modern dan mendukung teknologi.</li>
            </ul>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="bg-gray-50 rounded-xl shadow-md p-8 grid md:grid-cols-3 gap-6">
        <div class="flex flex-col items-center text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
            </svg>
            <h4 class="font-semibold text-gray-800">Alamat</h4>
            <p class="text-gray-600 text-sm">Jl. Raya Bogor No.123, Bogor, Indonesia</p>
        </div>
        <div class="flex flex-col items-center text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m0 8l-4-4"/>
            </svg>
            <h4 class="font-semibold text-gray-800">Email</h4>
            <p class="text-gray-600 text-sm">info@smkn4bogor.sch.id</p>
        </div>
        <div class="flex flex-col items-center text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M3 12h18M3 19h18"/>
            </svg>
            <h4 class="font-semibold text-gray-800">Telepon</h4>
            <p class="text-gray-600 text-sm">+62 251 123456</p>
        </div>
    </div>
</div>
@endsection
