<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GalleryCommentController extends Controller
{
    public function index($galleryId)
    {
        $comments = GalleryComment::with('user')
            ->where('gallery_id', $galleryId)
            ->approved()
            ->latest()
            ->get()
            ->map(function($comment) {
                // If guest comment, create fake user object
                if (!$comment->user_id && $comment->guest_name) {
                    $comment->user = (object) ['name' => $comment->guest_name];
                }
                return $comment;
            });

        return response()->json($comments);
    }

    public function store(Request $request, $galleryId)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = GalleryComment::create([
            'gallery_id' => $galleryId,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dikirim',
            'comment' => $comment
        ], 201);
    }

    public function storeGuest(Request $request, $galleryId)
    {
        $validator = Validator::make($request->all(), [
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = GalleryComment::create([
            'gallery_id' => $galleryId,
            'user_id' => null,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        // Create a fake user object for consistent response
        $comment->user = (object) ['name' => $request->guest_name];

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dikirim',
            'comment' => $comment
        ], 201);
    }

    public function destroy($id)
    {
        $comment = GalleryComment::findOrFail($id);
        
        // Hanya admin atau pemilik komentar yang bisa menghapus
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $comment->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus'
        ]);
    }

    // Admin only - untuk menghapus komentar negatif
    public function adminIndex()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comments = GalleryComment::with(['user', 'gallery' => function($query) {
                $query->withCount(['likes', 'comments']);
            }])
            ->latest()
            ->get();

        return response()->json($comments);
    }
}
