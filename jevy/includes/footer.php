<?php
/**
 * Footer Component
 * Includes project details modal markup, toast notifications,
 * attribution, smooth back-to-top, and JavaScript script inclusions.
 */
?>
<footer class="site-footer">
    <div class="container footer-container">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="#hero" class="brand-logo footer-logo">
                    <span class="logo-badge">&lt;/&gt;</span>
                    <span class="logo-text">
                        <span class="logo-name"><?= htmlspecialchars($portfolio['name']) ?></span>
                        <span class="logo-role"><?= htmlspecialchars($portfolio['role']) ?></span>
                    </span>
                </a>
                <p class="footer-tagline">
                    An enthusiastic entry-level developer committed to writing clean code and learning every single day.
                </p>
                <div class="footer-status-tag">
                    <span class="pulse-dot-sm"></span>
                    <span><?= htmlspecialchars($portfolio['status']) ?></span>
                </div>
            </div>

            <div class="footer-nav-col">
                <h4 class="footer-col-title">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="#about">About My Path</a></li>
                    <li><a href="#skills">Skills & Stack</a></li>
                    <li><a href="#projects">Portfolio Projects</a></li>
                    <li><a href="#journey">Learning Timeline</a></li>
                    <li><a href="#interview">Mock Interview</a></li>
                    <li><a href="#contact">Get In Touch</a></li>
                </ul>
            </div>

            <div class="footer-projects-col">
                <h4 class="footer-col-title">Featured Work</h4>
                <ul class="footer-links">
                    <?php foreach ($portfolio['projects'] as $p): ?>
                        <li><a href="#project-<?= htmlspecialchars($p['id']) ?>"><?= htmlspecialchars(explode('—', $p['title'])[0]) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-tech-col">
                <h4 class="footer-col-title">Tech Behind This Site</h4>
                <p class="footer-tech-desc">
                    Built natively with semantic HTML5, pure CSS3 design system, JavaScript interactivity, and modular PHP 8.2 with form processing.
                </p>
                <div class="badge-strip">
                    <span class="tech-badge">HTML5</span>
                    <span class="tech-badge">CSS3</span>
                    <span class="tech-badge">JavaScript</span>
                    <span class="tech-badge">PHP 8</span>
                    <span class="tech-badge">Apache</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright-text">
                &copy; <?= date('Y') ?> <?= htmlspecialchars($portfolio['name']) ?>. Built with passion & clean PHP.
            </p>
            <div class="footer-actions">
                <button type="button" class="back-to-top-btn" id="back-to-top" aria-label="Scroll back to top">
                    <span>Back to Top</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</footer>

<!-- Interactive Project Inspection Modal -->
<div class="modal-backdrop" id="project-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modal-project-title">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="modal-close-btn" id="modal-close" aria-label="Close dialog">&times;</button>
            
            <div class="modal-header">
                <span class="modal-category" id="modal-project-category">Vanilla JavaScript</span>
                <h3 class="modal-title" id="modal-project-title">Project Title</h3>
            </div>

            <div class="modal-body">
                <div class="modal-media-frame">
                    <img src="" alt="" id="modal-project-img" class="modal-img">
                </div>

                <div class="modal-details-grid">
                    <div class="modal-overview">
                        <h4 class="modal-heading">Overview & Purpose</h4>
                        <p id="modal-project-desc" class="modal-text"></p>

                        <h4 class="modal-heading">Key Technical Highlights</h4>
                        <ul id="modal-project-highlights" class="modal-bullet-list"></ul>
                    </div>

                    <div class="modal-sidebar">
                        <h4 class="modal-heading">Technologies Used</h4>
                        <div id="modal-project-tags" class="modal-tags-box"></div>

                        <div class="modal-action-box">
                            <a href="#" target="_blank" rel="noopener noreferrer" id="modal-demo-btn" class="btn btn-primary btn-block">
                                <span>Try Interactive Preview</span>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" id="modal-github-btn" class="btn btn-outline btn-block">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                                <span>Inspect Source Code</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Global Toast Notification Container -->
<div class="toast-notification" id="toast-notification" role="status" aria-live="polite">
    <span class="toast-icon" id="toast-icon">✓</span>
    <span class="toast-message" id="toast-message">Message text</span>
</div>

<!-- Embedded JSON Data for Instant Client Interaction -->
<script>
    window.portfolioData = {
        projects: <?= json_encode($portfolio['projects'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
    };
</script>

<!-- Main JavaScript Logic -->
<script src="assets/js/main.js"></script>
</body>
</html>
