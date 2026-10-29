<?php
/**
 * Header Component
 * Includes SEO best practices, modern Google Fonts, meta tags, and theme initialization.
 */
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Optimization -->
    <title><?= htmlspecialchars($portfolio['name']) ?> | <?= htmlspecialchars($portfolio['role']) ?> Portfolio</title>
    <meta name="description" content="<?= htmlspecialchars($portfolio['headline']) ?> Explore junior web developer projects, skills in HTML, CSS, JavaScript, and PHP.">
    <meta name="keywords" content="web developer portfolio, junior developer, frontend developer, PHP beginner portfolio, JavaScript projects, HTML CSS portfolio, <?= htmlspecialchars($portfolio['name']) ?>">
    <meta name="author" content="<?= htmlspecialchars($portfolio['name']) ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Social Sharing -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= htmlspecialchars($portfolio['name']) ?> | <?= htmlspecialchars($portfolio['role']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($portfolio['headline']) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($portfolio['avatar'] ?? 'assets/images/avatar.jpg') ?>">
    
    <!-- Favicon (SVG data URI for immediate, zero-asset rendering) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💻</text></svg>">
    
    <!-- Typography: Google Fonts (Plus Jakarta Sans & JetBrains Mono) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Anti-FOUC Theme Script (executes immediately) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('portfolio_theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                document.documentElement.setAttribute('data-theme', 'light');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
</head>
<body>
<a href="#main-content" class="skip-link">Skip to main content</a>
