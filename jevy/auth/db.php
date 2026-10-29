<?php
/**
 * Database Connection
 * XAMPP MySQL connection for Jevy Portfolio auth system.
 * Uses the same `portfolio_db` database defined in database.sql.
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

function getDB(): mysqli {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die('<div style="font-family:monospace;background:#1a0000;color:#ff6b6b;padding:20px;border-radius:8px;margin:20px;">
                <strong>Database Error:</strong> ' . htmlspecialchars($conn->connect_error) . '<br><br>
                Please run <a href="/jevy/auth/setup.php" style="color:#38bdf8">auth/setup.php</a> first to create the database.
            </div>');
        }
        $conn->set_charset('utf8mb4');
    }
    return $conn;
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function requireLogin(string $redirect = '/jevy/login.php'): void {
    if (!isLoggedIn()) {
        header('Location: ' . $redirect . '?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}
