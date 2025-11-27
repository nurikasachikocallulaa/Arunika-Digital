@extends('layouts.auth')

@section('title','Daftar User')

@section('content')
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow border border-gray-100">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4" class="w-20 h-20 object-contain mb-3">
            <h1 class="text-2xl font-bold text-center text-gray-800">Daftar User</h1>
            <p class="text-center text-sm text-gray-500">SMK Negeri 4 Bogor</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Nama Lengkap</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400"
                           placeholder="Masukkan nama Anda" required autofocus>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400"
                           placeholder="Masukkan email Anda" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password"
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400"
                           placeholder="Minimal 8 karakter" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Konfirmasi Password</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password_confirmation"
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400"
                           placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-purple-500 transition-all duration-300">
                Daftar
            </button>

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
