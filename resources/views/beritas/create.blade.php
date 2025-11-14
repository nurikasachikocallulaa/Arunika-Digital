@extends('layouts.admin_new')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor {
        min-height: 200px;
        font-size: 16px;
        line-height: 1.6;
    }
    .image-preview {
        display: none;
        max-width: 100%;
        height: auto;
        margin-top: 1rem;
        border-radius: 0.5rem;
        border: 2px dashed #e2e8f0;
    }
    .drop-zone {
        border: 2px dashed #cbd5e0;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }
    .drop-zone:hover {
        border-color: #4299e1;
        background-color: #ebf8ff;
    }
    .drop-zone.dragover {
        background-color: #ebf8ff;
        border-color: #63b3ed;
    }
    .file-input {
        display: none;
    }
    .file-label {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #edf2f7;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .file-label:hover {
        background-color: #e2e8f0;
    }
</style>
@endpush

@section('content')
<div class="bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-white">Tambah Berita</h2>
                <p class="text-blue-100 text-sm">Isi form di bawah untuk menambahkan berita baru</p>
            </div>
            <a href="{{ route('beritas.index') }}" class="text-white hover:text-blue-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Terdapat {{ $errors->count() }} kesalahan pada pengisian form:
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Judul -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                   placeholder="Masukkan judul berita" required>
            <p class="mt-1 text-xs text-gray-500">Maksimal 200 karakter</p>
        </div>

        <!-- Gambar -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
            
            <!-- Drop Zone -->
            <div id="dropZone" class="drop-zone mb-3">
                <div class="space-y-3">
                    <div class="mx-auto w-16 h-16 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center bg-white">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex text-sm text-gray-600 justify-center">
                        <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none px-2">
                            <span>Pilih file</span>
                            <input id="image-upload" name="image" type="file" class="sr-only file-input" accept="image/png,image/jpeg,image/jpg">
                        </label>
                        <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500 text-center">PNG, JPG, JPEG (Maks. 5MB)</p>
                </div>
            </div>
            
            <!-- Image Preview -->
            <div class="mt-2">
                <img id="imagePreview" class="image-preview max-h-64 mx-auto hidden" alt="Preview Gambar">
            </div>
            
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konten -->
        <div class="mb-8">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi Berita <span class="text-red-500">*</span></label>
            <div class="bg-white rounded-lg border border-gray-300 overflow-hidden">
                <div id="editor" style="min-height: 300px;">{{ old('content') }}</div>
            </div>
            <textarea name="content" id="content" class="hidden">{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end pt-6 border-t border-gray-200">
            <a href="{{ route('beritas.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                Batal
            </a>
            <button type="submit" class="ml-3 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .ql-toolbar {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        border: 1px solid #e2e8f0;
        border-bottom: none;
    }
    .ql-container {
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        border: 1px solid #e2e8f0;
        border-top: none;
        min-height: 300px;
    }
    .drop-zone {
        border: 2px dashed #cbd5e0;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        background: #f8fafc;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .drop-zone:hover {
        border-color: #93c5fd;
        background: #f0f9ff;
    }
    .drop-zone.dragover {
        border-color: #3b82f6;
        background: #dbeafe;
    }
    .image-preview {
        max-width: 100%;
        max-height: 400px;
        margin-top: 1rem;
        border-radius: 0.5rem;
        display: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor with fallback
    const contentField = document.querySelector('#content');
    let quill = null;
    try {
        quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tulis isi berita di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['link', 'image', 'video'],
                    ['clean'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                ]
            },
        });
        if (contentField.value) {
            quill.root.innerHTML = contentField.value;
        } else {
            quill.root.innerHTML = '';
        }
        quill.on('text-change', function() {
            contentField.value = quill.root.innerHTML;
        });
    } catch (err) {
        console.warn('Gagal memuat Quill, menggunakan textarea biasa', err);
        const editorDiv = document.getElementById('editor');
        if (editorDiv) {
            editorDiv.outerHTML = '<textarea id="content_fallback" name="content" class="w-full p-3 min-h-[300px] border-0 focus:ring-0" placeholder="Tulis isi berita di sini...">' + (contentField.value || '') + '</textarea>';
        }
    }

    // Form submission
    const form = document.querySelector('form');
    form.onsubmit = function(e) {
        // Update content before form submission
        if (quill) {
            contentField.value = quill.root.innerHTML;
        }

        // Validate content (Quill atau fallback)
        const textLen = quill ? quill.getText().trim().length : (document.getElementById('content_fallback')?.value.trim().length || 0);
        if (textLen === 0) {
            e.preventDefault();
            alert('Silakan isi konten berita');
            return false;
        }
        // Tidak wajib gambar di sisi klien
        return true;
    };

    // Image upload handling
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('image-upload');
    const imagePreview = document.getElementById('imagePreview');
    const fileLabel = dropZone ? dropZone.querySelector('span') : null;

    // Handle drag and drop events
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function highlight() {
        dropZone.classList.add('dragover');
    }

    function unhighlight() {
        dropZone.classList.remove('dragover');
    }

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Handle dropped files
    dropZone.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length) {
            fileInput.files = files;
            handleFiles(files);
        }
    });

    // Handle file input change
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            handleFiles(this.files);
        }
    });

    // Make the entire drop zone clickable
    dropZone.addEventListener('click', function() {
        fileInput.click();
    });

    function handleFiles(files) {
        const file = files[0];
        if (!file) return;

        // Check file type
        if (!file.type || !file.type.match('image.*')) {
            alert('Hanya file gambar yang diperbolehkan (JPEG, PNG, JPG)');
            return;
        }
        
        // Check file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 5MB');
            return;
        }

        // Update file name display
        if (fileLabel) fileLabel.textContent = file.name;

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            dropZone.style.display = 'none';
        }
        reader.onerror = function() {
            alert('Gagal memuat pratinjau gambar');
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
