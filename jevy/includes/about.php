<?php
/**
 * About Component
 * Highlights the beginner developer's story, learning philosophy, key principles,
 * and current technical explorations.
 */
?>
<section class="section about-section" id="about">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <span class="section-badge">Get to Know Me</span>
            <h2 class="section-title">From Curiosity to Code</h2>
            <p class="section-subtitle">
                How I transitioned into web development and what drives my work every day.
            </p>
        </div>

        <div class="about-grid">
            <!-- Narrative Column -->
            <div class="about-narrative">
                <div class="narrative-card">
                    <h3 class="narrative-title">
                        <span class="highlight-bracket">&lt;</span>
                        My Story &amp; Passion
                        <span class="highlight-bracket">/&gt;</span>
                    </h3>
                    <p class="narrative-p">
                        <?= htmlspecialchars($portfolio['short_bio']) ?>
                    </p>
                    <p class="narrative-p">
                        I began my development journey with basic static HTML pages and quickly fell in love with solving logic puzzles through Vanilla JavaScript. Wanting to understand how full-stack websites function under the hood, I embraced <strong>PHP 8</strong> and relational databases, finding joy in building forms, handling sessions, and structuring modular code.
                    </p>
                    <p class="narrative-p">
                        As an entry-level developer, what I lack in decades of experience I make up for with high curiosity, obsessive attention to responsive detail, solid documentation habits, and a strong eagerness to absorb mentorship and contribute to a team from day one.
                    </p>

                    <!-- Currently Learning Box -->
                    <div class="learning-box">
                        <div class="learning-header">
                            <span class="learning-icon">🚀</span>
                            <h4 class="learning-title">What I'm Learning Right Now</h4>
                        </div>
                        <ul class="learning-list">
                            <?php foreach ($portfolio['learning_now'] as $topic): ?>
                                <li class="learning-item">
                                    <span class="check-icon" aria-hidden="true">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                    <span><?= htmlspecialchars($topic) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="about-cta-row">
                        <a href="#contact" class="btn btn-primary btn-sm">
                            <span>Discuss an Opportunity</span>
                        </a>
                        <button
                            type="button"
                            class="btn btn-outline btn-sm"
                            id="view-resume-btn"
                            onclick="openResumeViewer()"
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span>Quick Resume View</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Value Principles Column -->
            <div class="about-values">
                <div class="values-grid">
                    <?php foreach ($portfolio['about_highlights'] as $highlight): ?>
                        <div class="value-card">
                            <div class="value-icon-box">
                                <?php if ($highlight['icon'] === 'code'): ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="16 18 22 12 16 6"></polyline>
                                        <polyline points="8 6 2 12 8 18"></polyline>
                                    </svg>
                                <?php elseif ($highlight['icon'] === 'devices'): ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                        <line x1="8" y1="21" x2="16" y2="21"></line>
                                        <line x1="12" y1="17" x2="12" y2="21"></line>
                                    </svg>
                                <?php elseif ($highlight['icon'] === 'database'): ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                    </svg>
                                <?php else: ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                                        <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                                        <path d="M12 9v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <h4 class="value-title"><?= htmlspecialchars($highlight['title']) ?></h4>
                            <p class="value-text"><?= htmlspecialchars($highlight['text']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div><!-- /.about-grid -->
    </div><!-- /.container -->
</section>

<!-- =============================================
     RESUME LIGHTBOX — outside section, fixed overlay
     ============================================= -->
<div id="resume-lightbox" onclick="if(event.target===this)closeResumeViewer()">
    <div class="resume-lb-inner">
        <button class="resume-lb-close" onclick="closeResumeViewer()" aria-label="Close">&times;</button>
        <img
            src="assets/images/jevy-resume.png"
            alt="Official Résumé of <?= htmlspecialchars($portfolio['name']) ?>"
            class="resume-lb-img"
        >
        <div class="resume-lb-footer">
            <button onclick="window.print()" class="resume-lb-print-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="6 9 6 2 18 2 18 9"/>
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8"/>
                </svg>
                Print / Save as PDF
            </button>
        </div>
    </div>
</div>

<style>
/* Lightbox base — hidden */
#resume-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0, 0, 0, 0.88);
    backdrop-filter: blur(8px);
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: lbFadeIn 0.25s ease;
}
/* Lightbox shown */
#resume-lightbox.open {
    display: flex;
}
@keyframes lbFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}
.resume-lb-inner {
    position: relative;
    max-width: 520px;
    width: 100%;
    animation: lbSlideUp 0.28s ease;
}
@keyframes lbSlideUp {
    from { transform: translateY(30px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}
.resume-lb-close {
    position: absolute;
    top: -14px;
    right: -14px;
    z-index: 2;
    background: #ef4444;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    font-size: 1.3rem;
    font-weight: 800;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.5);
    transition: background 0.2s, transform 0.15s;
}
.resume-lb-close:hover {
    background: #dc2626;
    transform: scale(1.1);
}
.resume-lb-img {
    width: 100%;
    display: block;
    border-radius: 12px;
    box-shadow: 0 24px 60px rgba(0,0,0,0.7);
}
.resume-lb-footer {
    text-align: center;
    margin-top: 14px;
}
.resume-lb-print-btn {
    background: #6366f1;
    color: #fff;
    border: none;
    padding: 10px 22px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s, transform 0.15s;
    box-shadow: 0 4px 14px rgba(99,102,241,0.4);
}
.resume-lb-print-btn:hover {
    background: #4f46e5;
    transform: translateY(-1px);
}
</style>

<script>
function openResumeViewer() {
    document.getElementById('resume-lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeResumeViewer() {
    document.getElementById('resume-lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeResumeViewer();
});
</script>
