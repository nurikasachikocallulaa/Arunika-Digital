@extends('layouts.auth')

@section('title','Login User')

@section('content')
    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm p-8 rounded-xl shadow-2xl border border-gray-100">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4" class="w-20 h-20 object-contain mb-3">
            <h1 class="text-2xl font-bold text-center bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Login User</h1>
            <p class="text-center text-gray-500 text-sm">Silakan masuk untuk dapat menyukai dan berkomentar di galeri.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block font-medium mb-2 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border-0 border-b-2 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200 focus:border-blue-500' }}"
                       placeholder="contoh@email.com" required autofocus>
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-2 text-gray-700">Password</label>
                <input type="password" name="password"
                       class="w-full border-0 border-b-2 px-1 py-2.5 text-gray-700 bg-transparent focus:outline-none focus:ring-0 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200 focus:border-blue-500' }}"
                       placeholder="••••••••" required>
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-600 text-sm cursor-pointer gap-2">
                    <input type="checkbox" name="remember" class="h-4 w-4 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-sm">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Lupa password?</a>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-purple-500 transition-all duration-300">
                Login
            </button>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                    Daftar Akun <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </form>
    </div>
@endsection
