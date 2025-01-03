<?php

function baseUrl()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    return $protocol . '://' . $host;
}


function hashedAssetURL($type)
{

    $subfolder = $_ENV['VITE_ROOT'];
    $manifest_path = $_SERVER['DOCUMENT_ROOT'] . $subfolder . '/assets/bundle/.vite/manifest.json';
    $manifest = json_decode(file_get_contents($manifest_path), true);
    error_log("path is: " . $manifest_path);
    $assetPath = $type === "js"
        ? '/assets/bundle/' . $manifest["assets/js/main.js"]['file']
        : '/assets/bundle/' . $manifest["assets/js/main.js"]['css'][0];
    return baseUrl() . $subfolder . $assetPath;
}
