@extends('layouts.admin_new')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita: ' . Str::limit($berita->title, 30))

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor {
        min-height: 200px;
        font-size: 16px;
        line-height: 1.6;
    }
    .image-preview {
        max-width: 100%;
        height: auto;
        margin-top: 1rem;
        border-radius: 0.5rem;
        border: 2px dashed #e2e8f0;
    }
</style>
@endpush

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor {
        min-height: 200px;
        font-size: 16px;
        line-height: 1.6;
    }
    .image-preview {
        max-width: 100%;
        height: auto;
        margin-top: 1rem;
        border-radius: 0.5rem;
        border: 2px dashed #e2e8f0;
    }
    .current-image {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        border: 2px solid #e2e8f0;
        margin-bottom: 1rem;
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
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-white">✏️ Edit Berita</h2>
                <p class="text-blue-100 text-sm">Perbarui informasi berita yang ada</p>
            </div>
            <a href="{{ route('beritas.index') }}" class="text-white hover:text-blue-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $berita->id }}">

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
            <input type="text" id="title" name="title" value="{{ old('title', $berita->title) }}" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                   placeholder="Masukkan judul berita" required>
            <p class="mt-1 text-xs text-gray-500">Maksimal 200 karakter</p>
        </div>

        <!-- Gambar -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
            
            @if($berita->image)
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini:</p>
                <div class="relative inline-block">
                    <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="current-image max-h-64">
                    <div class="absolute top-2 right-2 bg-white/80 rounded-full p-1 shadow">
                        <button type="button" id="removeImage" class="text-red-600 hover:text-red-800 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="remove_image" id="removeImageInput" value="0">
            </div>
            @endif
            
            <!-- Drop Zone -->
            <div id="dropZone" class="drop-zone mb-3 {{ $berita->image ? 'hidden' : '' }}">
                <div class="space-y-2">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                            <span>Unggah file</span>
                            <input id="image-upload" name="image" type="file" class="sr-only file-input">
                        </label>
                        <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 5MB)</p>
                </div>
            </div>
            
            <!-- Image Preview -->
            <div class="mt-2">
                <img id="imagePreview" class="image-preview max-h-64 mx-auto hidden" alt="Preview Gambar">
            </div>
            
            @if(!$berita->image)
            <button type="button" id="showUploadSection" class="mt-2 text-sm text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Gambar
            </button>
            @endif
        </div>

        <!-- Konten -->
        <div class="mb-8">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi Berita <span class="text-red-500">*</span></label>
            <div id="editor" style="min-height: 300px;">{!! old('content', $berita->content) !!}</div>
            <textarea name="content" id="content" class="hidden">{!! old('content', $berita->content) !!}</textarea>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <div>
                <a href="{{ route('beritas.show', $berita->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Berita
                </a>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('beritas.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Initialize Quill editor
    const quill = new Quill('#editor', {
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

    // Set initial content from textarea
    const contentTextarea = document.querySelector('textarea#content');
    if (contentTextarea && contentTextarea.value) {
        quill.clipboard.dangerouslyPasteHTML(contentTextarea.value);
    }

    // Update textarea on form submit and any editor change
    const form = document.querySelector('form');
    form.onsubmit = function(e) {
        const content = document.querySelector('#content');
        content.value = quill.root.innerHTML;
        
        // Debug: Log the content to console
        console.log('Content being saved:', content.value);
    };
    
    // Also update on editor change
    quill.on('text-change', function() {
        const content = document.querySelector('#content');
        content.value = quill.root.innerHTML;
    });
    
    // Debug: Log initial content
    console.log('Initial content:', quill.root.innerHTML);

    // Image upload handling
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('image-upload');
    const imagePreview = document.getElementById('imagePreview');
    const showUploadSection = document.getElementById('showUploadSection');
    const removeImageBtn = document.getElementById('removeImage');
    const removeImageInput = document.getElementById('removeImageInput');
    const currentImageContainer = document.querySelector('.current-image')?.parentElement?.parentElement;

    // Toggle upload section
    if (showUploadSection) {
        showUploadSection.addEventListener('click', function() {
            dropZone.classList.remove('hidden');
            this.classList.add('hidden');
        });
    }

    // Handle remove image
    if (removeImageBtn && removeImageInput && currentImageContainer) {
        removeImageBtn.addEventListener('click', function() {
            currentImageContainer.remove();
            dropZone.classList.remove('hidden');
            removeImageInput.value = '1';
        });
    }

    // Handle drag and drop
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropZone.classList.add('dragover');
        }

        function unhighlight() {
            dropZone.classList.remove('dragover');
        }

        // Handle dropped files
        dropZone.addEventListener('drop', handleDrop, false);
        fileInput.addEventListener('change', handleFiles, false);
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles({ target: { files: files } });
    }

    function handleFiles(e) {
        const files = e.target.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    
                    // Hide current image if exists
                    if (currentImageContainer) {
                        currentImageContainer.remove();
                        if (removeImageInput) {
                            removeImageInput.value = '1';
                        }
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    }

    // Show file name when selected
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih';
            const fileLabel = dropZone.querySelector('span');
            if (fileLabel) {
                fileLabel.textContent = fileName;
            }
        });
    }
</script>
@endpush
