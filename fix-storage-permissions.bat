@echo off
echo ========================================
echo  FIX STORAGE PERMISSIONS
echo ========================================
echo.

echo [1/5] Membuat folder yang diperlukan...
if not exist "storage\app\public\galleries" mkdir "storage\app\public\galleries"
if not exist "storage\app\public\beritas" mkdir "storage\app\public\beritas"
if not exist "storage\framework\cache" mkdir "storage\framework\cache"
if not exist "storage\framework\sessions" mkdir "storage\framework\sessions"
if not exist "storage\framework\views" mkdir "storage\framework\views"
if not exist "storage\logs" mkdir "storage\logs"
echo Done!

echo.
echo [2/5] Memberikan full permission ke folder storage...
icacls "storage" /grant Everyone:(OI)(CI)F /T
echo Done!

echo.
echo [3/5] Memberikan full permission ke folder bootstrap/cache...
if not exist "bootstrap\cache" mkdir "bootstrap\cache"
icacls "bootstrap\cache" /grant Everyone:(OI)(CI)F /T
echo Done!

echo.
echo [4/5] Menghapus symbolic link lama...
if exist "public\storage" rmdir "public\storage"
echo Done!

echo.
echo [5/5] Membuat symbolic link baru...
php artisan storage:link
echo Done!

echo.
echo ========================================
echo  SELESAI!
echo ========================================
echo.
echo Folder storage sudah siap digunakan!
echo Silakan coba upload foto lagi.
echo.
pause
