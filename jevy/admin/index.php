<?php
session_start();
require_once __DIR__ . '/../auth/db.php';
requireLogin();

$db       = getDB();
$username  = htmlspecialchars($_SESSION['username']  ?? 'Admin');
$full_name = htmlspecialchars($_SESSION['full_name'] ?? $username);

// Stats
$user_count = $db->query('SELECT COUNT(*) FROM users')->fetch_row()[0] ?? 0;
$login_time = date('M d, Y — H:i', $_SESSION['login_time'] ?? time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Jevy Toledo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #080c14; --surface: #0f1624; --card: rgba(16,24,42,.85);
            --primary: #6366f1; --accent: #38bdf8; --green: #10b981;
            --text: #f1f5f9; --muted: #94a3b8; --border: rgba(255,255,255,.1);
        }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }

        /* Topbar */
        .topbar {
            background:rgba(10,15,28,.92); border-bottom:1px solid var(--border);
            backdrop-filter:blur(16px); padding:0 28px;
            display:flex; align-items:center; justify-content:space-between; height:62px;
            position:sticky; top:0; z-index:100;
        }
        .topbar-brand { display:flex; align-items:center; gap:12px; }
        .topbar-logo {
            width:38px; height:38px; border-radius:10px;
            background:linear-gradient(135deg,var(--primary),var(--accent));
            display:flex; align-items:center; justify-content:center;
            font-family:'JetBrains Mono',monospace; font-weight:700; font-size:.9rem;
        }
        .topbar-title { font-size:1rem; font-weight:800; }
        .topbar-title span { color:var(--muted); font-weight:500; font-size:.8rem; margin-left:6px; }
        .topbar-right { display:flex; align-items:center; gap:12px; }
        .topbar-user { font-size:.83rem; color:var(--muted); }
        .topbar-user strong { color:var(--text); font-weight:700; }
        .btn-logout {
            background:rgba(239,68,68,.15); border:1px solid rgba(239,68,68,.35);
            color:#fca5a5; padding:7px 14px; border-radius:8px;
            font-size:.8rem; font-weight:700; text-decoration:none;
            display:flex; align-items:center; gap:6px; transition:all .2s;
        }
        .btn-logout:hover { background:rgba(239,68,68,.3); color:#fff; }
        .btn-portfolio {
            background:rgba(99,102,241,.15); border:1px solid rgba(99,102,241,.35);
            color:#a5b4fc; padding:7px 14px; border-radius:8px;
            font-size:.8rem; font-weight:700; text-decoration:none;
            display:flex; align-items:center; gap:6px; transition:all .2s;
        }
        .btn-portfolio:hover { background:var(--primary); color:#fff; }

        /* Layout */
        .admin-body { padding:32px 28px; max-width:1100px; margin:0 auto; }

        /* Welcome */
        .welcome-bar {
            background:linear-gradient(135deg,rgba(99,102,241,.18),rgba(56,189,248,.08));
            border:1px solid rgba(99,102,241,.3); border-radius:16px;
            padding:24px 28px; display:flex; align-items:center; gap:20px;
            margin-bottom:28px;
        }
        .welcome-avatar {
            width:56px; height:56px; border-radius:14px;
            background:linear-gradient(135deg,var(--primary),var(--accent));
            display:flex; align-items:center; justify-content:center;
            font-size:1.4rem; font-weight:800; flex-shrink:0;
        }
        .welcome-text h2 { font-size:1.25rem; font-weight:800; margin-bottom:4px; }
        .welcome-text p  { font-size:.83rem; color:var(--muted); }

        /* Stats grid */
        .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:16px; margin-bottom:28px; }
        .stat-card {
            background:var(--card); border:1px solid var(--border); border-radius:14px;
            padding:20px 22px; backdrop-filter:blur(12px); transition:border-color .2s;
        }
        .stat-card:hover { border-color:rgba(99,102,241,.4); }
        .stat-icon {
            width:40px; height:40px; border-radius:10px; display:flex;
            align-items:center; justify-content:center; margin-bottom:14px;
        }
        .stat-icon.purple { background:rgba(99,102,241,.18); color:var(--primary); border:1px solid rgba(99,102,241,.3); }
        .stat-icon.blue   { background:rgba(56,189,248,.15);  color:var(--accent);  border:1px solid rgba(56,189,248,.3); }
        .stat-icon.green  { background:rgba(16,185,129,.12);  color:#34d399;        border:1px solid rgba(16,185,129,.3); }
        .stat-value { font-size:1.7rem; font-weight:900; letter-spacing:-1px; }
        .stat-label { font-size:.78rem; color:var(--muted); font-weight:600; margin-top:4px; }

        /* Info blocks */
        .info-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
        .info-block {
            background:var(--card); border:1px solid var(--border); border-radius:14px;
            padding:22px; backdrop-filter:blur(12px);
        }
        .info-block h3 { font-size:.85rem; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-bottom:16px; }
        .info-row { display:flex; justify-content:space-between; align-items:center; padding:9px 0; border-bottom:1px solid rgba(255,255,255,.05); font-size:.85rem; }
        .info-row:last-child { border-bottom:none; }
        .info-row-label { color:var(--muted); font-weight:600; }
        .info-row-value { font-weight:700; font-family:'JetBrains Mono',monospace; font-size:.8rem; color:var(--text); }
        .badge-active { background:rgba(16,185,129,.15); border:1px solid rgba(16,185,129,.35); color:#34d399; padding:3px 10px; border-radius:999px; font-size:.72rem; font-weight:700; }

        @media(max-width:700px) { .info-grid { grid-template-columns:1fr; } .admin-body { padding:20px 16px; } }
    </style>
</head>
<body>

<!-- Topbar -->
<header class="topbar">
    <div class="topbar-brand">
        <div class="topbar-logo">JT</div>
        <div class="topbar-title">Dashboard <span>Admin Panel</span></div>
    </div>
    <div class="topbar-right">
        <span class="topbar-user">Signed in as <strong><?= $username ?></strong></span>
        <a href="/jevy/" class="btn-portfolio">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Portfolio
        </a>
        <a href="/jevy/logout.php" class="btn-logout">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Sign Out
        </a>
    </div>
</header>

<main class="admin-body">

    <!-- Welcome -->
    <div class="welcome-bar">
        <div class="welcome-avatar"><?= strtoupper(substr($full_name, 0, 1)) ?></div>
        <div class="welcome-text">
            <h2>Welcome back, <?= $full_name ?>! 👋</h2>
            <p>You are logged in as <strong><?= $username ?></strong> · Session started: <?= $login_time ?></p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </div>
            <div class="stat-value"><?= $user_count ?></div>
            <div class="stat-label">Registered Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                </svg>
            </div>
            <div class="stat-value">3</div>
            <div class="stat-label">Portfolio Projects</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div class="stat-value">Active</div>
            <div class="stat-label">Account Status</div>
        </div>
    </div>

    <!-- Info panels -->
    <div class="info-grid">
        <div class="info-block">
            <h3>Session Info</h3>
            <div class="info-row">
                <span class="info-row-label">Username</span>
                <span class="info-row-value"><?= $username ?></span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Login Time</span>
                <span class="info-row-value"><?= $login_time ?></span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Status</span>
                <span class="badge-active">● Online</span>
            </div>
        </div>

        <div class="info-block">
            <h3>Quick Links</h3>
            <div class="info-row">
                <span class="info-row-label">Portfolio Home</span>
                <a href="/jevy/" style="color:#a5b4fc;font-size:.82rem;font-weight:700;">View Site →</a>
            </div>
            <div class="info-row">
                <span class="info-row-label">All Users</span>
                <a href="/jevy/admin/users.php" style="color:#a5b4fc;font-size:.82rem;font-weight:700;">Manage →</a>
            </div>
            <div class="info-row">
                <span class="info-row-label">Sign Out</span>
                <a href="/jevy/logout.php" style="color:#fca5a5;font-size:.82rem;font-weight:700;">Logout →</a>
            </div>
        </div>
    </div>

</main>
</body>
</html>
