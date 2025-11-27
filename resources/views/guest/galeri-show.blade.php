@extends('layouts.guest')
@section('title', $gallery->title)

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ url('/galeri') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Galeri
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Gallery Image -->
        <div class="relative">
            @if($gallery->image)
                <img src="{{ asset('storage/'.$gallery->image) }}" 
                     alt="{{ $gallery->title }}" 
                     class="w-full h-auto max-h-[600px] object-contain bg-gray-100">
            @else
                <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-semibold">SMKN 4 Bogor</span>
                </div>
            @endif
        </div>

        <!-- Gallery Info -->
        <div class="p-6">
            <!-- Title & Category -->
            <div class="mb-4">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $gallery->title }}</h1>
                @if($gallery->category)
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $gallery->category->name }}
                    </span>
                @endif
            </div>

            <!-- Description -->
            @if($gallery->description)
                <div class="mb-6">
                    <p class="text-gray-700 leading-relaxed">{{ $gallery->description }}</p>
                </div>
            @endif

            <!-- Date -->
            <div class="mb-6 text-gray-500 text-sm">
                <i class="far fa-calendar mr-2"></i>
                {{ $gallery->created_at->format('d F Y') }}
            </div>

            <!-- Like & Comment Stats -->
            <div class="flex items-center gap-6 mb-6 pb-6 border-b">
                @auth
                    <button onclick="toggleLike({{ $gallery->id }})" 
                            class="flex items-center gap-2 hover:text-red-500 transition"
                            id="like-btn-{{ $gallery->id }}">
                        <i class="far fa-heart text-red-500 text-xl" id="like-icon-{{ $gallery->id }}"></i>
                        <span class="text-gray-700 font-semibold" id="like-count-{{ $gallery->id }}">
                            {{ $gallery->likes_count ?? 0 }} Likes
                        </span>
                    </button>
                    <div class="flex items-center gap-2">
                        <i class="far fa-comment text-blue-500 text-xl"></i>
                        <span class="text-gray-700 font-semibold" id="comment-count-display-{{ $gallery->id }}">
                            {{ $gallery->comments_count ?? 0 }} Komentar
                        </span>
                    </div>
                @else
                    <button onclick="window.location='{{ route('login') }}'" 
                            class="flex items-center gap-2 hover:text-red-500 transition">
                        <i class="far fa-heart text-red-500 text-xl"></i>
                        <span class="text-gray-700 font-semibold">
                            {{ $gallery->likes_count ?? 0 }} Likes
                        </span>
                    </button>
                    <div class="flex items-center gap-2">
                        <i class="far fa-comment text-blue-500 text-xl"></i>
                        <span class="text-gray-700 font-semibold">
                            {{ $gallery->comments_count ?? 0 }} Komentar
                        </span>
                    </div>
                @endauth
                @if($gallery->image)
                <a href="{{ url('/galeri/' . $gallery->id . '/download') }}" 
                   class="flex items-center gap-2 hover:text-green-500 transition ml-auto"
                   download>
                    <i class="fas fa-download text-green-500 text-xl"></i>
                    <span class="text-gray-700 font-semibold">Download</span>
                </a>
                @endif
            </div>

            <!-- Comments Section -->
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Komentar</h3>
                
                <!-- Comment Form for Guest -->
                <div class="mb-6">
                        <form id="comment-form-{{ $gallery->id }}" onsubmit="submitGuestComment(event, {{ $gallery->id }})">
                        @guest
                            <div class="mb-3">
                                <input 
                                    type="text"
                                    id="guest-name-{{ $gallery->id }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nama Anda"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input 
                                    type="email"
                                    id="guest-email-{{ $gallery->id }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Email Anda (opsional)">
                            </div>
                        @endguest
                            <textarea 
                                id="comment-input-{{ $gallery->id }}"
                                rows="3" 
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Tulis komentar..."
                                required></textarea>
                            <button type="submit" 
                                    class="mt-2 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                Kirim Komentar
                            </button>
                        </form>
                    @else
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Silakan <a href="{{ route('login') }}" class="font-semibold text-blue-700 hover:text-blue-800">login</a> untuk memberikan like dan komentar.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- Comments List -->
                <div id="comments-list-{{ $gallery->id }}" class="space-y-4">
                    @forelse($gallery->comments as $comment)
                        <div class="bg-gray-50 rounded-lg p-4" id="comment-{{ $comment->id }}">
                            <div class="flex items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-gray-800">
                                            @if($comment->guest_name)
                                                {{ $comment->guest_name }}
                                                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full ml-1">Tamu</span>
                                            @elseif($comment->user)
                                                {{ $comment->user->name }}
                                                <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full ml-1">User</span>
                                            @else
                                                Anonymous
                                            @endif
                                        </span>
                                        <span class="text-gray-500 text-sm">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle Like - Works for both auth and guest
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
        
        // Update localStorage for guest tracking
        let likedGalleries = JSON.parse(localStorage.getItem('likedGalleries') || '[]');
        if (data.status === 'liked') {
            if (!likedGalleries.includes(galleryId)) {
                likedGalleries.push(galleryId);
            }
            likeIcon.classList.remove('far');
            likeIcon.classList.add('fas', 'text-red-500');
        } else {
            likedGalleries = likedGalleries.filter(id => id !== galleryId);
            likeIcon.classList.remove('fas', 'text-red-500');
            likeIcon.classList.add('far');
        }
        localStorage.setItem('likedGalleries', JSON.stringify(likedGalleries));
        
        likeCount.textContent = `${data.likes_count} Likes`;
    })
    .catch(error => console.error('Error:', error));
}

// Submit Comment
function submitGuestComment(event, galleryId) {
    event.preventDefault();
    
    const commentInput = document.getElementById(`comment-input-${galleryId}`);
    const comment = commentInput.value.trim();
    
    if (!comment) return;
    
    // Show loading state
    const submitButton = event.target.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = 'Mengirim...';
    
    // Check if user is guest
    const isGuest = document.getElementById(`guest-name-${galleryId}`) !== null;
    
    if (isGuest) {
        // Handle guest comment
        const guestName = document.getElementById(`guest-name-${galleryId}`).value.trim();
        const guestEmail = document.getElementById(`guest-email-${galleryId}`).value.trim();
        
        if (!guestName) {
            alert('Mohon isi nama Anda');
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
            return;
        }
        
        fetch(`/gallery/${galleryId}/comments/guest`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                comment: comment,
                guest_name: guestName,
                guest_email: guestEmail,
                _token: '{{ csrf_token() }}'
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                throw new Error(data.message || 'Gagal mengirim komentar');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat mengirim komentar');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    } else {
        // Handle authenticated user comment
        fetch(`/gallery/${galleryId}/comments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                comment: comment,
                _token: '{{ csrf_token() }}'
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                commentInput.value = '';
                location.reload();
            } else {
                throw new Error(data.message || 'Gagal mengirim komentar');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat mengirim komentar');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    }
}

// Initialize like state on page load (for both auth and guest)
document.addEventListener('DOMContentLoaded', function() {
    const galleryId = {{ $gallery->id }};
    
    @guest
        // For guest: check localStorage
        const likedGalleries = JSON.parse(localStorage.getItem('likedGalleries') || '[]');
        if (likedGalleries.includes(galleryId)) {
            const likeIcon = document.getElementById(`like-icon-${galleryId}`);
            if (likeIcon) {
                likeIcon.classList.remove('far');
                likeIcon.classList.add('fas', 'text-red-500');
            }
        }
    @else
        // For authenticated user: check via API
        fetch(`/gallery/${galleryId}/likes`)
            .then(response => response.json())
            .then(data => {
                if (data.is_liked) {
                    const likeIcon = document.getElementById(`like-icon-${galleryId}`);
                    if (likeIcon) {
                        likeIcon.classList.remove('far');
                        likeIcon.classList.add('fas', 'text-red-500');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    @endguest
});
</script>
@endsection
