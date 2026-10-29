<?php
session_start();
require_once __DIR__ . '/auth/db.php';

$error = '';

if (isLoggedIn()) {
    header('Location: /jevy/admin/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $db   = getDB();
        $stmt = $db->prepare('SELECT id, full_name, password FROM users WHERE username = ? OR email = ? LIMIT 1');
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $stmt->bind_result($uid, $full_name, $hash);

        if ($stmt->fetch() && password_verify($password, $hash)) {
            session_regenerate_id(true);
            $_SESSION['user_id']   = $uid;
            $_SESSION['username']  = $username;
            $_SESSION['full_name'] = $full_name;

            // Update last_login
            $stmt->close();
            $upd = $db->prepare('UPDATE users SET last_login = NOW() WHERE id = ?');
            $upd->bind_param('i', $uid);
            $upd->execute();
            $upd->close();

            $redirect = $_GET['redirect'] ?? '/jevy/admin/index.php';
            header('Location: ' . $redirect);
            exit;
        } else {
            $error = 'Incorrect username/email or password. Please try again.';
        }
        $stmt->close();
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Jevy Toledo Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

<!-- Ambient blobs -->
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<div class="auth-card">

    <!-- Logo -->
    <div class="auth-logo">
        <div class="logo-badge">JT</div>
        <h1 class="auth-title">Welcome Back</h1>
        <p class="auth-subtitle">Sign in to your account</p>
    </div>

    <!-- Tab Switcher -->
    <div class="auth-tabs">
        <a href="login.php" class="auth-tab active" id="tab-login">Sign In</a>
        <a href="register.php" class="auth-tab" id="tab-register">Create Account</a>
    </div>

    <!-- Error -->
    <?php if ($error): ?>
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" id="login-form" novalidate>

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username or Email</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
                <input type="text" id="username" name="username"
                    placeholder="Username or email"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    required autofocus
                    autocomplete="username">
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                </span>
                <input type="password" id="password" name="password"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password">
                <button type="button" class="toggle-pw" onclick="togglePw()" aria-label="Toggle password">
                    <svg id="eye-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-auth btn-primary-auth" id="login-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Sign In
        </button>

        <div class="auth-divider">or</div>

        <a href="register.php" style="
            display:flex; align-items:center; justify-content:center; gap:8px;
            border:1px solid rgba(255,255,255,0.12); border-radius:10px; padding:12px;
            font-size:0.88rem; font-weight:700; color:var(--text-secondary);
            text-decoration:none; transition:all 0.2s;
        " onmouseover="this.style.borderColor='rgba(99,102,241,0.5)';this.style.color='#fff'"
           onmouseout="this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='var(--text-secondary)'">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
            Create a new account
        </a>
    </form>

    <a href="/jevy/" class="back-link">← Back to Portfolio</a>

    <div class="security-note">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        Secured with PHP session authentication &amp; bcrypt
    </div>
</div>

<script>
function togglePw() {
    const pw   = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
    } else {
        pw.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}
document.getElementById('login-form').addEventListener('submit', function() {
    const btn = document.getElementById('login-btn');
    btn.innerHTML = '<svg class="spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" opacity=".2"/><path d="M21 12a9 9 0 00-9-9"/></svg> Signing in...';
    btn.disabled = true;
});
</script>
</body>
</html>
