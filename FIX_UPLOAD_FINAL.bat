@echo off
echo ========================================
echo   FIX UPLOAD GALERI - SOLUSI FINAL
echo ========================================
echo.

echo [STEP 1] Stopping Apache...
taskkill /F /IM httpd.exe 2>nul
timeout /t 3 /nobreak >nul
echo Done!
echo.

echo [STEP 2] Backing up php.ini...
if not exist "C:\xampp\php\php.ini.backup-original" (
    copy "C:\xampp\php\php.ini" "C:\xampp\php\php.ini.backup-original"
    echo Backup created!
) else (
    echo Backup already exists, skipping...
)
echo.

echo [STEP 3] Updating php.ini...
powershell -Command "$content = Get-Content 'C:\xampp\php\php.ini'; $content = $content -replace '^;?upload_max_filesize\s*=.*', 'upload_max_filesize = 20M'; $content = $content -replace '^;?post_max_size\s*=.*', 'post_max_size = 25M'; $content = $content -replace '^;?max_execution_time\s*=.*', 'max_execution_time = 300'; $content = $content -replace '^;?memory_limit\s*=.*', 'memory_limit = 256M'; $content | Set-Content 'C:\xampp\php\php.ini'"
echo Done!
echo.

echo [STEP 4] Starting Apache...
"C:\xampp\apache\bin\httpd.exe" -k start
timeout /t 5 /nobreak >nul
echo Done!
echo.

echo ========================================
echo   SELESAI!
echo ========================================
echo.
echo Silakan buka browser dan test:
echo http://localhost/galery_sachi/public/cek-upload-limits.php
echo.
echo Harus menunjukkan:
echo - upload_max_filesize: 20M
echo - post_max_size: 25M
echo.
echo Jika sudah OK, coba upload foto di aplikasi!
echo.
pause
