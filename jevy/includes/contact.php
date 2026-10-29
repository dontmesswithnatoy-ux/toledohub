<?php
/**
 * Contact Component
 * Interactive contact form backed by PHP handler with validation, anti-spam honeypot,
 * session flash messaging, and direct contact options with one-click copy.
 */

// Retrieve flash message if any from session
$flashMessage = $_SESSION['flash_message'] ?? null;
$flashErrors = $_SESSION['flash_errors'] ?? [];
$flashOld = $_SESSION['flash_old'] ?? [];

// Clear flash data after reading
unset($_SESSION['flash_message'], $_SESSION['flash_errors'], $_SESSION['flash_old']);
?>
<section class="section contact-section" id="contact">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center">
            <span class="section-badge">Get In Touch</span>
            <h2 class="section-title">Let's Build Something Together</h2>
            <p class="section-subtitle">
                Have an open junior role, a question about my projects, or want to discuss an opportunity? My inbox is always open!
            </p>
        </div>

        <!-- Flash Alert Message (PHP Session Fallback) -->
        <?php if ($flashMessage): ?>
            <div class="flash-alert flash-<?= htmlspecialchars($flashMessage['type']) ?>" role="alert" id="session-flash-alert">
                <span class="flash-icon">
                    <?= $flashMessage['type'] === 'success' ? '✓' : '⚠' ?>
                </span>
                <span class="flash-text"><?= htmlspecialchars($flashMessage['text']) ?></span>
                <button type="button" class="flash-close" onclick="this.parentElement.remove()" aria-label="Close notification">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Contact Grid (2 Columns: Info & Form) -->
        <div class="contact-grid">
            <!-- Left Column: Contact Details -->
            <div class="contact-info-card">
                <div class="info-badge">
                    <span class="pulse-dot"></span>
                    <span>Currently Available for Opportunities</span>
                </div>
                
                <h3 class="info-title">Let's start a conversation</h3>
                <p class="info-text">
                    I am actively seeking junior frontend, full-stack, or PHP entry-level engineering positions. Feel free to send an email, give me a call, or send a message through the form!
                </p>

                <!-- Interactive Email Card with Copy Button -->
                <div class="email-highlight-box">
                    <div class="email-meta">
                        <span class="email-label">Direct Email</span>
                        <a href="mailto:<?= htmlspecialchars($portfolio['email']) ?>" class="email-value" id="portfolio-email"><?= htmlspecialchars($portfolio['email']) ?></a>
                    </div>
                    <button type="button" class="copy-email-btn" id="copy-email-btn" title="Copy email address" aria-label="Copy email address to clipboard">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="copy-text">Copy</span>
                    </button>
                </div>

                <!-- Direct Phone Card -->
                <div class="email-highlight-box">
                    <div class="email-meta">
                        <span class="email-label">Mobile Phone</span>
                        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $portfolio['phone']) ?>" class="email-value"><?= htmlspecialchars($portfolio['phone']) ?></a>
                    </div>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $portfolio['phone']) ?>" class="copy-email-btn" title="Call directly" aria-label="Call phone number">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span>Call</span>
                    </a>
                </div>

                <!-- Info Details List -->
                <ul class="contact-details-list">
                    <li class="contact-detail-item">
                        <span class="detail-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </span>
                        <div>
                            <span class="detail-label">Response Time</span>
                            <span class="detail-val">Usually within 24 hours</span>
                        </div>
                    </li>
                    <li class="contact-detail-item">
                        <span class="detail-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </span>
                        <div>
                            <span class="detail-label">Location</span>
                            <span class="detail-val"><?= htmlspecialchars($portfolio['location']) ?></span>
                        </div>
                    </li>
                </ul>
            </div> <!-- End .contact-info-card -->

            <!-- Right Column: Contact Form -->
            <div class="contact-form-card">
                <form action="contact-handler.php" method="POST" class="contact-form" id="contact-form" novalidate>
                    <!-- Honeypot Field for anti-spam (hidden from real users) -->
                    <div class="honeypot-field" aria-hidden="true" style="display: none !important;">
                        <label for="website_hp">Leave this empty</label>
                        <input type="text" name="website_hp" id="website_hp" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="form-row">
                        <!-- Name Field -->
                        <div class="form-group <?= isset($flashErrors['name']) ? 'has-error' : '' ?>">
                            <label for="form-name" class="form-label">Your Name <span class="required-star">*</span></label>
                            <input type="text" id="form-name" name="name" class="form-input" placeholder="e.g. Sarah Jenkins" value="<?= htmlspecialchars($flashOld['name'] ?? '') ?>" required minlength="2">
                            <span class="field-error-msg" id="name-error"><?= htmlspecialchars($flashErrors['name'] ?? '') ?></span>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group <?= isset($flashErrors['email']) ? 'has-error' : '' ?>">
                            <label for="form-email" class="form-label">Email Address <span class="required-star">*</span></label>
                            <input type="email" id="form-email" name="email" class="form-input" placeholder="sarah@example.com" value="<?= htmlspecialchars($flashOld['email'] ?? '') ?>" required>
                            <span class="field-error-msg" id="email-error"><?= htmlspecialchars($flashErrors['email'] ?? '') ?></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Interest Dropdown -->
                        <div class="form-group">
                            <label for="form-interest" class="form-label">Opportunity Type</label>
                            <select id="form-interest" name="interest" class="form-select">
                                <option value="Junior Web Developer Role" <?= ($flashOld['interest'] ?? '') === 'Junior Web Developer Role' ? 'selected' : '' ?>>Junior Web Developer Role</option>
                                <option value="Full-Stack / PHP Role" <?= ($flashOld['interest'] ?? '') === 'Full-Stack / PHP Role' ? 'selected' : '' ?>>Full-Stack / PHP Role</option>
                                <option value="Internship Opportunity" <?= ($flashOld['interest'] ?? '') === 'Internship Opportunity' ? 'selected' : '' ?>>Internship Opportunity</option>
                                <option value="Freelance / Contract Project" <?= ($flashOld['interest'] ?? '') === 'Freelance / Contract Project' ? 'selected' : '' ?>>Freelance / Contract Project</option>
                                <option value="Mentorship & Advice" <?= ($flashOld['interest'] ?? '') === 'Mentorship & Advice' ? 'selected' : '' ?>>Mentorship & Advice</option>
                                <option value="Just Saying Hi!" <?= ($flashOld['interest'] ?? '') === 'Just Saying Hi!' ? 'selected' : '' ?>>Just Saying Hi!</option>
                            </select>
                        </div>

                        <!-- Subject Field -->
                        <div class="form-group">
                            <label for="form-subject" class="form-label">Subject</label>
                            <input type="text" id="form-subject" name="subject" class="form-input" placeholder="e.g. Junior Developer Opening" value="<?= htmlspecialchars($flashOld['subject'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Message Field -->
                    <div class="form-group <?= isset($flashErrors['message']) ? 'has-error' : '' ?>">
                        <label for="form-message" class="form-label">Message <span class="required-star">*</span></label>
                        <textarea id="form-message" name="message" class="form-textarea" rows="5" placeholder="Hi <?= htmlspecialchars(explode(' ', $portfolio['name'])[0]) ?>, I checked out your portfolio and would love to talk about..." required minlength="10"><?= htmlspecialchars($flashOld['message'] ?? '') ?></textarea>
                        <span class="field-error-msg" id="message-error"><?= htmlspecialchars($flashErrors['message'] ?? '') ?></span>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary btn-submit" id="submit-contact-btn">
                            <span class="btn-text">Send Message</span>
                            <span class="btn-spinner" aria-hidden="true"></span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="btn-arrow-icon">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                        <span class="form-note">⚡ Powered by PHP 8 Form Processing</span>
                    </div>

                    <!-- Form Status Box (for AJAX feedback) -->
                    <div class="ajax-form-status" id="ajax-form-status" style="display: none;" role="status"></div>
                </form>
            </div> <!-- End .contact-form-card -->
        </div> <!-- End .contact-grid -->
    </div> <!-- End .container -->
</section>
