<?php
// CRITICAL: Check actual PHP limits being used by Apache
// DELETE after fixing!

echo "<h1>PHP Upload Limits - Apache</h1>";
echo "<pre>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "\n";

// Convert to bytes
function convertToBytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $num = (int)$val;
    switch($last) {
        case 'g': $num *= 1024;
        case 'm': $num *= 1024;
        case 'k': $num *= 1024;
    }
    return $num;
}

$uploadBytes = convertToBytes(ini_get('upload_max_filesize'));
$postBytes = convertToBytes(ini_get('post_max_size'));

echo "upload_max_filesize (bytes): " . number_format($uploadBytes) . " (" . round($uploadBytes/1024/1024, 2) . " MB)\n";
echo "post_max_size (bytes): " . number_format($postBytes) . " (" . round($postBytes/1024/1024, 2) . " MB)\n";
echo "\n";

if ($uploadBytes >= 20*1024*1024 && $postBytes >= 25*1024*1024) {
    echo "✅ STATUS: OK - Limits sudah cukup besar!\n";
    echo "✅ Anda bisa upload file sampai 15MB\n";
} else {
    echo "❌ STATUS: TOO LOW - Limits masih terlalu kecil!\n";
    echo "❌ Apache belum membaca konfigurasi baru!\n";
    echo "\n";
    echo "SOLUSI:\n";
    echo "1. Edit C:\\xampp\\php\\php.ini\n";
    echo "2. Ubah upload_max_filesize = 20M\n";
    echo "3. Ubah post_max_size = 25M\n";
    echo "4. RESTART Apache di XAMPP Control Panel\n";
    echo "5. Refresh halaman ini\n";
}

echo "\n";
echo "Loaded Configuration File: " . php_ini_loaded_file() . "\n";
echo "</pre>";

echo "<hr>";
echo "<h2>Test Upload</h2>";
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<input type='file' name='test' accept='image/*'><br><br>";
echo "<button type='submit'>Test Upload</button>";
echo "</form>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test'])) {
    echo "<h3>Upload Result:</h3>";
    echo "<pre>";
    print_r($_FILES['test']);
    
    if ($_FILES['test']['error'] === UPLOAD_ERR_OK) {
        echo "\n✅ FILE UPLOADED SUCCESSFULLY!\n";
        echo "Size: " . round($_FILES['test']['size']/1024/1024, 2) . " MB\n";
    } else {
        echo "\n❌ UPLOAD FAILED!\n";
        echo "Error Code: " . $_FILES['test']['error'] . "\n";
        
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File terlalu besar (melebihi upload_max_filesize)',
            UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (melebihi MAX_FILE_SIZE)',
            UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
            UPLOAD_ERR_NO_FILE => 'Tidak ada file',
            UPLOAD_ERR_NO_TMP_DIR => 'Folder temp tidak ada',
            UPLOAD_ERR_CANT_WRITE => 'Gagal menulis ke disk',
            UPLOAD_ERR_EXTENSION => 'Dihentikan oleh extension',
        ];
        
        echo "Error: " . ($errors[$_FILES['test']['error']] ?? 'Unknown') . "\n";
    }
    echo "</pre>";
}

echo "<hr>";
echo "<p><strong>⚠️ HAPUS FILE INI SETELAH SELESAI!</strong></p>";
?>
