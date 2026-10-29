<?php
session_start();
require_once __DIR__ . '/auth/db.php';

$errors  = [];
$success = '';

// Already logged in
if (isLoggedIn()) {
    header('Location: /jevy/admin/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $username  = trim($_POST['username']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $password  = $_POST['password']  ?? '';
    $confirm   = $_POST['confirm']   ?? '';

    // Validate
    if (strlen($full_name) < 2)
        $errors['full_name'] = 'Full name must be at least 2 characters.';

    if (!preg_match('/^[a-zA-Z0-9_]{3,30}$/', $username))
        $errors['username'] = 'Username must be 3–30 characters (letters, numbers, underscores only).';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email'] = 'Please enter a valid email address.';

    if (strlen($password) < 6)
        $errors['password'] = 'Password must be at least 6 characters.';
    elseif ($password !== $confirm)
        $errors['confirm'] = 'Passwords do not match.';

    if (empty($errors)) {
        $db = getDB();

        // Check duplicates
        $stmt = $db->prepare('SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1');
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Find which one is taken
            $chk = $db->prepare('SELECT username, email FROM users WHERE username = ? OR email = ?');
            $chk->bind_param('ss', $username, $email);
            $chk->execute();
            $chk->bind_result($ex_user, $ex_email);
            $chk->fetch();
            $chk->close();

            if ($ex_user === $username) $errors['username'] = 'This username is already taken.';
            if ($ex_email === $email)   $errors['email']    = 'This email is already registered.';
        } else {
            $stmt->close();
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $ins  = $db->prepare('INSERT INTO users (full_name, username, email, password) VALUES (?,?,?,?)');
            $ins->bind_param('ssss', $full_name, $username, $email, $hash);
            if ($ins->execute()) {
                $success = 'Account created! You can now log in.';
            } else {
                $errors['general'] = 'Registration failed. Please try again.';
            }
            $ins->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — Jevy Toledo Portfolio</title>
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
        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Join Jevy Toledo's Portfolio</p>
    </div>

    <!-- Tab Switcher -->
    <div class="auth-tabs">
        <a href="login.php" class="auth-tab" id="tab-login">Sign In</a>
        <a href="register.php" class="auth-tab active" id="tab-register">Create Account</a>
    </div>

    <!-- Alerts -->
    <?php if ($success): ?>
        <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <?= htmlspecialchars($success) ?>
            &nbsp;<a href="login.php" style="color:#6ee7b7;text-decoration:underline;">Go to Login →</a>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <?= htmlspecialchars($errors['general']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" id="register-form" novalidate>

        <!-- Full Name -->
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
                <input type="text" id="full_name" name="full_name"
                    placeholder="e.g. Jevy B. Toledo"
                    value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>"
                    class="<?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                    autocomplete="name">
            </div>
            <?php if (isset($errors['full_name'])): ?>
                <span class="field-hint error"><?= htmlspecialchars($errors['full_name']) ?></span>
            <?php endif; ?>
        </div>

        <!-- Username + Email row -->
        <div class="form-row">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                    <input type="text" id="username" name="username"
                        placeholder="jevytoledo"
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        class="<?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                        autocomplete="username">
                </div>
                <?php if (isset($errors['username'])): ?>
                    <span class="field-hint error"><?= htmlspecialchars($errors['username']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </span>
                    <input type="email" id="email" name="email"
                        placeholder="you@email.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="<?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                        autocomplete="email">
                </div>
                <?php if (isset($errors['email'])): ?>
                    <span class="field-hint error"><?= htmlspecialchars($errors['email']) ?></span>
                <?php endif; ?>
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
                    placeholder="Min. 6 characters"
                    class="<?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                    autocomplete="new-password"
                    oninput="checkStrength(this.value)">
                <button type="button" class="toggle-pw" onclick="togglePw('password','eye1')" aria-label="Toggle">
                    <svg id="eye1" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            <div class="strength-bar-wrap"><div class="strength-bar-fill" id="strength-fill"></div></div>
            <span class="field-hint" id="strength-label"></span>
            <?php if (isset($errors['password'])): ?>
                <span class="field-hint error"><?= htmlspecialchars($errors['password']) ?></span>
            <?php endif; ?>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="confirm">Confirm Password</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                </span>
                <input type="password" id="confirm" name="confirm"
                    placeholder="Re-enter password"
                    class="<?= isset($errors['confirm']) ? 'is-invalid' : '' ?>"
                    autocomplete="new-password">
                <button type="button" class="toggle-pw" onclick="togglePw('confirm','eye2')" aria-label="Toggle">
                    <svg id="eye2" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            <?php if (isset($errors['confirm'])): ?>
                <span class="field-hint error"><?= htmlspecialchars($errors['confirm']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-auth btn-primary-auth" id="register-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
            Create My Account
        </button>
    </form>

    <a href="/jevy/" class="back-link">← Back to Portfolio</a>

    <div class="security-note">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        Passwords are hashed with bcrypt — never stored in plain text
    </div>
</div>

<script>
function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}

function checkStrength(pw) {
    const fill  = document.getElementById('strength-fill');
    const label = document.getElementById('strength-label');
    let score = 0;
    if (pw.length >= 6)  score++;
    if (pw.length >= 10) score++;
    if (/[A-Z]/.test(pw)) score++;
    if (/[0-9]/.test(pw)) score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;

    const map = [
        { pct: '0%',   color: 'transparent', text: '' },
        { pct: '25%',  color: '#ef4444',     text: '🔴 Very Weak' },
        { pct: '50%',  color: '#f97316',     text: '🟠 Weak' },
        { pct: '70%',  color: '#eab308',     text: '🟡 Fair' },
        { pct: '90%',  color: '#22c55e',     text: '🟢 Strong' },
        { pct: '100%', color: '#10b981',     text: '✅ Very Strong' },
    ];
    fill.style.width      = map[score].pct;
    fill.style.background = map[score].color;
    label.textContent     = map[score].text;
    label.style.color     = map[score].color;
}

document.getElementById('register-form').addEventListener('submit', function() {
    const btn = document.getElementById('register-btn');
    btn.innerHTML = '<svg class="spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" opacity=".2"/><path d="M21 12a9 9 0 00-9-9"/></svg> Creating account...';
    btn.disabled = true;
});
</script>
</body>
</html>
