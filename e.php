<?php

$zipFile = 'deploy.zip';
$extractPath = dirname(__DIR__) . '/staloysius'; // one level up + /staloysius

if (!file_exists($zipFile)) {
    die("❌ File $zipFile does not exist.");
}

// Create the folder if it doesn't exist
if (!is_dir($extractPath)) {
    mkdir($extractPath, 0755, true);
}

$zip = new ZipArchive;
$res = $zip->open($zipFile);

if ($res === TRUE) {
    $zip->extractTo($extractPath);
    $zip->close();
    echo "✅ Project extracted successfully to $extractPath.<br>";
    unlink($zipFile);
    unlink(__FILE__);
    echo "🧹 Cleaned up deploy.zip and extract.php.";
} else {
    echo "❌ Failed to extract ZIP. Error Code: $res<br>";

    switch ($res) {
        case ZipArchive::ER_NOZIP:
            echo "Not a zip archive.";
            break;
        case ZipArchive::ER_INCONS:
            echo "Zip archive inconsistent.";
            break;
        case ZipArchive::ER_CRC:
            echo "CRC error.";
            break;
        case ZipArchive::ER_OPEN:
            echo "Can't open file.";
            break;
        default:
            echo "Unknown error.";
    }
}
