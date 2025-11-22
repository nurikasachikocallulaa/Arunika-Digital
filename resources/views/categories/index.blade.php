@extends('layouts.admin_new')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h2>
        <p class="text-gray-500 text-sm">Atur kategori galeri agar foto-foto tertata lebih rapi dan mudah ditemukan.</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
            <i class="fas fa-folder-open mr-2"></i>
            Total: {{ $categories->total() }} kategori
        </span>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl shadow-sm text-sm font-semibold transition">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kategori
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 flex items-center gap-2">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if($categories->count() === 0)
    <div class="bg-white rounded-2xl border border-dashed border-gray-200 py-12 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-4">
            <i class="fas fa-folder-open text-blue-500 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Belum ada kategori</h3>
        <p class="text-sm text-gray-500 mb-4 max-w-md">Buat kategori untuk mengelompokkan foto-foto galeri berdasarkan kegiatan, lokasi, atau keperluan lainnya.</p>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kategori Pertama
        </a>
    </div>
@else
    <!-- Categories Table - Single Table -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kategori</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Dibuat</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($categories as $category)
                    <tr class="odd:bg-white even:bg-gray-50/60 hover:bg-blue-50/60 transition-colors">
                        <td class="px-4 py-3 text-gray-500 text-center">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                        <td class="px-4 py-3 text-gray-900 font-medium">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-50 text-blue-600">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                                <span>{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-sm">
                            {{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="inline-flex items-center gap-2 text-xs">
                                <a href="{{ route('categories.edit', $category->id) }}" class="inline-flex items-center px-2.5 py-1 rounded-full bg-yellow-50 hover:bg-yellow-100 text-yellow-700 font-medium shadow-sm transition">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 hover:bg-red-100 text-red-600 font-medium shadow-sm transition">
                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endif

@endsection
