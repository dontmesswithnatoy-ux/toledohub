<?php
/**
 * Database Setup Script
 * Run this ONCE at: http://localhost/jevy/auth/setup.php
 * Creates the database and users table.
 */

$conn = new mysqli('localhost', 'root', '', '');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sqls = [
    "CREATE DATABASE IF NOT EXISTS `jevy_portfolio` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",
    "USE `jevy_portfolio`",
    "CREATE TABLE IF NOT EXISTS `users` (
        `id`           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `username`     VARCHAR(60)  NOT NULL UNIQUE,
        `email`        VARCHAR(150) NOT NULL UNIQUE,
        `password`     VARCHAR(255) NOT NULL,
        `full_name`    VARCHAR(120) DEFAULT '',
        `created_at`   DATETIME DEFAULT CURRENT_TIMESTAMP,
        `last_login`   DATETIME DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
];

$errors = [];
foreach ($sqls as $sql) {
    if (!$conn->query($sql)) {
        $errors[] = $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DB Setup</title>
<style>
    body{font-family:monospace;background:#080c14;color:#f1f5f9;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}
    .box{background:rgba(20,28,46,.9);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:40px;max-width:480px;width:100%;text-align:center;}
    h2{font-size:1.4rem;margin-bottom:16px;}
    .ok{color:#34d399;} .err{color:#f87171;}
    a{display:inline-block;margin-top:20px;background:#6366f1;color:#fff;text-decoration:none;padding:10px 22px;border-radius:8px;font-weight:700;}
</style>
</head>
<body>
<div class="box">
<?php if (empty($errors)): ?>
    <h2 class="ok">✅ Database Ready!</h2>
    <p>Database <strong>jevy_portfolio</strong> and table <strong>users</strong> created successfully.</p>
    <a href="/jevy/register.php">Go to Register →</a>
<?php else: ?>
    <h2 class="err">❌ Setup Error</h2>
    <?php foreach ($errors as $e): ?>
        <p class="err"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
<?php endif; ?>
</div>
</body>
</html>
