<?php
/**
 * Auth Configuration
 * Credentials for portfolio admin access.
 */
define('ADMIN_USERNAME', 'jevytoledo');
define('ADMIN_PASSWORD_HASH', password_hash('jevy12345', PASSWORD_BCRYPT));

// For session validation
function isLoggedIn(): bool {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: /jevy/login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}
