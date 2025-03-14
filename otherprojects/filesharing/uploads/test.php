<?php
// Define the base directory that you want to expose.
$baseDir = '/';
$realBase = realpath($baseDir);
if ($realBase === false) {
    die("Base directory does not exist.");
}

// Get the current directory from the GET parameter, defaulting to the base.
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : '';
$currentPath = realpath($realBase . DIRECTORY_SEPARATOR . $currentDir);

// Verify that the requested path is valid and within the base directory.
if ($currentPath === false || strpos($currentPath, $realBase) !== 0) {
    die("Access denied.");
}

// Handle file download request
if (isset($_GET['download'])) {
    $downloadFile = $_GET['download'];
    $filePath = realpath($currentPath . DIRECTORY_SEPARATOR . $downloadFile);
    if ($filePath === false || strpos($filePath, $realBase) !== 0 || !is_file($filePath)) {
        die("Invalid file.");
    }
    // Set headers to trigger a file download.
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple PHP File Browser</title>
    <style>
        body { font-family: Arial, sans-serif; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 5px 0; }
        a { text-decoration: none; color: #1a73e8; }
        a:hover { text-decoration: underline; }
        .label { font-weight: bold; margin-right: 5px; }
    </style>
</head>
<body>
    <h2>File Browser</h2>
    <p><strong>Current Directory:</strong> <?php echo htmlspecialchars(str_replace($realBase, '', $currentPath)); ?></p>

    <?php
    // Display a "Back" link if we're not at the base directory.
    if ($currentPath !== $realBase) {
        // Determine the parent directory relative to the base.
        $relativePath = trim(str_replace($realBase, '', $currentPath), '/\\');
        $parent = dirname($relativePath);
        $backLink = '?dir=' . ($parent === '.' ? '' : urlencode($parent));
        echo '<p><a href="' . $backLink . '">Back</a></p>';
    }
    ?>

    <ul>
    <?php
    // Read and list directory items.
    $items = scandir($currentPath);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $itemPath = $currentPath . DIRECTORY_SEPARATOR . $item;
        $encodedItem = urlencode($item);
        if (is_dir($itemPath)) {
            // Create a clickable link for directories.
            // The link passes the new directory path in the 'dir' GET parameter.
            $newDir = trim(str_replace($realBase, '', $itemPath), '/\\');
            $link = '?dir=' . urlencode($newDir);
            echo '<li><span class="label">[DIR]</span> <a href="' . $link . '">' . htmlspecialchars($item) . '</a></li>';
        } else {
            // For files, provide a download link.
            // Clicking the link triggers the download code above.
            $link = '?dir=' . urlencode(trim(str_replace($realBase, '', $currentPath), '/\\')) . '&download=' . $encodedItem;
            echo '<li><span class="label">[FILE]</span> <a href="' . $link . '">' . htmlspecialchars($item) . '</a></li>';
        }
    }
    ?>
    </ul>
</body>
</html>
