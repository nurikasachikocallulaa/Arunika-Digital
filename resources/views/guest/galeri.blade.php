@extends('layouts.guest')
@section('title', isset($category) ? $category->name : 'Galeri SMKN 4 BOGOR')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- Judul -->
    <h1 class="text-3xl font-bold mb-6 text-center">
        {{ isset($category) ? 'Galeri: '.$category->name : 'Galeri Kegiatan' }}
    </h1>

    <!-- Kategori -->
    <div class="mb-6 flex flex-wrap gap-3 justify-center">
        @foreach($categories as $cat)
            <a href="{{ url('/galeri?kategori='.$cat->id) }}"
               class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full hover:bg-blue-100 transition font-medium">
               {{ $cat->name }}
            </a>
        @endforeach
    </div>
    
    <!-- Galeri - Simple Clean Style -->
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden">
                    <!-- Image Container with Double Tap -->
                    <div class="relative group cursor-pointer" 
                         ondblclick="doubleTapLike({{ $gallery->id }})"
                         onclick="showInstagramComments({{ $gallery->id }})">
                        @if($gallery->image)
                            <img src="{{ asset('storage/'.$gallery->image) }}"
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-64 object-cover"
                                 id="img-{{ $gallery->id }}">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Double Tap Heart Animation -->
                        <div id="heart-animation-{{ $gallery->id }}" 
                             class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 transition-opacity duration-300">
                            <i class="fas fa-heart text-white text-8xl drop-shadow-lg"></i>
                        </div>
                    </div>
                    
                    <!-- Gallery Info -->
                    <div class="p-4">
                        <!-- Title -->
                        <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $gallery->title }}</h3>
                        
                        <!-- Category -->
                        <p class="text-gray-600 text-sm mb-3">{{ $gallery->category->name ?? 'Tanpa Kategori' }}</p>
                        
                        <!-- Like & Comment Stats (Clickable) -->
                        <div class="flex items-center gap-4 text-sm">
                            <button onclick="event.stopPropagation(); toggleLike({{ $gallery->id }})" 
                                    class="flex items-center gap-1 hover:text-red-500 transition"
                                    id="like-btn-{{ $gallery->id }}">
                                <i class="far fa-heart text-red-500" id="like-icon-{{ $gallery->id }}"></i>
                                <span class="text-gray-700" id="like-count-{{ $gallery->id }}">{{ $gallery->likes_count ?? 0 }} Likes</span>
                            </button>
                            <button onclick="event.stopPropagation(); showInstagramComments({{ $gallery->id }})" 
                                    class="flex items-center gap-1 hover:text-blue-500 transition">
                                <i class="far fa-comment text-blue-500"></i>
                                <span class="text-gray-700" id="comment-count-display-{{ $gallery->id }}">{{ $gallery->comments_count ?? 0 }} Komentar</span>
                            </button>
                            @if($gallery->image)
                            <a href="{{ route('guest.galeri.download', $gallery->id) }}" 
                               onclick="event.stopPropagation();"
                               class="flex items-center gap-1 hover:text-green-500 transition ml-auto"
                               title="Download Foto">
                                <i class="fas fa-download text-green-600"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $galleries->links() }}
        </div>
    @else
        <p class="text-gray-500 text-center mt-6">Belum ada galeri {{ isset($category) ? 'di kategori ini' : '' }}.</p>
    @endif

</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <i class="fas fa-times text-2xl"></i>
        </button>
        
        <!-- Image Container -->
        <div class="relative bg-white rounded-lg overflow-hidden shadow-2xl">
            <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
            
            <!-- Image Info -->
            <div class="p-4 bg-white">
                <h3 id="lightbox-title" class="text-xl font-bold text-gray-800 mb-2"></h3>
                <p id="lightbox-date" class="text-gray-600 text-sm mb-3"></p>
                
                <!-- Like & Comment in Lightbox -->
                <div class="flex items-center gap-4 text-sm border-t pt-3">
                    <button onclick="event.stopPropagation(); toggleLike(window.currentGalleryId)" 
                            class="flex items-center gap-2 hover:text-red-500 transition"
                            id="lightbox-like-btn">
                        <i class="far fa-heart" id="lightbox-like-icon"></i>
                        <span id="lightbox-like-count">0</span>
                    </button>
                    <button onclick="event.stopPropagation(); showComments(window.currentGalleryId)" 
                            class="flex items-center gap-2 hover:text-blue-500 transition">
                        <i class="far fa-comment"></i>
                        <span id="lightbox-comment-count">0</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Navigation Buttons -->
        <button onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-colors">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-colors">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Instagram-Style Comments Modal -->
<div id="instagramModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-5xl w-full h-[85vh] overflow-hidden flex">
        <!-- Left Side - Image -->
        <div class="w-3/5 bg-black flex items-center justify-center">
            <img id="instagram-modal-image" src="" alt="" class="max-w-full max-h-full object-contain">
        </div>
        
        <!-- Right Side - Comments & Info -->
        <div class="w-2/5 flex flex-col">
            <!-- Header -->
            <div class="p-4 border-b flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-image text-white text-xs"></i>
                    </div>
                    <span class="font-semibold" id="instagram-modal-title"></span>
                </div>
                <button onclick="closeInstagramModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Comments List -->
            <div id="instagramCommentsList" class="flex-1 overflow-y-auto p-4 space-y-4">
                <!-- Comments will be loaded here -->
            </div>
            
            <!-- Actions & Add Comment -->
            <div class="border-t">
                <!-- Like, Comment, Share Buttons -->
                <div class="flex items-center gap-4 p-3 border-b">
                    <button onclick="toggleLike(window.currentGalleryId)" 
                            class="hover:opacity-60 transition transform active:scale-90"
                            id="instagram-modal-like-btn">
                        <i class="far fa-heart text-2xl" id="instagram-modal-like-icon"></i>
                    </button>
                    <button class="hover:opacity-60 transition transform active:scale-90">
                        <i class="far fa-comment text-2xl"></i>
                    </button>
                    <button onclick="shareGallery(window.currentGalleryId)" 
                            class="hover:opacity-60 transition transform active:scale-90">
                        <i class="far fa-paper-plane text-2xl"></i>
                    </button>
                    <button onclick="downloadGallery(window.currentGalleryId)" 
                            class="hover:opacity-60 transition transform active:scale-90 ml-auto"
                            title="Download Foto">
                        <i class="fas fa-download text-2xl text-green-600"></i>
                    </button>
                </div>
                
                <!-- Likes Count -->
                <div class="px-4 py-2">
                    <span class="font-semibold text-sm" id="instagram-modal-likes">0 suka</span>
                </div>
                
                <!-- Date -->
                <div class="px-4 pb-2">
                    <span class="text-gray-400 text-xs" id="instagram-modal-date"></span>
                </div>
                
                <!-- Add Comment Form -->
                @auth
                <div class="p-4 border-t">
                    <div class="flex items-center gap-3">
                        <textarea id="instagramCommentText" 
                                  class="flex-1 resize-none focus:outline-none text-sm border rounded-lg p-2" 
                                  rows="1" 
                                  placeholder="Tambahkan komentar..."
                                  onkeypress="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); submitInstagramComment(event); }"></textarea>
                        <button onclick="submitInstagramComment(event)" 
                                class="text-blue-500 font-semibold hover:text-blue-700 text-sm px-3">
                            Kirim
                        </button>
                    </div>
                </div>
                @else
                <div class="p-4 border-t">
                    <div class="mb-3">
                        <input type="text" 
                               id="guestCommentName" 
                               class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               placeholder="Nama Anda">
                    </div>
                    <div class="flex items-center gap-3">
                        <textarea id="guestCommentText" 
                                  class="flex-1 resize-none focus:outline-none text-sm border rounded-lg p-2" 
                                  rows="2" 
                                  placeholder="Tulis komentar..."
                                  onkeypress="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); submitGuestComment(event); }"></textarea>
                        <button onclick="submitGuestComment(event)" 
                                class="text-blue-500 font-semibold hover:text-blue-700 text-sm px-3">
                            Kirim
                        </button>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let galleryImages = [];
let currentGalleryId = null;
window.currentGalleryId = null;

// Initialize gallery images array and liked states from localStorage
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('[onclick^="openLightbox"]');
    galleryImages = Array.from(galleryItems).map(item => {
        const onclick = item.getAttribute('onclick');
        const matches = onclick.match(/openLightbox\('([^']+)', '([^']+)', '([^']+)', (\d+)\)/);
        return {
            src: matches[1],
            title: matches[2],
            date: matches[3],
            id: parseInt(matches[4])
        };
    });
    
    // Initialize like icons from localStorage for guests
    const likedGalleries = JSON.parse(localStorage.getItem('likedGalleries') || '[]');
    likedGalleries.forEach(galleryId => {
        const likeIcon = document.getElementById(`like-icon-${galleryId}`);
        if (likeIcon) {
            likeIcon.classList.remove('far');
            likeIcon.classList.add('fas', 'text-red-500');
        }
    });
});

function openLightbox(imageSrc, title, date, galleryId) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDate = document.getElementById('lightbox-date');
    
    // Find current image index
    currentImageIndex = galleryImages.findIndex(img => img.src === imageSrc);
    currentGalleryId = galleryId;
    window.currentGalleryId = galleryId;
    
    lightboxImage.src = imageSrc;
    lightboxImage.alt = title;
    lightboxTitle.textContent = title;
    lightboxDate.textContent = date;
    
    // Update like and comment counts in lightbox
    updateLightboxStats(galleryId);
    
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function previousImage() {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : galleryImages.length - 1;
    updateLightboxImage();
}

function nextImage() {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = currentImageIndex < galleryImages.length - 1 ? currentImageIndex + 1 : 0;
    updateLightboxImage();
}

function updateLightboxImage() {
    const currentImage = galleryImages[currentImageIndex];
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDate = document.getElementById('lightbox-date');
    
    lightboxImage.src = currentImage.src;
    lightboxImage.alt = currentImage.title;
    lightboxTitle.textContent = currentImage.title;
    lightboxDate.textContent = currentImage.date;
    
    // Update gallery ID and stats
    currentGalleryId = currentImage.id;
    window.currentGalleryId = currentImage.id;
    updateLightboxStats(currentImage.id);
}

function updateLightboxStats(galleryId) {
    const likeCount = document.getElementById(`like-count-${galleryId}`);
    const commentCount = document.getElementById(`comment-count-${galleryId}`);
    const lightboxLikeCount = document.getElementById('lightbox-like-count');
    const lightboxCommentCount = document.getElementById('lightbox-comment-count');
    
    if (likeCount && lightboxLikeCount) {
        lightboxLikeCount.textContent = likeCount.textContent;
    }
    if (commentCount && lightboxCommentCount) {
        lightboxCommentCount.textContent = commentCount.textContent;
    }
}

// Like functionality - Guest can like using localStorage
function toggleLike(galleryId) {
    fetch(`/gallery/${galleryId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        const likeIcon = document.getElementById(`like-icon-${galleryId}`);
        const likeCount = document.getElementById(`like-count-${galleryId}`);
        const lightboxLikeIcon = document.getElementById('lightbox-like-icon');
        const lightboxLikeCount = document.getElementById('lightbox-like-count');
        const modalLikeIcon = document.getElementById('instagram-modal-like-icon');
        const modalLikes = document.getElementById('instagram-modal-likes');
        
        // Update localStorage for guest tracking
        let likedGalleries = JSON.parse(localStorage.getItem('likedGalleries') || '[]');
        if (data.status === 'liked') {
            if (!likedGalleries.includes(galleryId)) {
                likedGalleries.push(galleryId);
            }
            // Update all like icons to filled
            likeIcon?.classList.remove('far');
            likeIcon?.classList.add('fas', 'text-red-500');
            if (lightboxLikeIcon) {
                lightboxLikeIcon.classList.remove('far');
                lightboxLikeIcon.classList.add('fas', 'text-red-500');
            }
            if (modalLikeIcon) {
                modalLikeIcon.classList.remove('far');
                modalLikeIcon.classList.add('fas', 'text-red-500');
            }
        } else {
            likedGalleries = likedGalleries.filter(id => id !== galleryId);
            // Update all like icons to outline
            likeIcon?.classList.remove('fas', 'text-red-500');
            likeIcon?.classList.add('far');
            if (lightboxLikeIcon) {
                lightboxLikeIcon.classList.remove('fas', 'text-red-500');
                lightboxLikeIcon.classList.add('far');
            }
            if (modalLikeIcon) {
                modalLikeIcon.classList.remove('fas', 'text-red-500');
                modalLikeIcon.classList.add('far');
            }
        }
        localStorage.setItem('likedGalleries', JSON.stringify(likedGalleries));
        
        // Update counts
        if (likeCount) likeCount.textContent = `${data.likes_count} Likes`;
        if (lightboxLikeCount) lightboxLikeCount.textContent = `${data.likes_count} Likes`;
        if (modalLikes) modalLikes.textContent = `${data.likes_count} suka`;
    })
    .catch(error => console.error('Error:', error));
}

// Show comments modal
function showComments(galleryId) {
    currentGalleryId = galleryId;
    window.currentGalleryId = galleryId;
    
    const modal = document.getElementById('commentsModal');
    modal.classList.remove('hidden');
    
    loadComments(galleryId);
}

function closeComments() {
    const modal = document.getElementById('commentsModal');
    modal.classList.add('hidden');
}

// Load comments
function loadComments(galleryId) {
    fetch(`/gallery/${galleryId}/comments`)
        .then(response => response.json())
        .then(comments => {
            const commentsList = document.getElementById('commentsList');
            
            if (comments.length === 0) {
                commentsList.innerHTML = '<p class="text-gray-500 text-center">Belum ada komentar</p>';
                return;
            }
            
            commentsList.innerHTML = comments.map(comment => `
                <div class="mb-4 pb-4 border-b last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-gray-800">${comment.user.name}</p>
                            <p class="text-gray-600 mt-1">${comment.comment}</p>
                            <p class="text-gray-400 text-sm mt-1">${new Date(comment.created_at).toLocaleDateString('id-ID')}</p>
                        </div>
                        @auth
                        ${comment.user_id === {{ auth()->id() ?? 'null' }} ? `
                            <button onclick="deleteComment(${comment.id})" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        ` : ''}
                        @endauth
                    </div>
                </div>
            `).join('');
        })
        .catch(error => console.error('Error:', error));
}

// Submit comment
function submitComment(event) {
    event.preventDefault();
    
    const commentText = document.getElementById('commentText').value;
    
    if (!commentText.trim()) {
        alert('Komentar tidak boleh kosong');
        return;
    }
    
    fetch(`/gallery/${currentGalleryId}/comments`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ comment: commentText })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('commentText').value = '';
        loadComments(currentGalleryId);
        
        // Update comment count
        const commentCount = document.getElementById(`comment-count-${currentGalleryId}`);
        const lightboxCommentCount = document.getElementById('lightbox-comment-count');
        const newCount = parseInt(commentCount.textContent) + 1;
        commentCount.textContent = newCount;
        if (lightboxCommentCount) {
            lightboxCommentCount.textContent = newCount;
        }
    })
    .catch(error => console.error('Error:', error));
}

// Delete comment
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
        loadComments(currentGalleryId);
        
        // Update comment count
        const commentCount = document.getElementById(`comment-count-${currentGalleryId}`);
        const lightboxCommentCount = document.getElementById('lightbox-comment-count');
        const newCount = Math.max(0, parseInt(commentCount.textContent) - 1);
        commentCount.textContent = newCount;
        if (lightboxCommentCount) {
            lightboxCommentCount.textContent = newCount;
        }
    })
    .catch(error => console.error('Error:', error));
}

// Close lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    const instagramModal = document.getElementById('instagramModal');
    
    if (!lightbox.classList.contains('hidden')) {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                previousImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    }
    
    if (!instagramModal.classList.contains('hidden') && e.key === 'Escape') {
        closeInstagramModal();
    }
});

// ========== INSTAGRAM-STYLE FEATURES ==========

// Double Tap to Like (Instagram-style) - Works for both auth and guest
function doubleTapLike(galleryId) {
    // Show heart animation
    const heartAnimation = document.getElementById(`heart-animation-${galleryId}`);
    heartAnimation.classList.remove('opacity-0');
    heartAnimation.classList.add('opacity-100', 'animate-ping');
    
    // Trigger like (works for both auth and guest)
    toggleLike(galleryId);
    
    // Hide animation after 1 second
    setTimeout(() => {
        heartAnimation.classList.remove('opacity-100', 'animate-ping');
        heartAnimation.classList.add('opacity-0');
    }, 1000);
}

// Open Instagram-style View
function openInstagramView(galleryId) {
    // Prevent opening if double tap just happened
    if (event.detail === 2) return;
    
    showInstagramComments(galleryId);
}

// Show Instagram-style Comments Modal
function showInstagramComments(galleryId) {
    currentGalleryId = galleryId;
    window.currentGalleryId = galleryId;
    
    const modal = document.getElementById('instagramModal');
    const modalImage = document.getElementById('instagram-modal-image');
    const modalTitle = document.getElementById('instagram-modal-title');
    const modalDate = document.getElementById('instagram-modal-date');
    const modalLikes = document.getElementById('instagram-modal-likes');
    
    // Get gallery data from the card
    const galleryCard = document.querySelector(`#img-${galleryId}`);
    const likeCount = document.getElementById(`like-count-${galleryId}`);
    
    if (galleryCard) {
        modalImage.src = galleryCard.src;
        modalTitle.textContent = galleryCard.alt;
    }
    
    if (likeCount) {
        modalLikes.textContent = likeCount.textContent;
    }
    
    // Load comments
    loadInstagramComments(galleryId);
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Close Instagram Modal
function closeInstagramModal() {
    const modal = document.getElementById('instagramModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Load Instagram-style Comments
function loadInstagramComments(galleryId) {
    fetch(`/gallery/${galleryId}/comments`)
        .then(response => response.json())
        .then(comments => {
            const commentsList = document.getElementById('instagramCommentsList');
            
            if (comments.length === 0) {
                commentsList.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="far fa-comment-dots text-4xl mb-2"></i>
                        <p class="text-sm">Belum ada komentar</p>
                        <p class="text-xs mt-1">Jadilah yang pertama berkomentar!</p>
                    </div>
                `;
                return;
            }
            
            commentsList.innerHTML = comments.map(comment => {
                // Determine commenter name
                let commenterName = 'Anonymous';
                let badge = '';
                
                if (comment.guest_name) {
                    commenterName = comment.guest_name;
                    badge = '<span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full ml-2">Tamu</span>';
                } else if (comment.user) {
                    commenterName = comment.user.name;
                    badge = '<span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full ml-2">User</span>';
                }
                
                const initial = commenterName.charAt(0).toUpperCase();
                
                return `
                <div class="flex gap-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-xs font-bold">${initial}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <span class="font-semibold text-sm">${commenterName}${badge}</span>
                                <span class="text-sm ml-2">${comment.comment}</span>
                            </div>
                            @auth
                            ${comment.user_id === {{ auth()->id() ?? 'null' }} ? `
                                <button onclick="deleteInstagramComment(${comment.id})" class="text-gray-400 hover:text-red-500 ml-2">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            ` : ''}
                            @endauth
                        </div>
                        <div class="flex items-center gap-3 mt-1 text-xs text-gray-400">
                            <span>${formatTimeAgo(comment.created_at)}</span>
                        </div>
                    </div>
                </div>
            `;
            }).join('');
        })
        .catch(error => console.error('Error:', error));
}

// Submit Instagram Comment (Authenticated User)
function submitInstagramComment(event) {
    event.preventDefault();
    
    const commentText = document.getElementById('instagramCommentText').value;
    
    if (!commentText.trim()) {
        alert('Komentar tidak boleh kosong');
        return;
    }
    
    fetch(`/gallery/${currentGalleryId}/comments`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ comment: commentText })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('instagramCommentText').value = '';
        loadInstagramComments(currentGalleryId);
        updateCommentCount(currentGalleryId, 1);
    })
    .catch(error => console.error('Error:', error));
}

// Submit Guest Comment (Non-authenticated User)
function submitGuestComment(event) {
    event.preventDefault();
    
    const commentName = document.getElementById('guestCommentName').value;
    const commentText = document.getElementById('guestCommentText').value;
    
    if (!commentName.trim()) {
        alert('Nama tidak boleh kosong');
        return;
    }
    
    if (!commentText.trim()) {
        alert('Komentar tidak boleh kosong');
        return;
    }
    
    fetch(`/gallery/${currentGalleryId}/comments/guest`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ 
            guest_name: commentName,
            comment: commentText 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('guestCommentName').value = '';
            document.getElementById('guestCommentText').value = '';
            loadInstagramComments(currentGalleryId);
            updateCommentCount(currentGalleryId, 1);
            alert('Komentar berhasil dikirim!');
        } else {
            alert('Gagal mengirim komentar: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim komentar');
    });
}

// Update Comment Count Helper
function updateCommentCount(galleryId, change) {
    const commentDisplay = document.getElementById(`comment-count-display-${galleryId}`);
    if (commentDisplay) {
        const currentCount = parseInt(commentDisplay.textContent.match(/\d+/) || 0);
        const newCount = Math.max(0, currentCount + change);
        commentDisplay.textContent = `${newCount} Komentar`;
    }
}

// Delete Instagram Comment
function deleteInstagramComment(commentId) {
    if (!confirm('Hapus komentar ini?')) {
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
        loadInstagramComments(currentGalleryId);
        
        // Update comment count in multiple places
        const commentPreview = document.getElementById(`comment-preview-${currentGalleryId}`);
        const commentDisplay = document.getElementById(`comment-count-display-${currentGalleryId}`);
        const currentCount = parseInt(commentDisplay?.textContent || 0);
        const newCount = Math.max(0, currentCount - 1);
        
        if (commentPreview) {
            if (newCount > 0) {
                commentPreview.textContent = `Lihat semua ${newCount} komentar`;
            } else {
                commentPreview.textContent = 'Jadilah yang pertama berkomentar';
            }
        }
        if (commentDisplay) {
            commentDisplay.textContent = newCount;
        }
    })
    .catch(error => console.error('Error:', error));
}

// Share Gallery (Instagram-style)
function shareGallery(galleryId) {
    const url = window.location.origin + '/galeri/' + galleryId;
    
    if (navigator.share) {
        navigator.share({
            title: 'Galeri SMKN 4 BOGOR',
            url: url
        }).catch(error => console.log('Error sharing:', error));
    } else {
        // Fallback: Copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            alert('Link berhasil disalin!');
        });
    }
}

// Download Gallery Image
function downloadGallery(galleryId) {
    window.location.href = `/galeri/${galleryId}/download`;
}

// Update Like UI (Simple Clean Style)
function updateLikeUI(galleryId, data) {
    const likeIcon = document.getElementById(`like-icon-${galleryId}`);
    const likeCount = document.getElementById(`like-count-${galleryId}`);
    const modalLikeIcon = document.getElementById('instagram-modal-like-icon');
    const modalLikes = document.getElementById('instagram-modal-likes');
    
    if (data.status === 'liked') {
        // Update icon to filled
        likeIcon.classList.remove('far');
        likeIcon.classList.add('fas');
        
        if (modalLikeIcon) {
            modalLikeIcon.classList.remove('far');
            modalLikeIcon.classList.add('fas', 'text-red-500');
        }
    } else {
        // Update icon to outline
        likeIcon.classList.remove('fas');
        likeIcon.classList.add('far');
        
        if (modalLikeIcon) {
            modalLikeIcon.classList.remove('fas', 'text-red-500');
            modalLikeIcon.classList.add('far');
        }
    }
    
    // Update counts
    likeCount.textContent = `${data.likes_count} Likes`;
    if (modalLikes) {
        modalLikes.textContent = `${data.likes_count} suka`;
    }
}

// Format Time Ago (Instagram-style)
function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);
    
    if (seconds < 60) return 'Baru saja';
    if (seconds < 3600) return Math.floor(seconds / 60) + ' menit yang lalu';
    if (seconds < 86400) return Math.floor(seconds / 3600) + ' jam yang lalu';
    if (seconds < 604800) return Math.floor(seconds / 86400) + ' hari yang lalu';
    return Math.floor(seconds / 604800) + ' minggu yang lalu';
}
</script>
@endsection
