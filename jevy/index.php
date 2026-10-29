<?php
/**
 * Modern Junior Web Developer Portfolio
 * Built with modular PHP 8 architecture, semantic HTML5, Vanilla CSS, and JavaScript.
 */

// Start session for flash messaging and CSRF/state
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load portfolio data configuration
require_once __DIR__ . '/data/portfolio_data.php';

// Assemble Modular Layout
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/includes/hero.php';
?>

<main id="main-content">
    <?php require_once __DIR__ . '/includes/about.php'; ?>
    <?php require_once __DIR__ . '/includes/resume.php'; ?>
    <?php require_once __DIR__ . '/includes/skills.php'; ?>
    <?php require_once __DIR__ . '/includes/projects.php'; ?>
    <?php require_once __DIR__ . '/includes/journey.php'; ?>
    <?php require_once __DIR__ . '/includes/interview.php'; ?>
    <?php require_once __DIR__ . '/includes/contact.php'; ?>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
