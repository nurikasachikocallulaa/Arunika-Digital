<?php
/**
 * PHP Configuration Checker
 * This file helps verify PHP upload limits
 * Access via: http://localhost/galery_sachi/public/check-php-limits.php
 * DELETE THIS FILE after checking (for security)
 */

$settings = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'max_execution_time' => ini_get('max_execution_time'),
    'max_input_time' => ini_get('max_input_time'),
    'memory_limit' => ini_get('memory_limit'),
];

function convertToBytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = (int)$val;
    switch($last) {
        case 'g': $val *= 1024;
        case 'm': $val *= 1024;
        case 'k': $val *= 1024;
    }
    return $val;
}

$uploadBytes = convertToBytes($settings['upload_max_filesize']);
$postBytes = convertToBytes($settings['post_max_size']);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Upload Limits Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
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
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        .setting {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            margin: 10px 0;
            background: #f9f9f9;
            border-left: 4px solid #4CAF50;
            border-radius: 5px;
        }
        .setting.warning {
            border-left-color: #ff9800;
            background: #fff3e0;
        }
        .setting.error {
            border-left-color: #f44336;
            background: #ffebee;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
            font-family: monospace;
            font-size: 16px;
        }
        .status {
            margin-top: 30px;
            padding: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .status.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status.warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .status.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .instructions {
            margin-top: 30px;
            padding: 20px;
            background: #e3f2fd;
            border-radius: 5px;
            border-left: 4px solid #2196F3;
        }
        .instructions h3 {
            margin-top: 0;
            color: #1976D2;
        }
        .instructions ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin: 8px 0;
            line-height: 1.6;
        }
        code {
            background: #263238;
            color: #aed581;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
        .delete-warning {
            margin-top: 20px;
            padding: 15px;
            background: #ffebee;
            border: 2px solid #f44336;
            border-radius: 5px;
            color: #c62828;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 PHP Upload Limits Configuration</h1>
        
        <div class="setting <?php echo $uploadBytes >= 20*1024*1024 ? '' : 'warning'; ?>">
            <span class="label">upload_max_filesize:</span>
            <span class="value"><?php echo $settings['upload_max_filesize']; ?></span>
        </div>
        
        <div class="setting <?php echo $postBytes >= 25*1024*1024 ? '' : 'warning'; ?>">
            <span class="label">post_max_size:</span>
            <span class="value"><?php echo $settings['post_max_size']; ?></span>
        </div>
        
        <div class="setting">
            <span class="label">max_execution_time:</span>
            <span class="value"><?php echo $settings['max_execution_time']; ?> seconds</span>
        </div>
        
        <div class="setting">
            <span class="label">max_input_time:</span>
            <span class="value"><?php echo $settings['max_input_time']; ?> seconds</span>
        </div>
        
        <div class="setting">
            <span class="label">memory_limit:</span>
            <span class="value"><?php echo $settings['memory_limit']; ?></span>
        </div>

        <?php if ($uploadBytes >= 20*1024*1024 && $postBytes >= 25*1024*1024): ?>
            <div class="status success">
                ✅ Configuration is correct! Your server can now handle uploads up to 20MB.
            </div>
        <?php else: ?>
            <div class="status warning">
                ⚠️ Configuration needs adjustment. Follow the instructions below.
            </div>
            
            <div class="instructions">
                <h3>📋 How to Fix Upload Limits in XAMPP:</h3>
                <ol>
                    <li>Open XAMPP Control Panel</li>
                    <li>Click <strong>"Config"</strong> button next to Apache</li>
                    <li>Select <strong>"PHP (php.ini)"</strong></li>
                    <li>Find and modify these lines (remove <code>;</code> if present):
                        <ul>
                            <li><code>upload_max_filesize = 20M</code></li>
                            <li><code>post_max_size = 25M</code></li>
                            <li><code>max_execution_time = 300</code></li>
                            <li><code>max_input_time = 300</code></li>
                            <li><code>memory_limit = 256M</code></li>
                        </ul>
                    </li>
                    <li>Save the file</li>
                    <li>Restart Apache from XAMPP Control Panel</li>
                    <li>Refresh this page to verify the changes</li>
                </ol>
                
                <p><strong>Note:</strong> The <code>post_max_size</code> should always be larger than <code>upload_max_filesize</code></p>
            </div>
        <?php endif; ?>

        <div class="delete-warning">
            ⚠️ SECURITY WARNING: Delete this file (check-php-limits.php) after checking your configuration!
        </div>
    </div>
</body>
</html>
