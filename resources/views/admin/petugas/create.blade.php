@extends('layouts.admin_new')

@section('title', 'Tambah Petugas')
@section('page-title', 'Tambah Petugas')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Petugas</h1>

    <form action="{{ route('admin.petugas.store') }}" method="POST" class="bg-white shadow rounded p-4 max-w-xl">
        @csrf

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Nama<span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2 text-sm" required>
            @error('nama')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Jabatan / Role<span class="text-red-500">*</span></label>
            <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="w-full border rounded px-3 py-2 text-sm" required>
            @error('jabatan')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Email<span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2 text-sm" required>
            @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Password Akun Login<span class="text-red-500">*</span></label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 text-sm" required>
            @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Konfirmasi Password<span class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.petugas.index') }}" class="text-gray-600 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
