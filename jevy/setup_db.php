<?php
/**
 * Database Setup & Inbox Helper
 * A beginner-friendly dashboard to test MySQL connection,
 * auto-migrate database.sql, and view received messages.
 */

require_once __DIR__ . '/db_config.php';

$action = $_GET['action'] ?? '';
$actionResult = null;

// Handle manual schema execution action
if ($action === 'migrate') {
    $pdo = getDbConnection();
    if ($pdo) {
        $success = initDatabaseTables($pdo);
        $actionResult = [
            'type' => $success ? 'success' : 'error',
            'message' => $success ? 'Database schema & seed data imported successfully!' : 'Failed to import schema. Check error logs.'
        ];
    } else {
        $actionResult = [
            'type' => 'error',
            'message' => 'Cannot connect to MySQL server. Ensure MySQL is started in your XAMPP Control Panel.'
        ];
    }
}

// Check database status
$dbConnected = isDbConnected();
$dbMessages = [];
$tables = [];

if ($dbConnected) {
    $pdo = getDbConnection();
    try {
        $tablesStmt = $pdo->query("SHOW TABLES");
        $tables = $tablesStmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (in_array('messages', $tables)) {
            $msgStmt = $pdo->query("SELECT * FROM `messages` ORDER BY `created_at` DESC LIMIT 20");
            $dbMessages = $msgStmt->fetchAll();
        }
    } catch (PDOException $e) {
        // Handle error silently
    }
}

// Also read JSON backup messages
$jsonFile = __DIR__ . '/data/messages.json';
$jsonMessages = [];
if (file_exists($jsonFile)) {
    $content = @file_get_contents($jsonFile);
    if ($content) {
        $jsonMessages = json_decode($content, true) ?: [];
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup & Message Inbox | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .admin-page {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-subtle);
        }
        .admin-card {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            padding: 28px;
            margin-bottom: 30px;
            backdrop-filter: blur(12px);
        }
        .status-badge-lg {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 0.9rem;
        }
        .status-connected {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: var(--accent-emerald);
        }
        .status-disconnected {
            background: rgba(244, 63, 94, 0.15);
            border: 1px solid rgba(244, 63, 94, 0.4);
            color: var(--accent-rose);
        }
        .config-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 0.9rem;
        }
        .config-table th, .config-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-subtle);
        }
        .config-table th {
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .config-table code {
            font-family: var(--font-code);
            color: var(--text-code);
            background: var(--bg-surface);
            padding: 2px 6px;
            border-radius: 4px;
        }
        .message-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-md);
            padding: 18px;
            margin-bottom: 14px;
        }
        .msg-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .msg-name {
            font-weight: 700;
            color: var(--text-primary);
        }
        .msg-email {
            font-family: var(--font-code);
            color: var(--primary);
            font-size: 0.85rem;
            margin-left: 8px;
        }
        .msg-date {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        .msg-interest {
            display: inline-block;
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            background: rgba(99, 102, 241, 0.15);
            color: var(--primary);
            margin-bottom: 8px;
        }
        .msg-body {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.5;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="admin-page">
        <div class="admin-header">
            <div>
                <a href="index.php" class="btn btn-outline btn-sm" style="margin-bottom: 12px;">← Back to Portfolio</a>
                <h1 style="font-size: 1.8rem; font-weight: 800;">Portfolio Database & Inbox</h1>
            </div>
            <div>
                <?php if ($dbConnected): ?>
                    <span class="status-badge-lg status-connected">
                        <span class="pulse-dot"></span> MySQL Connected
                    </span>
                <?php else: ?>
                    <span class="status-badge-lg status-disconnected">
                        ✕ MySQL Offline
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($actionResult): ?>
            <div class="flash-alert flash-<?= htmlspecialchars($actionResult['type']) ?>">
                <span class="flash-icon"><?= $actionResult['type'] === 'success' ? '✓' : '⚠' ?></span>
                <span class="flash-text"><?= htmlspecialchars($actionResult['message']) ?></span>
            </div>
        <?php endif; ?>

        <!-- Database Connection Card -->
        <div class="admin-card">
            <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 8px;">MySQL Connection Settings</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Configured in <code>db_config.php</code> for your local XAMPP environment.</p>

            <table class="config-table">
                <thead>
                    <tr>
                        <th>Setting</th>
                        <th>Value</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Database Host</td>
                        <td><code><?= DB_HOST ?></code></td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>Database Name</td>
                        <td><code><?= DB_NAME ?></code></td>
                        <td><?= $dbConnected ? 'Database Exists' : 'Not Connected' ?></td>
                    </tr>
                    <tr>
                        <td>Database User</td>
                        <td><code><?= DB_USER ?></code></td>
                        <td>XAMPP Default</td>
                    </tr>
                    <tr>
                        <td>Charset</td>
                        <td><code><?= DB_CHARSET ?></code></td>
                        <td>UTF-8 Multilingual</td>
                    </tr>
                    <tr>
                        <td>Active Tables</td>
                        <td><code><?= empty($tables) ? 'None' : implode(', ', $tables) ?></code></td>
                        <td><?= count($tables) ?> tables found</td>
                    </tr>
                </tbody>
            </table>

            <div style="display: flex; gap: 12px; align-items: center; margin-top: 16px;">
                <a href="setup_db.php?action=migrate" class="btn btn-primary btn-sm">
                    <span>⚡ Run database.sql Setup / Migrate</span>
                </a>
                <span style="font-size: 0.8rem; color: var(--text-muted);">
                    Imports <code>database.sql</code> into <code><?= DB_NAME ?></code> with tables and seed data.
                </span>
            </div>
        </div>

        <!-- Received Messages Inbox -->
        <div class="admin-card">
            <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 8px;">Contact Form Inquiries</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px;">
                Messages submitted through the portfolio contact form. Stored in MySQL database with JSON backup.
            </p>

            <?php if (!empty($dbMessages)): ?>
                <h3 style="font-size: 1rem; color: var(--primary); margin-bottom: 12px;">Stored in MySQL (<?= count($dbMessages) ?>)</h3>
                <?php foreach ($dbMessages as $msg): ?>
                    <div class="message-card">
                        <div class="msg-top">
                            <div>
                                <span class="msg-name"><?= htmlspecialchars($msg['name']) ?></span>
                                <span class="msg-email"><?= htmlspecialchars($msg['email']) ?></span>
                            </div>
                            <span class="msg-date"><?= htmlspecialchars($msg['created_at']) ?></span>
                        </div>
                        <div style="margin-bottom: 6px;">
                            <span class="msg-interest"><?= htmlspecialchars($msg['interest']) ?></span>
                            <strong><?= htmlspecialchars($msg['subject']) ?></strong>
                        </div>
                        <div class="msg-body"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php elseif (!empty($jsonMessages)): ?>
                <h3 style="font-size: 1rem; color: var(--accent-cyan); margin-bottom: 12px;">Stored in JSON Backup (<?= count($jsonMessages) ?>)</h3>
                <?php foreach ($jsonMessages as $msg): ?>
                    <div class="message-card">
                        <div class="msg-top">
                            <div>
                                <span class="msg-name"><?= htmlspecialchars($msg['name']) ?></span>
                                <span class="msg-email"><?= htmlspecialchars($msg['email']) ?></span>
                            </div>
                            <span class="msg-date"><?= htmlspecialchars($msg['date']) ?></span>
                        </div>
                        <div style="margin-bottom: 6px;">
                            <span class="msg-interest"><?= htmlspecialchars($msg['interest']) ?></span>
                            <strong><?= htmlspecialchars($msg['subject']) ?></strong>
                        </div>
                        <div class="msg-body"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                    <p style="font-size: 1.1rem; margin-bottom: 8px;">No messages received yet.</p>
                    <p style="font-size: 0.85rem;">Test your contact form on the <a href="index.php#contact" style="color: var(--primary); text-decoration: underline;">portfolio page</a>!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
