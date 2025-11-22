@extends('layouts.guest')
@section('title','Kontak')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Kontak Kami</h1>
        <p class="text-gray-600 mb-6">Silakan hubungi kami melalui informasi berikut:</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Alamat -->
            <div class="flex items-start space-x-4 bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="text-blue-600 text-2xl">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Alamat</h3>
                    <p class="text-gray-500">Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan, RT.03/RW.08, Muarasari, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16137</p>
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

            <!-- Lokasi (embed Google Maps) -->
            <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition md:col-span-2">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="text-indigo-600 text-2xl">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Lokasi di Google Maps</h3>
                        <p class="text-gray-500 text-sm">Peta lokasi SMKN 4 Bogor (Nebrazka).</p>
                    </div>
                </div>
                <div class="w-full h-72 md:h-96 rounded-lg overflow-hidden border border-gray-200">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253635.1897317708!2d106.53630278671872!3d-6.640733399999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1763427493502!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
