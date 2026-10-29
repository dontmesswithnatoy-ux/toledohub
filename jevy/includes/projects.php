<?php
/**
 * Projects Component
 * Interactive portfolio project showcase customized with your real projects:
 * 1. TapSeafood: Online Food Ordering Website
 * 2. Hotel Online Booking
 * 3. Arduino Water Dispenser
 */
?>
<section class="section projects-section" id="projects">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <span class="section-badge">Core Creations</span>
            <h2 class="section-title">Featured Projects</h2>
            <p class="section-subtitle">
                Real-world full-stack web applications and an automated IoT hardware prototype built with clean code and practical problem solving.
            </p>
        </div>

        <!-- Filter Buttons -->
        <div class="project-filters" role="tablist" aria-label="Project filter categories">
            <button type="button" class="filter-btn active" data-filter="all" role="tab" aria-selected="true" id="filter-all">
                All Projects <span class="filter-count">(<?= count($portfolio['projects']) ?>)</span>
            </button>
            <button type="button" class="filter-btn" data-filter="php" role="tab" aria-selected="false" id="filter-php">
                PHP &amp; MySQL Web
            </button>
            <button type="button" class="filter-btn" data-filter="hardware" role="tab" aria-selected="false" id="filter-hardware">
                Arduino &amp; IoT Hardware
            </button>
        </div>

        <!-- Projects Grid -->
        <div class="projects-grid" id="projects-grid">
            <?php foreach ($portfolio['projects'] as $index => $project): ?>
                <article class="project-card" data-category="<?= htmlspecialchars($project['category']) ?>" id="project-<?= htmlspecialchars($project['id']) ?>">
                    <!-- Card Thumbnail Image -->
                    <div class="project-media">
                        <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?> mockup" class="project-img" width="600" height="338" loading="lazy">
                        <div class="project-media-overlay">
                            <a href="<?= htmlspecialchars($project['demo']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary project-quick-demo-btn">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                                <span>Launch Live Demo</span>
                            </a>
                            <button type="button" class="btn btn-sm btn-light open-modal-btn" data-project-id="<?= htmlspecialchars($project['id']) ?>">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <span>Tech Specs</span>
                            </button>
                        </div>
                        <span class="category-pill"><?= htmlspecialchars($project['category_label']) ?></span>
                        <span class="live-status-pill">
                            <span class="pulse-dot-sm"></span> Live Demo
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="project-body">
                        <h3 class="project-title"><?= htmlspecialchars($project['title']) ?></h3>
                        <p class="project-summary"><?= htmlspecialchars($project['summary']) ?></p>

                        <!-- Highlights List -->
                        <ul class="project-highlights">
                            <?php foreach (array_slice($project['highlights'], 0, 2) as $highlight): ?>
                                <li>
                                    <span class="bullet-dot" aria-hidden="true">▸</span>
                                    <span><?= htmlspecialchars($highlight) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Tech Tags -->
                        <div class="project-tags">
                            <?php foreach ($project['tags'] as $tag): ?>
                                <span class="tag-chip"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="project-card-footer">
                            <a href="<?= htmlspecialchars($project['demo']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm project-btn-demo">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                                <span>Live Demo</span>
                            </a>

                            <button type="button" class="btn btn-outline btn-sm open-modal-btn" data-project-id="<?= htmlspecialchars($project['id']) ?>" title="View Technical Architecture & Features">
                                <span>Specs</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>

                            <a href="<?= htmlspecialchars($project['github']) ?>" target="_blank" rel="noopener noreferrer" class="btn-icon" title="View Source on GitHub" aria-label="View source code on GitHub">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
