<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title','image', 'category_id'];
    protected $withCount = ['likes', 'comments'];
    protected $appends = ['is_liked'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(GalleryLike::class);
    }

    public function comments()
    {
        return $this->hasMany(GalleryComment::class)->where('is_approved', true);
    }

    public function getIsLikedAttribute()
    {
        if (!Auth::check()) {
            return false;
        }
        return $this->likes()->where('user_id', Auth::id())->exists();
    }
}
