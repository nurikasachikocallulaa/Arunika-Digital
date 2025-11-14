# 🔧 Cara Mengatasi Error "POST Data Too Large"

## Masalah
Ketika upload foto galeri di halaman admin, muncul error **"POST data is too large"**.

## Penyebab
Limit upload PHP terlalu kecil. Default PHP biasanya:
- `upload_max_filesize` = 2M
- `post_max_size` = 8M

Sedangkan aplikasi ini butuh upload sampai 15MB.

---

## ✅ SOLUSI TERCEPAT (Pilih Salah Satu)

### 🎯 Metode 1: Otomatis dengan PowerShell (RECOMMENDED)

1. **Buka PowerShell sebagai Administrator**
   - Tekan `Win + X`
   - Pilih "Windows PowerShell (Admin)" atau "Terminal (Admin)"

2. **Jalankan script:**
   ```powershell
   cd C:\xamppp\htdocs\galery_sachi
   .\fix-php-ini.ps1
   ```

3. **Restart Apache** dari XAMPP Control Panel

4. **Cek hasilnya:**
   - Buka: http://localhost/galery_sachi/public/check-php-limits.php
   - Harus muncul ✅ hijau

---

### 🎯 Metode 2: Manual Edit php.ini

#### Langkah-langkah:

1. **Buka XAMPP Control Panel**

2. **Klik tombol "Config"** di sebelah Apache

3. **Pilih "PHP (php.ini)"**

4. **Cari dan ubah baris berikut** (gunakan Ctrl+F):

   **SEBELUM:**
   ```ini
   upload_max_filesize = 2M
   post_max_size = 8M
   max_execution_time = 30
   memory_limit = 128M
   ```

   **SESUDAH:**
   ```ini
   upload_max_filesize = 20M
   post_max_size = 25M
   max_execution_time = 300
   memory_limit = 256M
   ```

   **PENTING:** Jika ada tanda `;` di depan baris, **HAPUS** tanda `;` tersebut!
   
   Contoh:
   ```ini
   ;upload_max_filesize = 2M    ← SALAH (masih ada ;)
   upload_max_filesize = 20M    ← BENAR (tanpa ;)
   ```

5. **Simpan file** (Ctrl+S)

6. **Restart Apache:**
   - Klik tombol **"Stop"**
   - Tunggu 3-5 detik
   - Klik tombol **"Start"**

7. **Verifikasi:**
   - Buka: http://localhost/galery_sachi/public/check-php-limits.php
   - Pastikan semua nilai sudah 20M/25M

---

### 🎯 Metode 3: Jika Metode 1 & 2 Gagal

Jika masih error, kemungkinan php.ini yang diedit bukan yang aktif.

#### Cari php.ini yang benar:

1. **Buat file baru:** `C:\xampp\htdocs\test-phpinfo.php`
   ```php
   <?php phpinfo(); ?>
   ```

2. **Buka di browser:** http://localhost/test-phpinfo.php

3. **Cari baris:** `Loaded Configuration File`
   - Akan muncul path lengkap php.ini yang aktif
   - Contoh: `C:\xampp\php\php.ini`

4. **Edit file tersebut** sesuai Metode 2

5. **Hapus file test:** `C:\xampp\htdocs\test-phpinfo.php`

---

## 🧪 Testing Upload

Setelah fix, coba upload foto:

1. **Login ke admin**
2. **Buka:** Galeri → Tambah Galeri
3. **Upload foto** ukuran 5-10MB
4. **Klik Simpan**

Jika berhasil, foto akan tersimpan tanpa error!

---

## ❌ Troubleshooting

### Problem: Masih error setelah edit php.ini

**Solusi:**
1. Pastikan Apache sudah **di-restart** (Stop → Start)
2. **Clear browser cache** (Ctrl+Shift+Delete)
3. Cek lagi di: http://localhost/galery_sachi/public/check-php-limits.php
4. Pastikan nilai sudah berubah jadi 20M dan 25M

---

### Problem: File check-php-limits.php tidak bisa dibuka

**Solusi:**
1. Pastikan Apache sudah running
2. Cek URL: http://localhost/galery_sachi/public/check-php-limits.php
3. Atau langsung test upload foto

---

### Problem: Error "Failed to open stream" atau "Permission denied"

**Solusi:**
1. Cek folder `storage` dan `public/storage`
2. Jalankan command:
   ```bash
   php artisan storage:link
   ```
3. Pastikan folder `storage/app/public/galleries` ada dan bisa ditulis

---

### Problem: Upload berhasil tapi foto tidak muncul

**Solusi:**
1. Jalankan command:
   ```bash
   php artisan storage:link
   ```
2. Cek apakah folder `public/storage` adalah symbolic link ke `storage/app/public`

---

## 📊 Penjelasan Setting

| Setting | Nilai | Fungsi |
|---------|-------|--------|
| `upload_max_filesize` | 20M | Ukuran maksimal **1 file** yang diupload |
| `post_max_size` | 25M | Ukuran maksimal **seluruh data POST** (harus > upload_max_filesize) |
| `max_execution_time` | 300 | Waktu maksimal script berjalan (5 menit) |
| `memory_limit` | 256M | Memory maksimal yang bisa dipakai PHP |

**Catatan:** `post_max_size` harus **lebih besar** dari `upload_max_filesize` karena POST data termasuk file + form fields lainnya.

---

## 🔒 Keamanan

### Setelah berhasil, HAPUS file ini:
- ❌ `public/check-php-limits.php` (file test, berbahaya di production)

### Validasi yang sudah ada:
- ✅ Tipe file: JPG, PNG, GIF saja
- ✅ Ukuran maksimal: 15MB
- ✅ Validasi di frontend (JavaScript)
- ✅ Validasi di backend (Laravel)

---

## 📝 File yang Dimodifikasi

1. ✏️ `public/index.php` - Ditambah `ini_set()` untuk override limit
2. ✏️ `public/.htaccess` - Ditambah `php_value` directives
3. ➕ `public/.user.ini` - Backup configuration
4. ➕ `fix-php-ini.ps1` - Script otomatis fix php.ini
5. ➕ `public/check-php-limits.php` - Tool verifikasi (hapus setelah selesai)

---

## 🆘 Masih Bermasalah?

Jika semua cara di atas sudah dicoba tapi masih error:

1. **Screenshot error** yang muncul
2. **Cek Apache error log:**
   - Lokasi: `C:\xampp\apache\logs\error.log`
   - Buka file terakhir, lihat error apa yang muncul

3. **Cek Laravel log:**
   - Lokasi: `storage/logs/laravel.log`
   - Lihat error terakhir

4. **Coba upload file kecil** (1-2MB) dulu
   - Jika berhasil → masalah di limit
   - Jika gagal → masalah di code/permission

5. **Cek versi PHP:**
   ```bash
   php -v
   ```
   Pastikan PHP 8.0 atau lebih baru

---

## ✨ Tips Tambahan

### Untuk Production:
- Gunakan limit lebih kecil (10MB) untuk keamanan
- Implementasi image compression otomatis
- Tambahkan progress bar saat upload

### Untuk Development:
- Limit 20MB sudah cukup untuk testing
- Jangan lupa hapus file test setelah selesai

---

**Terakhir diupdate:** 22 Oktober 2025  
**Aplikasi:** Galeri SMKN 4 Bogor  
**Framework:** Laravel 11
