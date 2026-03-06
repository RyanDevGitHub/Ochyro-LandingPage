<?php

declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = __DIR__ . $path;

if ($path !== '/') {
    $isAssetRequest = str_starts_with($path, '/assets/');

    if (is_file($file) || ($isAssetRequest && is_dir($file))) {
        return false;
    }
}

require __DIR__ . '/index.php';
