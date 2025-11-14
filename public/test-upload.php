<?php
/**
 * Quick Upload Test
 * DELETE THIS FILE after testing!
 */

// Check PHP settings
$settings = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'max_execution_time' => ini_get('max_execution_time'),
    'memory_limit' => ini_get('memory_limit'),
];

function convertToMB($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = (int)$val;
    switch($last) {
        case 'g': $val *= 1024;
        case 'm': return $val;
        case 'k': return $val / 1024;
    }
    return $val;
}

$uploadMB = convertToMB($settings['upload_max_filesize']);
$postMB = convertToMB($settings['post_max_size']);

$allGood = ($uploadMB >= 20 && $postMB >= 25);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_file'])) {
    $file = $_FILES['test_file'];
    
    echo "<h2>Upload Test Result:</h2>";
    echo "<pre>";
    echo "File Name: " . $file['name'] . "\n";
    echo "File Size: " . number_format($file['size'] / 1024 / 1024, 2) . " MB\n";
    echo "File Type: " . $file['type'] . "\n";
    echo "Temp Name: " . $file['tmp_name'] . "\n";
    echo "Error Code: " . $file['error'] . "\n";
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        echo "\n✅ FILE UPLOADED SUCCESSFULLY!\n";
        echo "PHP upload limits are working correctly.\n";
        
        // Try to move file
        $uploadDir = __DIR__ . '/../storage/app/public/galleries/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $newName = 'test_' . time() . '_' . basename($file['name']);
        $destination = $uploadDir . $newName;
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo "✅ FILE SAVED TO: $destination\n";
            echo "\nYour upload system is working perfectly!\n";
            echo "You can now delete this test file.\n";
        } else {
            echo "❌ Failed to move file to storage.\n";
            echo "Check folder permissions.\n";
        }
    } else {
        echo "\n❌ UPLOAD ERROR!\n";
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "Error: File exceeds upload_max_filesize (" . $settings['upload_max_filesize'] . ")\n";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "Error: File exceeds MAX_FILE_SIZE in HTML form\n";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "Error: File was only partially uploaded\n";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "Error: No file was uploaded\n";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Error: Missing temporary folder\n";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Error: Failed to write file to disk\n";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "Error: A PHP extension stopped the upload\n";
                break;
            default:
                echo "Error: Unknown error code: " . $file['error'] . "\n";
        }
    }
    echo "</pre>";
    echo '<br><a href="test-upload.php">← Test Again</a>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid <?php echo $allGood ? '#4CAF50' : '#f44336'; ?>;
            padding-bottom: 10px;
        }
        .status {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .setting {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin: 5px 0;
            background: #f9f9f9;
            border-radius: 3px;
        }
        .form-group {
            margin: 20px 0;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            cursor: pointer;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background: #45a049;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #ffeaa7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Upload Test</h1>
        
        <div class="status <?php echo $allGood ? 'success' : 'error'; ?>">
            <?php if ($allGood): ?>
                ✅ PHP Upload Limits: OK
            <?php else: ?>
                ❌ PHP Upload Limits: TOO LOW
            <?php endif; ?>
        </div>

        <h3>Current PHP Settings:</h3>
        <div class="setting">
            <span>upload_max_filesize:</span>
            <strong><?php echo $settings['upload_max_filesize']; ?></strong>
        </div>
        <div class="setting">
            <span>post_max_size:</span>
            <strong><?php echo $settings['post_max_size']; ?></strong>
        </div>
        <div class="setting">
            <span>max_execution_time:</span>
            <strong><?php echo $settings['max_execution_time']; ?>s</strong>
        </div>
        <div class="setting">
            <span>memory_limit:</span>
            <strong><?php echo $settings['memory_limit']; ?></strong>
        </div>

        <?php if (!$allGood): ?>
        <div class="warning">
            <strong>⚠️ WARNING:</strong> Upload limits masih terlalu kecil!<br>
            Pastikan Apache sudah di-restart setelah edit php.ini.
        </div>
        <?php endif; ?>

        <h3>Test Upload File:</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Pilih file untuk test (coba 5-10MB):</label>
                <input type="file" name="test_file" accept="image/*" required>
                <small style="color: #666;">Format: JPG, PNG, GIF</small>
            </div>
            <button type="submit">Upload Test File</button>
        </form>

        <div class="warning" style="margin-top: 30px; background: #ffebee; border-color: #f44336;">
            <strong>🗑️ PENTING:</strong> Hapus file ini (test-upload.php) setelah testing selesai!
        </div>
    </div>
</body>
</html>
