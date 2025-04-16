<?php

class SessionHelper
{
    public static function start(?string $customPath = null): void
    {
        $defaultPath = realpath(__DIR__ . '/../../sessions');
        $path = $customPath ?? $defaultPath;

        if (!is_dir($path)) {
            mkdir($path, 0700, true);
        }

        ini_set('session.save_path', $path);
        ini_set('session.gc_maxlifetime', 604800); // 7 days

        session_set_cookie_params([
            'lifetime' => 604800,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            // Clear all session variables
            $_SESSION = [];

            // Check if PHP is using cookies to store the session ID
            if (ini_get("session.use_cookies")) {

                // Get the current cookie settings (used when the session cookie was created)
                $params = session_get_cookie_params();

                // Remove the session cookie by:
                // - Setting its name (usually "PHPSESSID")
                // - Setting its value to an empty string
                // - Setting its expiration time to a time in the past (so the browser deletes it)
                // - Reusing all the original parameters (path, domain, secure, httponly)
                //   so the browser correctly matches and removes the cookie
                setcookie(
                    session_name(),        // Cookie name (e.g. "PHPSESSID")
                    '',                    // Empty value
                    time() - 42000,        // Expire in the past → triggers deletion
                    $params["path"],       // Must match original path
                    $params["domain"],     // Must match original domain
                    $params["secure"],     // Must match original secure flag
                    $params["httponly"]    // Must match original httponly flag
                );
            }

            // Destroy the session
            session_destroy();
        }
    }
}
