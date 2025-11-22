@extends('layouts.admin_new')

@section('title', 'Edit Petugas')
@section('page-title', 'Edit Petugas')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Petugas</h1>

    <form action="{{ route('admin.petugas.update', $petuga->id) }}" method="POST" class="bg-white shadow rounded p-4 max-w-xl">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Nama<span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama', $petuga->nama) }}" class="w-full border rounded px-3 py-2 text-sm" required>
            @error('nama')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Jabatan / Role<span class="text-red-500">*</span></label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $petuga->jabatan) }}" class="w-full border rounded px-3 py-2 text-sm" required>
            @error('jabatan')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $petuga->email) }}" class="w-full border rounded px-3 py-2 text-sm">
            @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.petugas.index') }}" class="text-gray-600 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
