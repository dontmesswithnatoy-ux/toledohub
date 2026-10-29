<?php
/**
 * Journey Component
 * Displays the beginner milestone timeline, mentor quotes, and junior developer value proposition.
 */
?>
<section class="section journey-section" id="journey">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <span class="section-badge">Roadmap & Growth</span>
            <h2 class="section-title">My Learning Journey</h2>
            <p class="section-subtitle">
                A timeline of consistent milestones, dedicated hours, and continuous technical evolution.
            </p>
        </div>

        <!-- Timeline Grid -->
        <div class="timeline-container">
            <div class="timeline-track" aria-hidden="true"></div>

            <div class="timeline-nodes">
                <?php foreach ($portfolio['timeline'] as $index => $node): ?>
                    <div class="timeline-node <?= $index % 2 === 0 ? 'node-left' : 'node-right' ?>" id="journey-node-<?= $index ?>">
                        <!-- Center Indicator Dot -->
                        <div class="timeline-dot">
                            <span class="dot-inner"></span>
                        </div>

                        <!-- Content Card -->
                        <div class="timeline-card">
                            <div class="timeline-card-header">
                                <span class="timeline-period"><?= htmlspecialchars($node['period']) ?></span>
                                <span class="timeline-badge <?= $node['badge'] === 'In Progress' ? 'badge-current' : 'badge-done' ?>">
                                    <?= htmlspecialchars($node['badge']) ?>
                                </span>
                            </div>
                            <h3 class="timeline-title"><?= htmlspecialchars($node['title']) ?></h3>
                            <span class="timeline-date"><?= htmlspecialchars($node['date']) ?></span>
                            <p class="timeline-description"><?= htmlspecialchars($node['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Junior Developer Value Proposition Box -->
        <div class="junior-value-box">
            <div class="value-box-content">
                <div class="value-box-badge">Why Hire a Junior Developer?</div>
                <h3 class="value-box-title">Energy, Adaptability & Hunger to Grow</h3>
                <p class="value-box-text">
                    I bring untainted curiosity, modern standard practices, and zero reluctance to ask questions, read technical specs, and jump right into debugging. I'm looking for a team where I can solve real user problems and continuously level up.
                </p>
                <div class="value-box-perks">
                    <div class="perk-item">
                        <span class="perk-icon">⚡</span>
                        <span>Rapid ramp-up on team workflows & codebases</span>
                    </div>
                    <div class="perk-item">
                        <span class="perk-icon">🔍</span>
                        <span>Meticulous attention to edge cases & responsive UI</span>
                    </div>
                    <div class="perk-item">
                        <span class="perk-icon">🌱</span>
                        <span>Open to constructive code reviews & coaching</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials / Mentor Feedback -->
        <div class="testimonials-container">
            <h3 class="testimonials-title text-center">Mentor & Peer Endorsements</h3>
            <div class="testimonials-grid">
                <?php foreach ($portfolio['testimonials'] as $testimonial): ?>
                    <div class="testimonial-card">
                        <div class="quote-mark" aria-hidden="true">“</div>
                        <p class="testimonial-quote"><?= htmlspecialchars($testimonial['quote']) ?></p>
                        <div class="testimonial-author">
                            <div class="author-avatar-placeholder">
                                <?= substr($testimonial['author'], 0, 1) ?>
                            </div>
                            <div>
                                <h4 class="author-name"><?= htmlspecialchars($testimonial['author']) ?></h4>
                                <p class="author-role"><?= htmlspecialchars($testimonial['role']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
