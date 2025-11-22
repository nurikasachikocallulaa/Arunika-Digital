@extends('layouts.admin_new')

@section('title','Tambah Galeri')
@section('page-title','Tambah Galeri')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">Tambah Galeri Baru</h2>

    @if ($errors->any())
    <div class="mb-4 text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Judul Galeri -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Judul Galeri</label>
            <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <!-- Pilih Kategori -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
            <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Upload Foto -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Foto</label>
            <input type="file" name="image" id="imageInput" class="w-full border border-gray-300 rounded px-3 py-2" accept="image/jpeg,image/png,image/jpg,image/gif" required>
            <p class="text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG, GIF. Maksimal 15MB</p>
            
            <!-- Preview Image -->
            <div id="imagePreview" class="mt-3 hidden">
                <img id="preview" src="" alt="Preview" class="max-w-full h-48 object-cover rounded border">
            </div>
        </div>

        <button type="submit" id="submitBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Simpan
        </button>
    </form>
</div>

<script>
// Image preview and validation
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (file) {
        // Validate file size (15MB = 15360KB)
        if (file.size > 15360 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 15MB');
            this.value = '';
            previewContainer.classList.add('hidden');
            return;
        }
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            alert('Format file tidak valid! Gunakan JPG, PNG, atau GIF');
            this.value = '';
            previewContainer.classList.add('hidden');
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('hidden');
    }
});

// Prevent double submission
document.querySelector('form').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Mengupload...';
});
</script>
@endsection
