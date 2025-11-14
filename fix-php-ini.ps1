# PowerShell Script to Fix PHP Upload Limits in XAMPP
# Run as Administrator for best results

Write-Host "========================================" -ForegroundColor Cyan
Write-Host " FIX PHP UPLOAD LIMITS - XAMPP" -ForegroundColor Yellow
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$phpIniPath = "C:\xampp\php\php.ini"

# Check if php.ini exists
if (-not (Test-Path $phpIniPath)) {
    Write-Host "ERROR: php.ini tidak ditemukan di $phpIniPath" -ForegroundColor Red
    Write-Host "Pastikan XAMPP terinstall di C:\xampp" -ForegroundColor Yellow
    pause
    exit
}

Write-Host "[1/5] Membaca php.ini..." -ForegroundColor Green
$content = Get-Content $phpIniPath

# Backup
$backupPath = "$phpIniPath.backup-$(Get-Date -Format 'yyyyMMdd-HHmmss')"
Write-Host "[2/5] Membuat backup ke: $backupPath" -ForegroundColor Green
Copy-Item $phpIniPath $backupPath

# Settings to update
$settings = @{
    'upload_max_filesize' = '20M'
    'post_max_size' = '25M'
    'max_execution_time' = '300'
    'max_input_time' = '300'
    'memory_limit' = '256M'
}

Write-Host "[3/5] Mengupdate konfigurasi..." -ForegroundColor Green

$newContent = @()
$updated = @{}

foreach ($line in $content) {
    $modified = $false
    
    foreach ($setting in $settings.Keys) {
        # Match both commented and uncommented lines
        $pattern = "^\s*;?\s*" + $setting + "\s*="
        if ($line -match $pattern) {
            $newLine = "$setting = " + $settings[$setting]
            $newContent += $newLine
            $updated[$setting] = $true
            $modified = $true
            Write-Host "  Updated: $newLine" -ForegroundColor Yellow
            break
        }
    }
    
    if (-not $modified) {
        $newContent += $line
    }
}

# Add missing settings
foreach ($setting in $settings.Keys) {
    if (-not $updated[$setting]) {
        $newLine = "$setting = " + $settings[$setting]
        $newContent += $newLine
        Write-Host "  Added: $newLine" -ForegroundColor Cyan
    }
}

Write-Host "[4/5] Menyimpan perubahan..." -ForegroundColor Green
$newContent | Out-File -FilePath $phpIniPath -Encoding ASCII

Write-Host "[5/5] Restart Apache..." -ForegroundColor Green
Write-Host ""
Write-Host "Silakan restart Apache melalui XAMPP Control Panel:" -ForegroundColor Yellow
Write-Host "  1. Klik tombol 'Stop' pada Apache" -ForegroundColor White
Write-Host "  2. Tunggu beberapa detik" -ForegroundColor White
Write-Host "  3. Klik tombol 'Start' pada Apache" -ForegroundColor White
Write-Host ""

Write-Host "========================================" -ForegroundColor Cyan
Write-Host " SELESAI!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Verifikasi perubahan di:" -ForegroundColor Yellow
Write-Host "http://localhost/galery_sachi/public/check-php-limits.php" -ForegroundColor Cyan
Write-Host ""
Write-Host "Backup tersimpan di:" -ForegroundColor Yellow
Write-Host $backupPath -ForegroundColor Cyan
Write-Host ""

pause
