@extends('layouts.admin_new')

@section('title', 'Petugas')
@section('page-title', 'Data Petugas')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Data Petugas</h1>
        <a href="{{ route('admin.petugas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Petugas</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Jabatan</th>
                    <th class="px-4 py-2">No HP</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $p->nama }}</td>
                        <td class="px-4 py-2">{{ $p->jabatan }}</td>
                        <td class="px-4 py-2">{{ $p->no_hp }}</td>
                        <td class="px-4 py-2">{{ $p->email }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.petugas.edit', $p->id) }}" class="px-3 py-1 text-xs bg-yellow-400 text-white rounded">Edit</a>
                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus petugas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-xs bg-red-600 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada data petugas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $petugas->links() }}
    </div>
</div>
@endsection
