<?php
// Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load the session helper
require_once __DIR__ . '/../php/helpers/session-helper.php';

// Start the session (creates the folder, sets lifetime, handles cookie)
SessionHelper::start();

$defaultSessionFile = '/tmp/sess_' . session_id();
echo "Checking fallback location: $defaultSessionFile<br>";
echo "Exists in /tmp? " . (file_exists($defaultSessionFile) ? 'Yes ✅' : 'No ❌') . "<br>";

// Debug info
$sessionPath = ini_get('session.save_path');
$sessionId = session_id();
$sessionFile = $sessionPath . '/sess_' . $sessionId;

echo "Session path: $sessionPath<br>";
echo "Writable? " . (is_writable($sessionPath) ? 'Yes ✅' : 'No ❌') . "<br>";
echo "Session ID: $sessionId<br>";
echo "Expected session file: $sessionFile<br>";
echo "Session file exists? " . (file_exists($sessionFile) ? 'Yes ✅' : 'No ❌') . "<br>";

// Session test logic
$_SESSION['test'] = $_SESSION['test'] ?? 0;
$_SESSION['test']++;
echo "Session counter: " . $_SESSION['test'];

// Optional: force session to write now (in case the script is long)
session_write_close();
