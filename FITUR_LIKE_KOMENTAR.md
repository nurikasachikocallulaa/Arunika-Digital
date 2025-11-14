# Fitur Like dan Komentar Galeri

## Ringkasan
Fitur ini menambahkan kemampuan untuk memberikan like dan komentar pada galeri, baik untuk pengguna guest maupun admin. Admin memiliki kemampuan khusus untuk mengelola dan menghapus komentar yang tidak sesuai.

## Fitur yang Ditambahkan

### 1. Database & Model
- **Tabel `gallery_likes`**: Menyimpan data like dari user
  - `id`, `gallery_id`, `user_id`, `timestamps`
  - Unique constraint pada `gallery_id` dan `user_id` untuk mencegah duplikasi
  
- **Tabel `gallery_comments`**: Menyimpan komentar user
  - `id`, `gallery_id`, `user_id`, `comment`, `is_approved`, `timestamps`
  
- **Tabel `users`**: Ditambahkan kolom `is_admin` (boolean, default: false)

- **Model `GalleryLike`**: Model untuk mengelola likes
- **Model `GalleryComment`**: Model untuk mengelola comments
- **Model `Gallery`**: Ditambahkan relasi `likes()` dan `comments()`

### 2. Controller
- **GalleryLikeController**:
  - `toggleLike($galleryId)`: Toggle like/unlike galeri
  - `getLikes($galleryId)`: Mendapatkan jumlah likes

- **GalleryCommentController**:
  - `index($galleryId)`: Mendapatkan semua komentar untuk galeri tertentu
  - `store($request, $galleryId)`: Menambahkan komentar baru
  - `destroy($id)`: Menghapus komentar (admin atau pemilik komentar)
  - `adminIndex()`: Mendapatkan semua komentar untuk admin

### 3. Routes
```php
// Like dan Comment (memerlukan autentikasi)
Route::post('/gallery/{gallery}/like', [GalleryLikeController::class, 'toggleLike']);
Route::get('/gallery/{gallery}/likes', [GalleryLikeController::class, 'getLikes']);
Route::get('/gallery/{gallery}/comments', [GalleryCommentController::class, 'index']);
Route::post('/gallery/{gallery}/comments', [GalleryCommentController::class, 'store']);
Route::delete('/comments/{comment}', [GalleryCommentController::class, 'destroy']);

// Admin: Manage Comments
Route::get('/admin/comments', [GalleryCommentController::class, 'adminIndex']);
Route::get('/galleries-comments', function() { return view('galleries.comments'); });
```

### 4. Views

#### Halaman Guest (`resources/views/guest/galeri.blade.php`)
- **Perubahan**:
  - Nama galeri ditampilkan di luar gambar (bukan overlay)
  - Tombol like dan komentar di setiap card galeri
  - Modal komentar untuk melihat dan menambahkan komentar
  - Lightbox yang diperbaharui dengan fitur like dan komentar
  - JavaScript untuk menangani like, komentar, dan AJAX requests

#### Halaman Admin (`resources/views/galleries/index.blade.php`)
- **Perubahan**:
  - Menampilkan jumlah likes dan komentar di setiap galeri
  - Statistik interaksi pengguna

#### Halaman Kelola Komentar Admin (`resources/views/galleries/comments.blade.php`)
- **Fitur**:
  - Melihat semua komentar dari semua galeri
  - Menghapus komentar yang tidak sesuai
  - Informasi lengkap: user, waktu, galeri terkait

#### Layout Admin (`resources/views/layouts/admin.blade.php`)
- **Perubahan**:
  - Menambahkan menu "Kelola Komentar" di sidebar
  - Menambahkan Font Awesome untuk icons

## Cara Menggunakan

### Untuk User/Guest:
1. **Like Galeri**:
   - Klik icon heart pada galeri
   - Jika belum login, akan diarahkan ke halaman login
   - Like akan tersimpan dan counter akan bertambah

2. **Komentar**:
   - Klik icon comment pada galeri
   - Modal komentar akan muncul
   - Tulis komentar dan klik "Kirim Komentar"
   - Komentar akan langsung muncul di list

3. **Hapus Komentar Sendiri**:
   - User dapat menghapus komentar mereka sendiri
   - Klik icon trash pada komentar

### Untuk Admin:
1. **Melihat Statistik**:
   - Di halaman Galeri admin, lihat jumlah likes dan komentar setiap galeri

2. **Mengelola Komentar**:
   - Akses menu "Kelola Komentar" di sidebar
   - Lihat semua komentar dari semua galeri
   - Hapus komentar yang tidak sesuai dengan klik tombol "Hapus"

3. **Menghapus Komentar Negatif**:
   - Admin dapat menghapus komentar apapun
   - Komentar akan langsung terhapus dari database

## Keamanan
- Semua route like dan komentar memerlukan autentikasi
- CSRF protection aktif pada semua form
- Validasi input untuk komentar (max 1000 karakter)
- Authorization check: hanya admin atau pemilik yang bisa hapus komentar

## Teknologi yang Digunakan
- Laravel (Backend)
- Blade Templates (Views)
- Tailwind CSS (Styling)
- Font Awesome (Icons)
- JavaScript (AJAX & Interactivity)
- MySQL (Database)

## Catatan Penting
1. Pastikan user sudah login untuk menggunakan fitur like dan komentar
2. Admin perlu set `is_admin = 1` di database untuk user yang ingin dijadikan admin
3. Semua komentar otomatis approved (is_approved = true)
4. Like bersifat toggle (klik sekali like, klik lagi unlike)

## Testing
Untuk testing fitur ini:
1. Buat user baru atau login dengan user existing
2. Coba like beberapa galeri
3. Tambahkan komentar pada galeri
4. Login sebagai admin (set is_admin = 1)
5. Akses halaman "Kelola Komentar"
6. Coba hapus komentar

## Troubleshooting
- Jika like/komentar tidak berfungsi, pastikan user sudah login
- Jika halaman admin tidak muncul, pastikan user memiliki `is_admin = 1`
- Jika error 404, jalankan `php artisan route:clear` dan `php artisan cache:clear`
