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

            <!-- Form Kontak (opsional) -->
            <div class="flex items-start space-x-4 bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="text-purple-600 text-2xl">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="w-full">
                    <h3 class="font-semibold text-gray-700 mb-2">Kirim Pesan</h3>
                    <form action="#" method="POST" class="space-y-3">
                        <input type="text" placeholder="Nama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <input type="email" placeholder="Email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <textarea placeholder="Pesan" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
