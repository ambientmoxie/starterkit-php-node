<?php

// Example: user visits http://localhost:8888/contact
// $_SERVER['REQUEST_URI'] = "/contact"

// Extract the path from the URL (e.g. "/contact", "/about", "/")
// Result: "/contact"
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Clean the path by removing any leading/trailing slashes
// "/contact/" becomes "contact", "/" becomes ""
// Result: "contact"
$uri = trim($uri, '/');

// If the cleaned path is empty (i.e. the user visited "/"), set page to "home"
// Otherwise, use the path directly
// "" → "home", "about" → "about", "contact" → "contact"
$page = $uri === '' ? 'home' : $uri;

// Build the full path to the corresponding page file
// "contact" becomes "/pages/contact.php"
$file = __DIR__ . "/pages/{$page}.php";

// If the page file exists, include it
// This renders the correct content (like pages/contact.php)
if (file_exists($file)) {
    require $file;
} else {
    // If the page doesn't exist, show a 404 error and load pages/404.php
    // Example: "/random-page" → pages/404.php
    http_response_code(404);
    require __DIR__ . "/pages/404.php";
}
