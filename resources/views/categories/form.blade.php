<form action="{{ isset($gallery) ? route('galleries.update', $gallery->id) : route('galleries.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($gallery))
        @method('PUT')
    @endif

    <!-- Judul -->
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Judul</label>
        <input type="text" name="title" value="{{ $gallery->title ?? '' }}" class="w-full p-2 border rounded">
    </div>

    <!-- Kategori -->
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Kategori</label>
        <select name="category_id" class="w-full p-2 border rounded">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ isset($gallery) && $gallery->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Upload Gambar -->
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Foto</label>
        <input type="file" name="image" class="w-full p-2 border rounded">
        @if(isset($gallery) && $gallery->image)
            <img src="{{ asset('storage/'.$gallery->image) }}" class="mt-2 w-32 h-32 object-cover">
        @endif
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        {{ isset($gallery) ? 'Update Galeri' : 'Tambah Galeri' }}
    </button>
</form>
