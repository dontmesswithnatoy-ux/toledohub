<?php
/**
 * Skills Component
 * Interactive, categorized tech stack showcase displaying proficiency levels,
 * descriptive application notes, and visual progress meters.
 */
?>
<section class="section skills-section" id="skills">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <span class="section-badge">Technical Repertoire</span>
            <h2 class="section-title">Skills & Tooling</h2>
            <p class="section-subtitle">
                My hands-on technical competencies, built through practical projects and dedicated practice.
            </p>
        </div>

        <!-- Skills Categories Grid -->
        <div class="skills-categories-grid">
            <?php foreach ($portfolio['skills_categories'] as $catIndex => $category): ?>
                <div class="skills-category-card" id="skill-cat-<?= $catIndex ?>">
                    <div class="category-header">
                        <div class="category-indicator"></div>
                        <div>
                            <h3 class="category-title"><?= htmlspecialchars($category['category_name']) ?></h3>
                            <p class="category-desc"><?= htmlspecialchars($category['description']) ?></p>
                        </div>
                    </div>

                    <div class="skills-list">
                        <?php foreach ($category['skills'] as $skillIndex => $skill): ?>
                            <div class="skill-item" data-percent="<?= (int)$skill['percent'] ?>">
                                <div class="skill-info">
                                    <span class="skill-name"><?= htmlspecialchars($skill['name']) ?></span>
                                    <span class="skill-level-badge badge-<?= strtolower(explode('+', explode(' ', $skill['level'])[0])[0]) ?>">
                                        <?= htmlspecialchars($skill['level']) ?>
                                    </span>
                                </div>

                                <div class="skill-bar-track" role="progressbar" aria-valuenow="<?= (int)$skill['percent'] ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= htmlspecialchars($skill['name']) ?> proficiency">
                                    <div class="skill-bar-fill" style="width: <?= (int)$skill['percent'] ?>%;"></div>
                                </div>

                                <p class="skill-note"><?= htmlspecialchars($skill['note']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Interactive Tech Pill Cloud -->
        <div class="tech-pills-container">
            <h4 class="pills-title">Quick Stack Snapshot</h4>
            <div class="pills-cloud">
                <span class="tech-tag tag-primary">HTML5</span>
                <span class="tech-tag tag-primary">CSS3 Flex & Grid</span>
                <span class="tech-tag tag-secondary">JavaScript (ES6+)</span>
                <span class="tech-tag tag-accent">PHP 8.2</span>
                <span class="tech-tag tag-accent">MySQL & phpMyAdmin</span>
                <span class="tech-tag tag-secondary">Fetch API & JSON</span>
                <span class="tech-tag tag-neutral">Git & GitHub</span>
                <span class="tech-tag tag-neutral">XAMPP / Apache</span>
                <span class="tech-tag tag-neutral">VS Code</span>
                <span class="tech-tag tag-neutral">Chrome DevTools</span>
                <span class="tech-tag tag-neutral">Responsive Mobile-First</span>
                <span class="tech-tag tag-neutral">SEO & Accessibility</span>
            </div>
        </div>
    </div>
</section>
