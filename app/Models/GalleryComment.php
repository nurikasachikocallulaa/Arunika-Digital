<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\Models\User;

class GalleryComment extends Model
{
    use HasFactory;

    protected $fillable = ['gallery_id', 'user_id', 'guest_name', 'guest_email', 'comment', 'is_approved'];
    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
