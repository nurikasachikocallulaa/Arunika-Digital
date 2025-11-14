<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryLikeController extends Controller
{
    public function toggleLike(Request $request, $galleryId)
    {
        $gallery = Gallery::findOrFail($galleryId);
        
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            
            $like = GalleryLike::where('gallery_id', $galleryId)
                ->where('user_id', $user->id)
                ->first();

            if ($like) {
                $like->delete();
                return response()->json([
                    'status' => 'unliked',
                    'likes_count' => $gallery->likes()->count()
                ]);
            } else {
                GalleryLike::create([
                    'gallery_id' => $galleryId,
                    'user_id' => $user->id
                ]);
                
                return response()->json([
                    'status' => 'liked',
                    'likes_count' => $gallery->likes()->count()
                ]);
            }
        } else {
            // Guest user - use session/IP based tracking
            $guestId = $request->ip() . '_' . $request->userAgent();
            $guestIdHash = md5($guestId);
            
            $like = GalleryLike::where('gallery_id', $galleryId)
                ->where('guest_id', $guestIdHash)
                ->first();

            if ($like) {
                $like->delete();
                return response()->json([
                    'status' => 'unliked',
                    'likes_count' => $gallery->likes()->count()
                ]);
            } else {
                GalleryLike::create([
                    'gallery_id' => $galleryId,
                    'user_id' => null,
                    'guest_id' => $guestIdHash
                ]);
                
                return response()->json([
                    'status' => 'liked',
                    'likes_count' => $gallery->likes()->count()
                ]);
            }
        }
    }

    public function getLikes(Request $request, $galleryId)
    {
        $gallery = Gallery::withCount('likes')->findOrFail($galleryId);
        
        // Check if liked by current user/guest
        $isLiked = false;
        if (Auth::check()) {
            $isLiked = GalleryLike::where('gallery_id', $galleryId)
                ->where('user_id', Auth::id())
                ->exists();
        } else {
            // Guest - check by IP + user agent hash
            $guestId = $request->ip() . '_' . $request->userAgent();
            $guestIdHash = md5($guestId);
            $isLiked = GalleryLike::where('gallery_id', $galleryId)
                ->where('guest_id', $guestIdHash)
                ->exists();
        }
        
        return response()->json([
            'likes_count' => $gallery->likes_count,
            'is_liked' => $isLiked
        ]);
    }

}
