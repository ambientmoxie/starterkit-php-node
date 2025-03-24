<?php

/**
 * AssetHelper provides utility methods for generating base URLs and hashed asset URLs
 * from a Vite manifest file, ensuring correct file paths for js and CSS assets after "build".
 */

class AssetHelper
{

    // Determines the current protocol and host to construct the base URL
    public static function baseUrl(): string
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . '://' . $host;
    }

    // Returns the correct asset path based on the given type (css or js)
    public static function hashedAssetURL(string $type): string
    {
        // Resolving the root folder
        $subfolder = $_ENV['VITE_ROOT'] ?? '';
        // Finding the correct path to manifest.json and throwing an error if not found
        $manifestPath = $_SERVER['DOCUMENT_ROOT'] . $subfolder . '/assets/bundle/.vite/manifest.json';
        if (!file_exists($manifestPath)) throw new Exception("Manifest file not found at path: $manifestPath");

        // Attempts to read the file and throws an error if it fails.
        $manifest = json_decode(file_get_contents($manifestPath), true);
        if (!$manifest) throw new Exception("Failed to decode manifest file.");

        // Attempts to access the key and throws an error if it is not found.
        if (!isset($manifest["assets/js/main.js"])) throw new Exception("Static files array is not found in manifest.");

        // Assign a value to $assetPath by checking the value of $type argument.
        $assetPath = $type === "js"
            ? '/assets/bundle/' . $manifest["assets/js/main.js"]['file']
            : '/assets/bundle/' . $manifest["assets/js/main.js"]['css'][0] ?? null;

        // Throws an error if no value has been assigned to $assetPath.
        if (!$assetPath) throw new Exception("Asset path for type '$type' not found.");

        // Return the final url
        return self::baseUrl() . $subfolder . $assetPath;
    }
}
