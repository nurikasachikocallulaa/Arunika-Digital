@extends('layouts.auth')

@section('title','Register Admin')

@section('content')
    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm p-8 rounded-xl shadow-2xl border border-gray-100 transform transition-all duration-300 hover:shadow-2xl hover:shadow-gray-200/50">
        <!-- Logo SMKN 4 -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4" class="w-24 h-24 object-contain mb-4">
            <h1 class="text-3xl font-bold text-center bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Daftar Admin</h1>
            <p class="text-center text-gray-500">SMK Negeri 4 Bogor</p>
            <p class="text-center text-sm text-gray-400 mt-2">Buat akun admin baru</p>
        </div>

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block font-medium mb-2 text-gray-700">Nama</label>
                <input type="text" 
                       name="name" 
                       class="w-full border-0 border-b-2 border-gray-200 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 focus:border-blue-500 transition-colors" 
                       required 
                       autofocus>
            </div>

            <!-- Email -->
            <div>
                <label class="block font-medium mb-2 text-gray-700">Email</label>
                <input type="email" 
                       name="email" 
                       class="w-full border-0 border-b-2 border-gray-200 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 focus:border-blue-500 transition-colors" 
                       required>
            </div>

            <!-- Password -->
            <div>
                <label class="block font-medium mb-2 text-gray-700">Password</label>
                <input type="password" 
                       name="password" 
                       class="w-full border-0 border-b-2 border-gray-200 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 focus:border-blue-500 transition-colors" 
                       required>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block font-medium mb-2 text-gray-700">Konfirmasi Password</label>
                <input type="password" 
                       name="password_confirmation" 
                       class="w-full border-0 border-b-2 border-gray-200 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 focus:border-blue-500 transition-colors" 
                       required>
            </div>

            <!-- Register Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-purple-500 transition-all duration-300 transform hover:-translate-y-0.5">
                Daftar
            </button>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-500">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition-colors">
                        Masuk Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection
