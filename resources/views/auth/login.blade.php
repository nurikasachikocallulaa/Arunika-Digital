@extends('layouts.auth')

@section('title','Login Admin')

@section('content')
    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm p-8 rounded-xl shadow-2xl border border-gray-100 transform transition-all duration-300 hover:shadow-2xl hover:shadow-gray-200/50">
        <!-- Logo SMKN 4 -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4" class="w-24 h-24 object-contain mb-4">
            <h1 class="text-3xl font-bold text-center bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Selamat Datang</h1>
            <p class="text-center text-gray-500">SMK Negeri 4 Bogor</p>
            <p class="text-center text-sm text-gray-400 mt-2">Silakan masuk ke akun admin Anda</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block font-medium mb-2 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border-0 border-b-2 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 transition-colors peer {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200 focus:border-blue-500' }}"
                       placeholder="contoh@email.com" required autofocus>
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block font-medium mb-2 text-gray-700">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password"
                           class="w-full border-0 border-b-2 px-1 py-2.5 pr-10 text-gray-700 bg-transparent focus:outline-none focus:ring-0 transition-colors peer {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200 focus:border-blue-500' }}"
                           placeholder="••••••••" required>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center text-gray-500 text-xs">
                        Lihat
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-600 text-sm cursor-pointer">
                    <div class="relative inline-block w-10 mr-2 align-middle select-none">
                        <input type="checkbox" name="remember" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer transition-all duration-200 ease-in-out" />
                        <label for="remember" class="toggle-label block overflow-hidden h-5 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <span class="text-sm">Ingat saya</span>
                </label>
                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">Lupa password?</a>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-purple-500 transition-all duration-300 transform hover:-translate-y-0.5">
                Login
            </button>

            <!-- Register -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                    Buat Akun Baru <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        if (passwordInput && toggleButton) {
            toggleButton.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                toggleButton.textContent = isHidden ? 'Sembunyi' : 'Lihat';
            });
        }
    });
</script>
@endsection
