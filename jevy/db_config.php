<?php
/**
 * Database Configuration & Connection Helper
 * Configured for standard local XAMPP MySQL environment.
 * Uses PHP Data Objects (PDO) with prepared statements for security.
 */

// Database Credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Returns active PDO connection or null if unavailable.
 * Designed with a graceful fallback so the site never crashes if MySQL is offline.
 */
function getDbConnection() {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        // If database does not exist, try to auto-create it
        if ($e->getCode() == 1049) {
            try {
                $serverDsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
                $serverPdo = new PDO($serverDsn, DB_USER, DB_PASS, $options);
                $serverPdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                
                // Now reconnect to the newly created database
                $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
                
                // Run schema initialization from database.sql if present
                initDatabaseTables($pdo);
                return $pdo;
            } catch (PDOException $ex) {
                error_log("Database Auto-Creation Error: " . $ex->getMessage());
                return null;
            }
        }

        // Log error and return null to trigger graceful file-based fallback
        error_log("Database Connection Failed: " . $e->getMessage());
        return null;
    }
}

/**
 * Automatically initializes tables and default seed data from database.sql
 */
function initDatabaseTables($pdo) {
    $sqlFile = __DIR__ . '/database.sql';
    if (!file_exists($sqlFile)) {
        return false;
    }

    try {
        $sql = file_get_contents($sqlFile);
        // Remove CREATE DATABASE and USE statements since we are already connected to portfolio_db
        $cleanSql = preg_replace('/CREATE DATABASE.*?;\s*/si', '', $sql);
        $cleanSql = preg_replace('/USE `?portfolio_db`?;\s*/si', '', $cleanSql);
        
        $pdo->exec($cleanSql);
        return true;
    } catch (PDOException $e) {
        error_log("Schema Initialization Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Check if Database is connected and active
 */
function isDbConnected() {
    return getDbConnection() !== null;
}

/**
 * Save incoming contact form submission to database
 */
function saveContactMessage($data) {
    $pdo = getDbConnection();
    if (!$pdo) {
        return false;
    }

    $sql = "INSERT INTO `messages` (`name`, `email`, `subject`, `interest`, `message`, `ip_address`, `is_read`, `created_at`) 
            VALUES (:name, :email, :subject, :interest, :message, :ip, 0, NOW())";

    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':name'     => $data['name'],
            ':email'    => $data['email'],
            ':subject'  => $data['subject'] ?? 'Portfolio Inquiry',
            ':interest' => $data['interest'] ?? 'General Inquiry',
            ':message'  => $data['message'],
            ':ip'       => $data['ip_address'] ?? ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1')
        ]);
    } catch (PDOException $e) {
        error_log("Error saving message to DB: " . $e->getMessage());
        return false;
    }
}

/**
 * Fetch all contact inquiries from database
 */
function getContactMessages($limit = 50) {
    $pdo = getDbConnection();
    if (!$pdo) {
        return [];
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM `messages` ORDER BY `created_at` DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error retrieving messages from DB: " . $e->getMessage());
        return [];
    }
}
