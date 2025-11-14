<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'email',
        'address',
        'facebook',
        'instagram',
        'youtube',
        'map_embed'
    ];
    
    protected $table = 'site_settings';//
}
