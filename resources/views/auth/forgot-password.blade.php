@extends('layouts.auth')

@section('title','Lupa Password')

@section('content')
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow border border-gray-100">
        <!-- Header -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4" class="w-20 h-20 object-contain mb-3">
            <h1 class="text-2xl font-bold text-center text-gray-800">Lupa Password</h1>
            <p class="text-center text-sm text-gray-500 mt-1">Masukkan email admin Anda untuk mereset password.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-100 px-3 py-2 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-1 {{ $errors->has('email') ? 'text-red-600' : 'text-gray-700' }}">Email</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400"
                           placeholder="Masukkan email Anda" required autofocus>
                </div>
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Kirim -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-purple-500 transition-all duration-300 transform hover:-translate-y-0.5 text-sm">
                Kirim Link Reset Password
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800">Kembali ke login</a>
            </div>
        </form>
    </div>
@endsection
