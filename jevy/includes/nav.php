<?php
/**
 * Navigation Component
 * Responsive header navbar with theme toggle and mobile navigation drawer.
 */
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../auth/db.php';
?>
?>
<header class="site-header" id="site-header">
    <div class="container header-container">
        <!-- Brand Logo -->
        <a href="#hero" class="brand-logo" id="brand-logo" aria-label="<?= htmlspecialchars($portfolio['name']) ?> Home">
            <span class="logo-badge">&lt;/&gt;</span>
            <span class="logo-text">
                <span class="logo-name"><?= htmlspecialchars($portfolio['name']) ?></span>
                <span class="logo-role"><?= htmlspecialchars($portfolio['role']) ?></span>
            </span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Main Navigation">
            <ul class="nav-links">
                <li><a href="#about" class="nav-link" id="nav-about">About</a></li>
                <li><a href="#skills" class="nav-link" id="nav-skills">Skills</a></li>
                <li><a href="#projects" class="nav-link" id="nav-projects">Projects</a></li>
                <li><a href="#journey" class="nav-link" id="nav-journey">Journey</a></li>
                <li><a href="#interview" class="nav-link" id="nav-interview">Interview</a></li>
                <li><a href="#contact" class="nav-link" id="nav-contact">Contact</a></li>
            </ul>
        </nav>

        <!-- Header Actions: Theme Toggle & CTA -->
        <div class="header-actions">
            <!-- Theme Toggle Button -->
            <button type="button" class="theme-toggle-btn" id="theme-toggle" aria-label="Toggle dark/light theme" title="Switch color theme">
                <span class="theme-icon sun-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </span>
                <span class="theme-icon moon-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </span>
            </button>

            <!-- Quick Action CTA -->
            <?php if (isLoggedIn()): ?>
                <a href="/jevy/admin/index.php" class="btn btn-sm btn-primary-glow header-cta" id="header-dashboard-btn" style="background:rgba(16,185,129,.2);border-color:rgba(16,185,129,.5);box-shadow:0 4px 14px rgba(16,185,129,.25);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="/jevy/logout.php" id="header-logout-btn" style="
                    display:inline-flex;align-items:center;gap:5px;
                    background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.35);
                    color:#fca5a5;padding:7px 12px;border-radius:8px;
                    font-size:.8rem;font-weight:700;text-decoration:none;transition:all .2s;
                " onmouseover="this.style.background='rgba(239,68,68,.3)'" onmouseout="this.style.background='rgba(239,68,68,.15)'">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Out
                </a>
            <?php else: ?>
                <a href="/jevy/login.php" class="btn btn-sm" id="header-login-btn" style="
                    background:rgba(99,102,241,.15);border:1px solid rgba(99,102,241,.4);
                    color:#a5b4fc;padding:7px 14px;border-radius:8px;
                    font-size:.8rem;font-weight:700;text-decoration:none;
                    display:inline-flex;align-items:center;gap:6px;transition:all .2s;
                " onmouseover="this.style.background='rgba(99,102,241,.3)'" onmouseout="this.style.background='rgba(99,102,241,.15)'">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    Login
                </a>
                <a href="#contact" class="btn btn-sm btn-primary-glow header-cta" id="header-hire-btn">
                    <span>Kunin niyo na ako Please!</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            <?php endif; ?>

            <!-- Mobile Hamburger Toggle -->
            <button type="button" class="mobile-nav-toggle" id="mobile-nav-toggle" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobile-nav-drawer">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div class="mobile-nav-drawer" id="mobile-nav-drawer" aria-hidden="true">
        <ul class="mobile-nav-links">
            <li><a href="#about" class="mobile-nav-link">About Me</a></li>
            <li><a href="#skills" class="mobile-nav-link">Skills & Stack</a></li>
            <li><a href="#projects" class="mobile-nav-link">Featured Projects</a></li>
            <li><a href="#journey" class="mobile-nav-link">My Journey</a></li>
            <li><a href="#interview" class="mobile-nav-link">Mock Interview</a></li>
            <li><a href="#contact" class="mobile-nav-link">Get In Touch</a></li>
        </ul>
        <div class="mobile-drawer-footer">
            <span class="drawer-status-pill">
                <span class="pulse-dot"></span>
                <?= htmlspecialchars($portfolio['status']) ?>
            </span>
        </div>
    </div>
</header>
