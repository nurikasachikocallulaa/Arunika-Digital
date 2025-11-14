<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name'=>'Kegiatan Sekolah', 'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Prestasi Siswa', 'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Ekstrakurikuler', 'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Kegiatan Guru', 'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
