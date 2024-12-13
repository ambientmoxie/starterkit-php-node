<?php

// Check if the requested file exists
if (file_exists(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    // Serve the static file directly (js, css, image)
    return false;
}

// Main entry point
require_once __DIR__ . '/index.php';
