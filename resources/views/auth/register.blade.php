@extends('layouts.auth')

@section('title','Register Admin')

@section('content')
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow border border-gray-100">
        <!-- Logo SMKN 4 -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4" class="w-20 h-20 object-contain mb-3">
            <h1 class="text-2xl font-bold text-center text-gray-800">Daftar Admin</h1>
            <p class="text-center text-sm text-gray-500">SMK Negeri 4 Bogor</p>
        </div>

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
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

            <!-- Email -->
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

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500 relative">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input id="reg_password" type="password" name="password" 
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400 pr-8" 
                           placeholder="Minimal 8 karakter" required>
                    <button type="button" id="toggleRegPassword" class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500">
                        <i class="fas fa-eye text-sm" id="toggleRegPasswordIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Konfirmasi Password</label>
                <div class="flex items-center border border-gray-200 rounded-lg bg-white px-3 py-2.5 shadow-sm focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500 relative">
                    <span class="text-blue-500 mr-2 text-sm">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input id="reg_password_confirmation" type="password" name="password_confirmation" 
                           class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400 pr-8" 
                           placeholder="Ulangi password" required>
                    <button type="button" id="toggleRegPasswordConfirmation" class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500">
                        <i class="fas fa-eye text-sm" id="toggleRegPasswordConfirmationIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-purple-500 transition-all duration-300 transform hover:-translate-y-0.5">
                Daftar
            </button>

            <!-- Login Link Admin -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-500">Sudah punya akun admin? 
                    <a href="{{ route('admin.login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition-colors">
                        Masuk Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('reg_password');
            const togglePassword = document.getElementById('toggleRegPassword');
            const togglePasswordIcon = document.getElementById('toggleRegPasswordIcon');

            const confirmInput = document.getElementById('reg_password_confirmation');
            const toggleConfirm = document.getElementById('toggleRegPasswordConfirmation');
            const toggleConfirmIcon = document.getElementById('toggleRegPasswordConfirmationIcon');

            if (passwordInput && togglePassword && togglePasswordIcon) {
                togglePassword.addEventListener('click', function (e) {
                    e.preventDefault();

                    const isHidden = passwordInput.type === 'password';
                    passwordInput.type = isHidden ? 'text' : 'password';

                    if (isHidden) {
                        togglePasswordIcon.classList.remove('fa-eye');
                        togglePasswordIcon.classList.add('fa-eye-slash');
                    } else {
                        togglePasswordIcon.classList.remove('fa-eye-slash');
                        togglePasswordIcon.classList.add('fa-eye');
                    }
                });
            }

            if (confirmInput && toggleConfirm && toggleConfirmIcon) {
                toggleConfirm.addEventListener('click', function (e) {
                    e.preventDefault();

                    const isHidden = confirmInput.type === 'password';
                    confirmInput.type = isHidden ? 'text' : 'password';

                    if (isHidden) {
                        toggleConfirmIcon.classList.remove('fa-eye');
                        toggleConfirmIcon.classList.add('fa-eye-slash');
                    } else {
                        toggleConfirmIcon.classList.remove('fa-eye-slash');
                        toggleConfirmIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
@endsection
