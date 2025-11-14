@echo off
echo ========================================
echo  FIX UPLOAD LIMITS - XAMPP
echo ========================================
echo.

REM Stop Apache
echo [1/4] Menghentikan Apache...
C:\xampp\apache\bin\httpd.exe -k stop
timeout /t 3 /nobreak >nul

REM Backup php.ini
echo [2/4] Backup php.ini...
if not exist "C:\xampp\php\php.ini.backup" (
    copy "C:\xampp\php\php.ini" "C:\xampp\php\php.ini.backup"
    echo Backup dibuat: php.ini.backup
) else (
    echo Backup sudah ada, skip...
)

REM Update php.ini settings
echo [3/4] Mengupdate php.ini...
powershell -Command "(gc C:\xampp\php\php.ini) -replace '^upload_max_filesize\s*=.*', 'upload_max_filesize = 20M' | Out-File -encoding ASCII C:\xampp\php\php.ini.tmp"
powershell -Command "(gc C:\xampp\php\php.ini.tmp) -replace '^post_max_size\s*=.*', 'post_max_size = 25M' | Out-File -encoding ASCII C:\xampp\php\php.ini.tmp2"
powershell -Command "(gc C:\xampp\php\php.ini.tmp2) -replace '^max_execution_time\s*=.*', 'max_execution_time = 300' | Out-File -encoding ASCII C:\xampp\php\php.ini.tmp3"
powershell -Command "(gc C:\xampp\php\php.ini.tmp3) -replace '^memory_limit\s*=.*', 'memory_limit = 256M' | Out-File -encoding ASCII C:\xampp\php\php.ini"
del C:\xampp\php\php.ini.tmp
del C:\xampp\php\php.ini.tmp2
del C:\xampp\php\php.ini.tmp3

REM Start Apache
echo [4/4] Memulai Apache...
C:\xampp\apache\bin\httpd.exe -k start
timeout /t 3 /nobreak >nul

echo.
echo ========================================
echo  SELESAI!
echo ========================================
echo.
echo Silakan cek konfigurasi di:
echo http://localhost/galery_sachi/public/check-php-limits.php
echo.
pause
