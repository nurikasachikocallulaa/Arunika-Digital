@extends('layouts.admin_new')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')
<div class="mb-4">
    <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Tambah Kategori
    </a>
</div>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full border">
        <thead class="bg-blue-900 text-white">
            <tr>
                <th class="p-3 border w-12">#</th>
                <th class="p-3 border text-left">Nama Kategori</th>
                <th class="p-3 border text-center w-40">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                    <td class="p-3 border">{{ $category->name }}</td>
                    <td class="p-3 border text-center space-x-3">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">Belum ada kategori</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection
