<?php

class SessionHelper
{
    public static function start(): void
    {

        // Set relative path to directotry
        $sessionPath = __DIR__ . "/../../sessions";

        // Check if exist, create if not
        if (!is_dir($sessionPath)) {
            mkdir($sessionPath, 0777, false);
        }

        session_save_path($sessionPath);

        // Set session lifetime to 7 days (604800 seconds)
        ini_set('session.gc_maxlifetime', 604800);

        // Set session cookie parameters (persist across browser restarts)
        session_set_cookie_params([
            'lifetime' => 604800,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        // Start session only if not already active
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
                $params = session_get_cookie_params();

                // Remove the session cookie by setting it to expire in the past
                setcookie(
                    session_name(),        // Cookie name (e.g. "PHPSESSID")
                    '',                    // Empty value
                    time() - 42000,        // Expired
                    $params["path"],       // Match original path
                    $params["domain"],     // Match original domain
                    $params["secure"],     // Match original secure flag
                    $params["httponly"]    // Match original httponly flag
                );
            }

            // Destroy the session
            session_destroy();
        }
    }
}
