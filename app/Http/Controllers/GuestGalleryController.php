<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Gallery;

class GuestGalleryController extends Controller
{
    public function index(Request $request){
    $categories = \App\Models\Category::all();
    $catId = $request->query('kategori');
    $galleries = $catId
        ? \App\Models\Gallery::withCount(['likes', 'comments'])->where('category_id',$catId)->latest()->paginate(12)->withQueryString()
        : \App\Models\Gallery::withCount(['likes', 'comments'])->latest()->paginate(12);
    return view('guest.galeri',compact('categories','galleries'));
}


    public function kategori($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $galleries = $category->galleries()->withCount(['likes', 'comments'])->latest()->paginate(12);
        return view('guest.galeri', compact('category', 'categories', 'galleries'));
    }

    public function show($id)
    {
        $gallery = Gallery::withCount(['likes', 'comments'])
            ->with(['category', 'comments.user', 'likes'])
            ->findOrFail($id);
        
        return view('guest.galeri-show', compact('gallery'));
    }

    public function download($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if (!$gallery->image) {
            abort(404, 'Image not found');
        }
        
        $imagePath = storage_path('app/public/' . $gallery->image);
        
        if (!file_exists($imagePath)) {
            abort(404, 'Image file not found');
        }
        
        // Get original filename or create one
        $filename = pathinfo($gallery->image, PATHINFO_BASENAME);
        
        return response()->download($imagePath, $filename);
    }

}
