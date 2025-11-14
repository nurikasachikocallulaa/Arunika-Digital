@extends('layouts.admin_new')

@section('title', 'Galeri')
@section('page-title', 'Galeri')

@section('content')
<div class="mb-4">
    <a href="{{ route('galleries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Galeri</a>
</div>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="grid grid-cols-3 gap-6">
    @foreach($galleries as $gallery)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="font-bold text-lg mb-2">{{ $gallery->title }}</h3>
            <p class="text-sm text-gray-600 mb-3">{{ $gallery->category->name ?? 'Tanpa Kategori' }}</p>
            
            <!-- Like & Comment Stats -->
            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3 pb-3 border-b">
                <div class="flex items-center gap-1">
                    <i class="fas fa-heart text-red-500"></i>
                    <span>{{ $gallery->likes_count ?? 0 }} Likes</span>
                </div>
                <button onclick="showComments({{ $gallery->id }}, '{{ $gallery->title }}')" 
                        class="flex items-center gap-1 hover:text-blue-700 transition cursor-pointer">
                    <i class="fas fa-comment text-blue-500"></i>
                    <span class="font-semibold">{{ $gallery->comments_count ?? 0 }} Komentar</span>
                </button>
            </div>
            
            <div class="mt-2 flex justify-between items-center">
                <a href="{{ route('galleries.show', $gallery->id) }}" class="text-blue-600 hover:underline">Detail</a>
                <a href="{{ route('galleries.edit', $gallery->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $galleries->links() }}
</div>

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
