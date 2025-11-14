@extends('layouts.admin_new')

@section('title', 'Petugas')
@section('page-title', 'Manajemen Petugas')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-1">Petugas</h2>
                <p class="text-blue-100">Kelola akun petugas/admin sistem</p>
            </div>
            <a href="#" class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-white text-blue-700 font-semibold shadow hover:bg-blue-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                </svg>
                Tambah Petugas
            </a>
        </div>
    </div>

    <!-- List Section Placeholder -->
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Petugas</h3>
            <div class="text-sm text-gray-500">Coming soon</div>
        </div>
        <div class="border-2 border-dashed border-gray-200 rounded-xl p-10 text-center text-gray-500">
            Belum ada data. Fitur CRUD Petugas bisa ditambahkan di sini (tabel, pencarian, dan aksi edit/hapus).
        </div>
    </div>
</div>
@endsection
