@extends('layouts.admin')

@section('title', 'Kelola Komentar')
@section('page-title', 'Kelola Komentar Galeri')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Komentar Galeri</h2>
        <p class="text-gray-600">Kelola komentar dari pengguna dan tamu. Anda dapat menghapus komentar yang tidak sesuai.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600 font-medium">Total Komentar</p>
                    <p class="text-2xl font-bold text-blue-700" id="totalComments">0</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-comments text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600 font-medium">Komentar User</p>
                    <p class="text-2xl font-bold text-green-700" id="userComments">0</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-purple-50 rounded-lg p-4 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-600 font-medium">Komentar Tamu</p>
                    <p class="text-2xl font-bold text-purple-700" id="guestComments">0</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-user-friends text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Filter -->
    <div class="mb-4 flex gap-2">
        <button onclick="filterComments('all')" id="filter-all" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Semua
        </button>
        <button onclick="filterComments('user')" id="filter-user" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            User
        </button>
        <button onclick="filterComments('guest')" id="filter-guest" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            Tamu
        </button>
    </div>

    <div class="space-y-4" id="commentsList">
        <!-- Comments will be loaded here via JavaScript -->
        <div class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-3xl text-gray-400"></i>
            <p class="text-gray-500 mt-2">Memuat komentar...</p>
        </div>
    </div>
</div>

<script>
let allComments = [];
let currentFilter = 'all';

document.addEventListener('DOMContentLoaded', function() {
    loadAllComments();
});

function loadAllComments() {
    fetch('/admin/comments', {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(comments => {
        allComments = comments;
        updateStatistics();
        displayComments(comments);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('commentsList').innerHTML = `
            <div class="text-center py-8 text-red-500">
                <i class="fas fa-exclamation-triangle text-3xl"></i>
                <p class="mt-2">Gagal memuat komentar</p>
            </div>
        `;
    });
}

function updateStatistics() {
    const total = allComments.length;
    const userCount = allComments.filter(c => c.user_id && !c.guest_name).length;
    const guestCount = allComments.filter(c => c.guest_name).length;
    
    document.getElementById('totalComments').textContent = total;
    document.getElementById('userComments').textContent = userCount;
    document.getElementById('guestComments').textContent = guestCount;
}

function displayComments(comments) {
    const commentsList = document.getElementById('commentsList');
    
    if (comments.length === 0) {
        commentsList.innerHTML = `
            <div class="text-center py-8">
                <i class="far fa-comment text-4xl text-gray-300"></i>
                <p class="text-gray-500 mt-2">Belum ada komentar</p>
            </div>
        `;
        return;
    }
    
    commentsList.innerHTML = comments.map(comment => {
        // Determine commenter name and badge
        let commenterName = 'Anonymous';
        let badge = '';
        let commentType = '';
        
        if (comment.guest_name) {
            commenterName = comment.guest_name;
            badge = '<span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full ml-2">Tamu</span>';
            commentType = 'guest';
        } else if (comment.user) {
            commenterName = comment.user.name;
            badge = '<span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full ml-2">User</span>';
            commentType = 'user';
        }
        
        // Gallery image
        const galleryImage = comment.gallery.image ? 
            `/storage/${comment.gallery.image}` : 
            'https://via.placeholder.com/100';
        
        return `
        <div class="border rounded-lg p-4 hover:bg-gray-50 transition comment-item" data-type="${commentType}" id="comment-${comment.id}">
            <div class="flex gap-4">
                <!-- Gallery Image -->
                <div class="flex-shrink-0">
                    <img src="${galleryImage}" alt="${comment.gallery.title}" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200">
                    <div class="mt-2 text-center">
                        <span class="text-xs text-gray-500">
                            <i class="fas fa-heart text-red-500"></i> ${comment.gallery.likes_count || 0}
                        </span>
                    </div>
                </div>
                
                <!-- Comment Content -->
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
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
                    <p class="text-gray-700 mb-3 bg-gray-50 p-3 rounded-lg">${comment.comment}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-image text-indigo-500"></i>
                                <strong>${comment.gallery.title}</strong>
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fas fa-comments text-blue-500"></i>
                                ${comment.gallery.comments_count || 0} komentar
                            </span>
                        </div>
                        <button onclick="deleteComment(${comment.id})" 
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center gap-2">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        `;
    }).join('');
}

function filterComments(type) {
    currentFilter = type;
    
    // Update button states
    document.querySelectorAll('[id^="filter-"]').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    document.getElementById(`filter-${type}`).classList.remove('bg-gray-200', 'text-gray-700');
    document.getElementById(`filter-${type}`).classList.add('bg-blue-600', 'text-white');
    
    // Filter comments
    let filtered = allComments;
    if (type === 'user') {
        filtered = allComments.filter(c => c.user_id && !c.guest_name);
    } else if (type === 'guest') {
        filtered = allComments.filter(c => c.guest_name);
    }
    
    displayComments(filtered);
}

function deleteComment(commentId) {
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
        // Remove comment from DOM
        const commentElement = document.getElementById(`comment-${commentId}`);
        if (commentElement) {
            commentElement.style.transition = 'opacity 0.3s';
            commentElement.style.opacity = '0';
            setTimeout(() => {
                commentElement.remove();
                
                // Check if no comments left
                const commentsList = document.getElementById('commentsList');
                if (commentsList.children.length === 0) {
                    commentsList.innerHTML = `
                        <div class="text-center py-8">
                            <i class="far fa-comment text-4xl text-gray-300"></i>
                            <p class="text-gray-500 mt-2">Belum ada komentar</p>
                        </div>
                    `;
                }
            }, 300);
        }
        
        // Show success message
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-200 text-green-800 p-3 rounded mb-4';
        successDiv.textContent = 'Komentar berhasil dihapus';
        document.querySelector('.bg-white').insertBefore(successDiv, document.getElementById('commentsList'));
        
        setTimeout(() => successDiv.remove(), 3000);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal menghapus komentar');
    });
}
</script>
@endsection
