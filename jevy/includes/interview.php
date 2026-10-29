<?php
/**
 * Mock Interview Video Section Component
 * Showcases jevy.mp4 as a technical mock interview example
 * with a premium video player, speed control, chapter chips, and candidate metadata.
 */
?>
<!-- ============================================================
     Mock Interview Video Section
     ============================================================ -->
<section class="interview-section" id="interview" aria-labelledby="interview-heading">
    <div class="container">

        <!-- Section Header -->
        <div class="section-header interview-header text-center">
            <div class="section-tag-pill">
                <span class="pill-dot"></span>
                <span>Candidate Spotlight</span>
            </div>
            <h2 class="section-title" id="interview-heading">
                Technical <span class="gradient-text">Mock Interview</span> Video
            </h2>
            <p class="section-subtitle">
                Watch my technical walkthrough covering full-stack web architecture, MySQL relational modeling, and Arduino microcontroller prototyping.
            </p>
        </div>

        <!-- Video Showcase Card -->
        <div class="interview-showcase-card">

            <!-- macOS-style Window Topbar -->
            <div class="interview-window-topbar">
                <div class="window-traffic-lights">
                    <span class="traffic-light tl-red"></span>
                    <span class="traffic-light tl-yellow"></span>
                    <span class="traffic-light tl-green"></span>
                </div>
                <div class="interview-file-tag">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="23 7 16 12 23 17 23 7"></polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                    <span>jevy.mp4</span>
                </div>
                <div class="interview-live-badge">
                    <span class="rec-dot"></span>
                    <span>REC &bull; 1080p</span>
                </div>
            </div>

            <!-- Main Player Layout -->
            <div class="interview-player-layout">

                <!-- Video Player Column -->
                <div class="interview-player-col">
                    <div class="interview-video-wrapper" id="interviewVideoWrapper">
                        <video
                            id="jevy-interview-video"
                            class="interview-video-el"
                            controls
                            preload="metadata"
                            poster="assets/images/jevy-toledo.png"
                            playsinline>
                            <source src="jevy.mp4" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>

                        <!-- Play Overlay with Click Action -->
                        <div class="video-play-overlay" id="jevyVideoOverlay" onclick="jevyTogglePlay()">
                            <div class="play-overlay-inner">
                                <div class="play-circle-btn" aria-label="Play Interview Video">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                                        <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                    </svg>
                                </div>
                                <div class="play-overlay-meta">
                                    <span class="play-overlay-title">Technical Mock Interview</span>
                                    <span class="play-overlay-sub">Click to Watch &bull; Jevy B. Toledo</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Toolbar -->
                    <div class="interview-toolbar">
                        <div class="toolbar-group toolbar-left">
                            <button type="button" class="iv-ctrl-btn" onclick="jevyTogglePlay()" id="jevyPlayBtn" aria-label="Play or pause video">
                                <span id="jevyCtrlIcon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                        <polygon points="6 4 20 12 6 20 6 4"></polygon>
                                    </svg>
                                </span>
                                <span id="jevyCtrlLabel">Play</span>
                            </button>
                            <button type="button" class="iv-ctrl-btn" onclick="jevyRestartVideo()" title="Restart video from beginning">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="1 4 1 10 7 10"></polyline>
                                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                </svg>
                                <span>Restart</span>
                            </button>
                            <button type="button" class="iv-ctrl-btn" onclick="jevyToggleMute()" title="Mute or unmute audio">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                                </svg>
                                <span id="jevyMuteLabel">Mute</span>
                            </button>
                        </div>

                        <div class="toolbar-group toolbar-center">
                            <span class="speed-label-txt">Speed:</span>
                            <div class="speed-chips-row">
                                <button type="button" class="speed-chip" onclick="jevySetSpeed(0.75, this)">0.75x</button>
                                <button type="button" class="speed-chip active" onclick="jevySetSpeed(1, this)">1x</button>
                                <button type="button" class="speed-chip" onclick="jevySetSpeed(1.25, this)">1.25x</button>
                                <button type="button" class="speed-chip" onclick="jevySetSpeed(1.5, this)">1.5x</button>
                            </div>
                        </div>

                        <div class="toolbar-group toolbar-right">
                            <button type="button" class="iv-ctrl-btn" onclick="jevyFullscreen()" title="Toggle Fullscreen">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                                </svg>
                                <span>Fullscreen</span>
                            </button>
                        </div>
                    </div>

                    <!-- Chapter Chips Panel -->
                    <div class="chapter-chips-panel">
                        <div class="chapter-chips-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>Quick Jump Chapters:</span>
                        </div>
                        <div class="chapter-chips-row">
                            <button type="button" class="chapter-chip" onclick="jevySeek(0)">
                                <span class="chip-ts">0:00</span>
                                <span class="chip-name">Introduction</span>
                            </button>
                            <button type="button" class="chapter-chip" onclick="jevySeek(15)">
                                <span class="chip-ts">0:15</span>
                                <span class="chip-name">Technical Stack</span>
                            </button>
                            <button type="button" class="chapter-chip" onclick="jevySeek(35)">
                                <span class="chip-ts">0:35</span>
                                <span class="chip-name">TapSeafood Project</span>
                            </button>
                            <button type="button" class="chapter-chip" onclick="jevySeek(60)">
                                <span class="chip-ts">1:00</span>
                                <span class="chip-name">Arduino Dispenser</span>
                            </button>
                            <button type="button" class="chapter-chip" onclick="jevySeek(90)">
                                <span class="chip-ts">1:30</span>
                                <span class="chip-name">Q&amp;A &amp; Goals</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Candidate Meta Column -->
                <div class="interview-meta-col">
                    <!-- Candidate Spotlight Card -->
                    <div class="meta-card">
                        <div class="meta-card-title">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Candidate Spotlight</span>
                        </div>
                        <div class="candidate-card">
                            <div class="candidate-avatar-wrap">
                                <img src="assets/images/jevy-toledo.png" alt="<?= htmlspecialchars($portfolio['name']) ?>" class="candidate-avatar">
                                <span class="candidate-status-dot"></span>
                            </div>
                            <div>
                                <h4 class="candidate-name"><?= htmlspecialchars($portfolio['name']) ?></h4>
                                <p class="candidate-role"><?= htmlspecialchars($portfolio['role']) ?></p>
                                <span class="candidate-location">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span><?= htmlspecialchars($portfolio['location']) ?></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Badges Card -->
                    <div class="meta-card">
                        <div class="meta-card-title">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="16 18 22 12 16 6"></polyline>
                                <polyline points="8 6 2 12 8 18"></polyline>
                            </svg>
                            <span>Demonstrated Stack</span>
                        </div>
                        <div class="skill-badge-grid">
                            <span class="skill-badge-pill">PHP 8</span>
                            <span class="skill-badge-pill">MySQL</span>
                            <span class="skill-badge-pill">JavaScript ES6+</span>
                            <span class="skill-badge-pill">Arduino C++</span>
                            <span class="skill-badge-pill">HTML5 &amp; CSS3</span>
                            <span class="skill-badge-pill">Git / GitHub</span>
                        </div>
                    </div>

                    <!-- Interview Topics Covered -->
                    <div class="meta-card">
                        <div class="meta-card-title">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                            <span>Topics Covered</span>
                        </div>
                        <ul class="topics-list">
                            <li class="topic-item">
                                <span class="topic-dot"></span>
                                <span>Software architecture of TapSeafood e-commerce</span>
                            </li>
                            <li class="topic-item">
                                <span class="topic-dot"></span>
                                <span>Relational database design &amp; query structure</span>
                            </li>
                            <li class="topic-item">
                                <span class="topic-dot"></span>
                                <span>Hardware-software interfacing with ultrasonic sensors</span>
                            </li>
                            <li class="topic-item">
                                <span class="topic-dot"></span>
                                <span>Problem solving and eagerness to learn in junior roles</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Recruiter Quick CTA Card -->
                    <div class="meta-card recruiter-card">
                        <div class="meta-card-title">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                            <span>Ready to Hire?</span>
                        </div>
                        <p class="recruiter-desc">
                            Looking for a motivated junior developer who learns fast, communicates clearly, and takes ownership? Let's connect!
                        </p>
                        <div class="recruiter-btns">
                            <a href="#contact" class="btn btn-primary btn-sm">
                                <span>Schedule an Interview</span>
                            </a>
                            <button type="button" class="btn btn-outline btn-sm" onclick="openResumeViewer()">
                                <span>Quick Resume View</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div><!-- /.interview-player-layout -->
        </div><!-- /.interview-showcase-card -->

    </div><!-- /.container -->
</section>
