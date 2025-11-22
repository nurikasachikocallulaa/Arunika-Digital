<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'no_hp',
        'email',
        'alamat',
    ];
}
