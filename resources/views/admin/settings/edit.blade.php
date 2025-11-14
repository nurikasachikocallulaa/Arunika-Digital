@extends('layouts.admin_new')

@section('title', 'Pengaturan Situs')

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-white">⚙️ Pengaturan Situs</h2>
                <p class="text-blue-100 text-sm">Kelola informasi kontak dan lokasi</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.settings.update', $settings->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Kiri -->
            <div class="space-y-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $settings->phone) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Contoh: +62 123 4567 890" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $settings->email) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Contoh: info@smkn4bogor.sch.id" required>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                    <textarea id="address" name="address" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                              placeholder="Masukkan alamat lengkap" required>{{ old('address', $settings->address) }}</textarea>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-6">
                <div>
                    <label for="facebook" class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                    <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $settings->facebook) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="https://facebook.com/username">
                </div>

                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $settings->instagram) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="https://instagram.com/username">
                </div>

                <div>
                    <label for="youtube" class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                    <input type="url" id="youtube" name="youtube" value="{{ old('youtube', $settings->youtube) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="https://youtube.com/c/username">
                </div>
            </div>
        </div>

        <!-- Peta -->
        <div class="mt-6">
            <label for="map_embed" class="block text-sm font-medium text-gray-700 mb-1">Embed Peta <span class="text-red-500">*</span></label>
            <textarea id="map_embed" name="map_embed" rows="4" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 font-mono text-sm"
                      placeholder='&lt;iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d...' required>{{ old('map_embed', $settings->map_embed) }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Salin kode embed dari Google Maps dan tempel di sini.</p>
            
            <!-- Preview Peta -->
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Pratinjau Peta:</p>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    {!! $settings->map_embed !!}
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
            <button type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
