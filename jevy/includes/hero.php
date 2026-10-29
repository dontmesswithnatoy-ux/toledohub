<?php
/**
 * Hero Component
 * Welcoming introductory section showcasing the beginner developer profile,
 * dynamic greeting, CTA buttons, avatar with floating tech badges, and stats counter.
 */
?>
<section class="hero-section" id="hero">
    <!-- Ambient Background Glows -->
    <div class="ambient-glow glow-1" aria-hidden="true"></div>
    <div class="ambient-glow glow-2" aria-hidden="true"></div>

    <div class="container hero-container">
        <!-- Hero Text Content -->
        <div class="hero-content">
            <!-- Availability Status Badge -->
            <div class="status-badge" id="hero-status-badge">
                <span class="pulse-dot"></span>
                <span class="status-text"><?= htmlspecialchars($portfolio['status']) ?></span>
            </div>

            <!-- Main Heading with Dynamic Greeting -->
            <div class="hero-heading-group">
                <p class="hero-greeting" id="hero-greeting">
                    <span class="wave-emoji" aria-hidden="true">👋</span>
                    <span class="greeting-text"><?= getGreeting() ?>, I'm</span>
                </p>
                <h1 class="hero-title">
                    <span class="text-gradient"><?= htmlspecialchars($portfolio['name']) ?></span>,
                    <span class="hero-role-block"><?= htmlspecialchars($portfolio['role']) ?></span>
                </h1>
            </div>

            <!-- Engaging Junior Bio -->
            <p class="hero-description">
                <?= htmlspecialchars($portfolio['headline']) ?>
            </p>
            <p class="hero-subtext">
                Passionate about semantic markup, intuitive UI design, and server-side PHP fundamentals. Eager to bring fresh energy, strong work ethic, and rapid learning to an engineering team.
            </p>

            <!-- Action Buttons -->
            <div class="hero-actions">
                <a href="#projects" class="btn btn-primary" id="hero-projects-btn">
                    <span>View My Projects</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <polyline points="19 12 12 19 5 12"></polyline>
                    </svg>
                </a>
                <a href="#contact" class="btn btn-secondary" id="hero-contact-btn">
                    <span>Let's Talk</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </a>
                <a href="#about" class="btn btn-ghost" id="hero-about-link">
                    <span>My Story</span>
                </a>
                <a href="#interview" class="btn btn-interview" id="hero-interview-btn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                        <polygon points="6 4 20 12 6 20 6 4"></polygon>
                    </svg>
                    <span>Watch Interview</span>
                </a>
            </div>

            <!-- Quick Social / Links -->
            <div class="hero-social-strip">
                <span class="social-label">Connect:</span>
                <div class="social-links-row">
                    <a href="<?= htmlspecialchars($portfolio['github']) ?>" target="_blank" rel="noopener noreferrer" class="social-chip" title="GitHub Profile">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                        <span>GitHub</span>
                    </a>
                    <a href="<?= htmlspecialchars($portfolio['linkedin']) ?>" target="_blank" rel="noopener noreferrer" class="social-chip" title="LinkedIn Profile">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                        <span>LinkedIn</span>
                    </a>
                    <span class="social-chip location-chip">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span><?= htmlspecialchars($portfolio['location']) ?></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Hero Visual Showcase -->
        <div class="hero-visual">
            <div class="avatar-card-wrapper">
                <!-- Floating Tech Badge 1 (PHP) -->
                <div class="floating-badge badge-php" title="PHP 8 Backend">
                    <span class="badge-icon">🐘</span>
                    <span class="badge-text">PHP 8</span>
                </div>

                <!-- Floating Tech Badge 2 (JavaScript) -->
                <div class="floating-badge badge-js" title="JavaScript ES6+">
                    <span class="badge-icon">⚡</span>
                    <span class="badge-text">JavaScript</span>
                </div>

                <!-- Floating Tech Badge 3 (CSS3 / UI) -->
                <div class="floating-badge badge-css" title="Responsive CSS3">
                    <span class="badge-icon">🎨</span>
                    <span class="badge-text">Modern CSS</span>
                </div>

                <!-- Floating Tech Badge 4 (Git) -->
                <div class="floating-badge badge-git" title="Git Version Control">
                    <span class="badge-icon">🌿</span>
                    <span class="badge-text">Git</span>
                </div>

                <!-- Main Avatar Card -->
                <div class="avatar-card">
                    <div class="avatar-image-frame">
                        <img src="<?= htmlspecialchars($portfolio['avatar'] ?? 'assets/images/avatar.jpg') ?>" alt="Portrait of <?= htmlspecialchars($portfolio['name']) ?>" class="avatar-img" width="400" height="400" loading="eager">
                        <div class="avatar-overlay-gradient"></div>
                    </div>
                    
                    <!-- Bottom Info Banner on Card -->
                    <div class="avatar-card-caption">
                        <div class="caption-identity">
                            <span class="caption-name"><?= htmlspecialchars($portfolio['name']) ?></span>
                            <span class="caption-role">Junior Developer</span>
                        </div>
                        <div class="caption-tag">
                            <span class="pulse-dot-sm"></span>
                            <span>Ready to build</span>
                        </div>
                    </div>
                </div>

                <!-- Behind Aura Border -->
                <div class="avatar-aura-ring" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="container hero-stats-container">
        <div class="stats-grid">
            <?php foreach ($portfolio['stats'] as $index => $stat): ?>
                <div class="stat-card" id="stat-card-<?= $index ?>">
                    <div class="stat-number text-gradient"><?= htmlspecialchars($stat['number']) ?></div>
                    <div class="stat-label"><?= htmlspecialchars($stat['label']) ?></div>
                    <div class="stat-detail"><?= htmlspecialchars($stat['detail']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
