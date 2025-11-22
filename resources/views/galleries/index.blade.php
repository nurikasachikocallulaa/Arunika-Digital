@extends('layouts.admin_new')

@section('title', 'Galeri')
@section('page-title', 'Galeri')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Galeri</h2>
        <p class="text-gray-500 text-sm">Kelola foto-foto terbaik SMKN 4 Bogor dengan tampilan yang lebih modern.</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
            <i class="fas fa-images mr-2"></i>
            Total: {{ $galleries->total() }} foto
        </span>
        <a href="{{ route('galleries.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl shadow-sm text-sm font-semibold transition">
            <i class="fas fa-plus mr-2"></i>
            Tambah Galeri
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 flex items-center gap-2">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if($galleries->count() === 0)
    <div class="bg-white rounded-2xl border border-dashed border-gray-200 py-12 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-4">
            <i class="fas fa-images text-blue-500 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Belum ada foto galeri</h3>
        <p class="text-sm text-gray-500 mb-4 max-w-md">Mulai dokumentasikan momen kegiatan sekolah dengan menambahkan foto-foto terbaik ke dalam galeri.</p>
        <a href="{{ route('galleries.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm">
            <i class="fas fa-plus mr-2"></i>
            Tambah Foto Pertama
        </a>
    </div>
@else
    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($galleries as $gallery)
        <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $gallery->image) }}" 
                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Top badges -->
                <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 text-gray-800">
                        <i class="fas fa-tag mr-1 text-blue-500"></i>
                        {{ $gallery->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </div>

                <!-- Quick action: Edit & Hapus di pojok kanan atas gambar -->
                <div class="absolute top-3 right-3 flex items-center gap-2">
                    <a href="{{ route('galleries.edit', $gallery->id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/90 hover:bg-yellow-100 text-yellow-700 shadow-sm transition" title="Edit foto">
                        <i class="fas fa-edit text-sm"></i>
                    </a>
                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/90 hover:bg-red-100 text-red-600 shadow-sm transition" title="Hapus foto">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>

                <!-- Stats overlay -->
                <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs text-white/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="flex items-center gap-3 bg-black/40 rounded-full px-3 py-1">
                        <span class="inline-flex items-center gap-1">
                            <i class="fas fa-heart text-red-400"></i>
                            <span>{{ $gallery->likes_count ?? 0 }} Like</span>
                        </span>
                        <button type="button" onclick="showComments({{ $gallery->id }}, '{{ $gallery->title }}')" class="inline-flex items-center gap-1 hover:text-blue-200">
                            <i class="fas fa-comment"></i>
                            <span>{{ $gallery->comments_count ?? 0 }} Komentar</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-4 flex flex-col h-full">
                <h3 class="font-semibold text-gray-900 text-sm mb-1 line-clamp-2 group-hover:text-blue-600 transition-colors">
                    {{ $gallery->title }}
                </h3>
                <p class="text-xs text-gray-500 mb-3">
                    Diunggah: {{ $gallery->created_at ? $gallery->created_at->format('d M Y') : '-' }}
                </p>

                <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('galleries.show', $gallery->id) }}" class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium transition">
                            <i class="fas fa-eye mr-1"></i>
                            Detail
                        </a>
                        <a href="{{ route('galleries.edit', $gallery->id) }}" class="inline-flex items-center px-2.5 py-1 rounded-full bg-yellow-50 hover:bg-yellow-100 text-yellow-700 font-medium transition">
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </a>
                    </div>
                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 hover:bg-red-100 text-red-600 font-medium transition">
                            <i class="fas fa-trash mr-1"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $galleries->links() }}
    </div>
@endif

<!-- Modal Komentar -->
<div id="commentsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-3xl w-full max-h-[80vh] overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
            <h3 class="text-xl font-bold flex items-center gap-2">
                <i class="fas fa-comments"></i>
                <span id="modalTitle">Komentar</span>
            </h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <!-- Content -->
        <div class="p-6 overflow-y-auto max-h-[60vh]" id="commentsContent">
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-3xl text-gray-400"></i>
                <p class="text-gray-500 mt-2">Memuat komentar...</p>
            </div>
        </div>
    </div>
</div>

<script>
function showComments(galleryId, galleryTitle) {
    document.getElementById('modalTitle').textContent = `Komentar: ${galleryTitle}`;
    document.getElementById('commentsModal').classList.remove('hidden');
    
    // Load comments
    fetch(`/gallery/${galleryId}/comments`)
        .then(response => response.json())
        .then(comments => {
            const content = document.getElementById('commentsContent');
            
            if (comments.length === 0) {
                content.innerHTML = `
                    <div class="text-center py-8">
                        <i class="far fa-comment text-4xl text-gray-300"></i>
                        <p class="text-gray-500 mt-2">Belum ada komentar</p>
                    </div>
                `;
                return;
            }
            
            content.innerHTML = comments.map(comment => {
                let commenterName = 'Anonymous';
                let badge = '';
                
                if (comment.guest_name) {
                    commenterName = comment.guest_name;
                    badge = '<span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full ml-2">Tamu</span>';
                } else if (comment.user) {
                    commenterName = comment.user.name;
                    badge = '<span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full ml-2">User</span>';
                }
                
                return `
                    <div class="border-b pb-4 mb-4 last:border-b-0" id="comment-${comment.id}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="font-semibold text-gray-800">${commenterName}${badge}</span>
                                    ${comment.guest_email ? `<span class="text-xs text-gray-500">(${comment.guest_email})</span>` : ''}
                                    <span class="text-sm text-gray-500">${new Date(comment.created_at).toLocaleDateString('id-ID', { 
                                        year: 'numeric', 
                                        month: 'long', 
                                        day: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    })}</span>
                                </div>
                                <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">${comment.comment}</p>
                            </div>
                            <button onclick="deleteCommentFromModal(${comment.id})" 
                                    class="ml-4 px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('commentsContent').innerHTML = `
                <div class="text-center py-8 text-red-500">
                    <i class="fas fa-exclamation-triangle text-3xl"></i>
                    <p class="mt-2">Gagal memuat komentar</p>
                </div>
            `;
        });
}

function closeModal() {
    document.getElementById('commentsModal').classList.add('hidden');
}

function deleteCommentFromModal(commentId) {
    if (!confirm('Apakah Anda yakin ingin menghapus komentar ini?')) {
        return;
    }
    
    fetch(`/comments/${commentId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove from modal
            const commentElement = document.getElementById(`comment-${commentId}`);
            if (commentElement) {
                commentElement.style.transition = 'opacity 0.3s';
                commentElement.style.opacity = '0';
                setTimeout(() => commentElement.remove(), 300);
            }
            
            // Reload page to update counter
            setTimeout(() => location.reload(), 1000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal menghapus komentar');
    });
}

// Close modal when clicking outside
document.getElementById('commentsModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
