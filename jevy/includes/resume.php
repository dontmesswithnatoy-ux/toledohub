<?php
/**
 * Resume Section Component
 * Displays Jevy B. Toledo's official resume information
 * sourced directly from the uploaded resume document.
 */
?>
<section class="section resume-section" id="resume">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <span class="section-badge">Official CV</span>
            <h2 class="section-title">My Résumé</h2>
            <p class="section-subtitle">
                A complete overview of my personal background, educational attainment, and career objective.
            </p>
        </div>

        <div class="resume-layout">
            <!-- Left Column: Photo + Personal Info + Actions -->
            <div class="resume-sidebar">

                <!-- Profile Photo Card -->
                <div class="resume-photo-card">
                    <div class="resume-photo-wrapper">
                        <img
                            src="<?= htmlspecialchars($portfolio['avatar']) ?>"
                            alt="Official ID Photo of <?= htmlspecialchars($portfolio['name']) ?>"
                            class="resume-photo-img"
                        >
                        <div class="resume-photo-glow"></div>
                    </div>
                    <h3 class="resume-name"><?= htmlspecialchars($portfolio['personal_info']['full_name'] ?? $portfolio['name']) ?></h3>
                    <p class="resume-role-label"><?= htmlspecialchars($portfolio['role']) ?></p>
                    <div class="resume-availability-pill">
                        <span class="pulse-dot-sm"></span>
                        <span><?= htmlspecialchars($portfolio['status']) ?></span>
                    </div>
                </div>

                <!-- Contact Quick Block -->
                <div class="resume-contact-block">
                    <h4 class="block-title">Contact Details</h4>
                    <ul class="contact-list-plain">
                        <li>
                            <span class="contact-icon-box">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 015.19 12.9 19.79 19.79 0 012.12 4.27 2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91A16 16 0 0014 15.91l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                                </svg>
                            </span>
                            <div>
                                <span class="cl-label">Mobile</span>
                                <span class="cl-value"><?= htmlspecialchars($portfolio['phone']) ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="contact-icon-box">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </span>
                            <div>
                                <span class="cl-label">Email</span>
                                <a href="mailto:<?= htmlspecialchars($portfolio['email']) ?>" class="cl-value cl-link"><?= htmlspecialchars($portfolio['email']) ?></a>
                            </div>
                        </li>
                        <li>
                            <span class="contact-icon-box">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
                                </svg>
                            </span>
                            <div>
                                <span class="cl-label">Address</span>
                                <span class="cl-value"><?= htmlspecialchars($portfolio['personal_info']['address'] ?? $portfolio['location']) ?></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Download / Print Resume Buttons -->
                <div class="resume-actions-col">
                    <button type="button" class="btn btn-primary btn-sm" onclick="window.print()" id="print-resume-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/>
                        </svg>
                        <span>Print Résumé</span>
                    </button>
                    <a href="#contact" class="btn btn-outline btn-sm" id="contact-for-resume-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                        </svg>
                        <span>Request Full CV</span>
                    </a>
                </div>
            </div>

            <!-- Right Column: Full Resume Content -->
            <div class="resume-main-col">

                <!-- Objective -->
                <div class="resume-block">
                    <div class="resume-block-header">
                        <span class="block-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </span>
                        <h3 class="block-title-text">Career Objective</h3>
                    </div>
                    <div class="resume-block-body">
                        <p class="resume-objective-text">
                            <?= htmlspecialchars($portfolio['objective'] ?? 'Seeking a job in your establishment to enhance my skills. Hardworking student seek an opportunity to communicate a lot of customers.') ?>
                        </p>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="resume-block">
                    <div class="resume-block-header">
                        <span class="block-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <h3 class="block-title-text">Personal Information</h3>
                    </div>
                    <div class="resume-block-body">
                        <?php
                        $pi = $portfolio['personal_info'] ?? [];
                        $personalRows = [
                            ['label' => 'Nickname',       'value' => $pi['nickname']    ?? 'Jevy'],
                            ['label' => 'Age',            'value' => $pi['age']         ?? '19 yrs old'],
                            ['label' => 'Birthdate',      'value' => $pi['birthdate']   ?? 'August 25, 2003'],
                            ['label' => 'Place of Birth', 'value' => $pi['birthplace']  ?? 'Talibon, Bohol'],
                            ['label' => 'Gender',         'value' => $pi['gender']      ?? 'Male'],
                            ['label' => 'Civil Status',   'value' => $pi['civil_status']?? 'Single'],
                            ['label' => 'Religion',       'value' => $pi['religion']    ?? 'Catholic'],
                            ['label' => 'Weight',         'value' => $pi['weight']      ?? '65 kg'],
                            ['label' => 'Height',         'value' => $pi['height']      ?? "5'7\""],
                            ['label' => 'Dialect Spoken', 'value' => $pi['dialects']    ?? 'English, Bisaya and Tagalog'],
                        ];
                        ?>
                        <div class="personal-info-grid">
                            <?php foreach ($personalRows as $row): ?>
                                <div class="pi-row">
                                    <span class="pi-label"><?= htmlspecialchars($row['label']) ?>:</span>
                                    <span class="pi-value"><?= htmlspecialchars($row['value']) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Educational Attainment -->
                <div class="resume-block">
                    <div class="resume-block-header">
                        <span class="block-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                            </svg>
                        </span>
                        <h3 class="block-title-text">Educational Attainment</h3>
                    </div>
                    <div class="resume-block-body">
                        <div class="education-timeline">
                            <?php foreach (($portfolio['education'] ?? []) as $edu): ?>
                                <div class="edu-entry">
                                    <div class="edu-badge-level"><?= htmlspecialchars($edu['badge']) ?></div>
                                    <div class="edu-details">
                                        <div class="edu-level-label"><?= htmlspecialchars($edu['level']) ?>:</div>
                                        <h4 class="edu-school"><?= htmlspecialchars($edu['school']) ?></h4>
                                        <p class="edu-address"><?= htmlspecialchars($edu['address']) ?></p>
                                        <span class="edu-years-badge"><?= htmlspecialchars($edu['years']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Skills Summary -->
                <div class="resume-block">
                    <div class="resume-block-header">
                        <span class="block-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
                            </svg>
                        </span>
                        <h3 class="block-title-text">Technical Skills</h3>
                    </div>
                    <div class="resume-block-body">
                        <div class="resume-skills-pills">
                            <span class="res-skill-chip chip-primary">PHP 8</span>
                            <span class="res-skill-chip chip-primary">MySQL</span>
                            <span class="res-skill-chip chip-secondary">JavaScript (ES6+)</span>
                            <span class="res-skill-chip chip-secondary">HTML5</span>
                            <span class="res-skill-chip chip-secondary">CSS3 / Flexbox / Grid</span>
                            <span class="res-skill-chip chip-accent">Arduino (C++)</span>
                            <span class="res-skill-chip chip-accent">HC-SR04 Ultrasonic</span>
                            <span class="res-skill-chip chip-accent">5V Relay &amp; I2C LCD</span>
                            <span class="res-skill-chip chip-neutral">Git &amp; GitHub</span>
                            <span class="res-skill-chip chip-neutral">XAMPP &amp; Apache</span>
                            <span class="res-skill-chip chip-neutral">VS Code</span>
                        </div>
                    </div>
                </div>

                <!-- Projects Summary -->
                <div class="resume-block">
                    <div class="resume-block-header">
                        <span class="block-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        </span>
                        <h3 class="block-title-text">Core Projects</h3>
                    </div>
                    <div class="resume-block-body">
                        <div class="resume-projects-list">
                            <?php foreach ($portfolio['projects'] as $proj): ?>
                                <div class="res-proj-row">
                                    <div class="res-proj-dot"></div>
                                    <div class="res-proj-info">
                                        <h5 class="res-proj-title"><?= htmlspecialchars($proj['title']) ?></h5>
                                        <p class="res-proj-summary"><?= htmlspecialchars($proj['summary']) ?></p>
                                        <div class="res-proj-tags">
                                            <?php foreach (array_slice($proj['tags'], 0, 3) as $tag): ?>
                                                <span class="res-tag-mini"><?= htmlspecialchars($tag) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <a href="<?= htmlspecialchars($proj['demo']) ?>" target="_blank" class="res-proj-demo-link">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polygon points="5 3 19 12 5 21 5 3"/>
                                        </svg>
                                        Demo
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
