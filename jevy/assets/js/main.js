/**
* Main JavaScript Controller
* Handles Theme Switching, Mobile Nav, Project Filtering, Interactive Modals,
* One-Click Copy, and AJAX Form Submission with PHP Backend.
*/

document.addEventListener('DOMContentLoaded', () => {
    initDynamicGreeting();
    initThemeToggle();
    initMobileNav();
    initActiveNavScroll();
    initProjectFilters();
    initProjectModal();
    initCopyEmail();
    initContactForm();
    initBackToTop();
});

/* --------------------------------------------------------------------------
   0. Dynamic Client Greeting (Morning / Afternoon / Evening)
   -------------------------------------------------------------------------- */
function initDynamicGreeting() {
    const greetingEl = document.querySelector('#hero-greeting .greeting-text');
    if (!greetingEl) return;
    const hour = new Date().getHours();
    let greeting = 'Good morning';
    if (hour >= 12 && hour < 18) {
        greeting = 'Good afternoon';
    } else if (hour >= 18 || hour < 5) {
        greeting = 'Good evening';
    }
    greetingEl.textContent = `${greeting}, I'm`;
}


/* --------------------------------------------------------------------------
   1. Theme Switching (Dark / Light Mode)
   -------------------------------------------------------------------------- */
function initThemeToggle() {
    const themeBtn = document.getElementById('theme-toggle');
    if (!themeBtn) return;

    themeBtn.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('portfolio_theme', newTheme);
        showToast(`Switched to ${newTheme} mode`, 'theme');
    });
}

/* --------------------------------------------------------------------------
   2. Mobile Drawer Navigation
   -------------------------------------------------------------------------- */
function initMobileNav() {
    const toggleBtn = document.getElementById('mobile-nav-toggle');
    const drawer = document.getElementById('mobile-nav-drawer');
    if (!toggleBtn || !drawer) return;

    toggleBtn.addEventListener('click', () => {
        const isOpen = drawer.classList.contains('open');
        drawer.classList.toggle('open');
        toggleBtn.setAttribute('aria-expanded', !isOpen);
        drawer.setAttribute('aria-hidden', isOpen);
    });

    // Close drawer when a navigation link is clicked
    const mobileLinks = drawer.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            drawer.classList.remove('open');
            toggleBtn.setAttribute('aria-expanded', 'false');
            drawer.setAttribute('aria-hidden', 'true');
        });
    });

    // Close on click outside
    document.addEventListener('click', (e) => {
        if (!drawer.contains(e.target) && !toggleBtn.contains(e.target) && drawer.classList.contains('open')) {
            drawer.classList.remove('open');
            toggleBtn.setAttribute('aria-expanded', 'false');
            drawer.setAttribute('aria-hidden', 'true');
        }
    });
}

/* --------------------------------------------------------------------------
   3. Active Section Link Tracking on Scroll
   -------------------------------------------------------------------------- */
function initActiveNavScroll() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.desktop-nav .nav-link');

    if (!sections.length || !navLinks.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const currentId = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    const href = link.getAttribute('href').replace('#', '');
                    if (href === currentId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
        });
    }, {
        rootMargin: '-30% 0px -60% 0px'
    });

    sections.forEach(section => observer.observe(section));
}

/* --------------------------------------------------------------------------
   4. Project Category Filtering
   -------------------------------------------------------------------------- */
function initProjectFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    if (!filterButtons.length || !projectCards.length) return;

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');

            // Update active state on buttons
            filterButtons.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');

            // Show / Hide project cards with smooth transitions
            projectCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 20);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 200);
                }
            });
        });
    });
}

/* --------------------------------------------------------------------------
   5. Interactive Project Details Modal
   -------------------------------------------------------------------------- */
function initProjectModal() {
    const modalBackdrop = document.getElementById('project-modal');
    const closeBtn = document.getElementById('modal-close');
    const openBtns = document.querySelectorAll('.open-modal-btn');

    if (!modalBackdrop || !window.portfolioData || !window.portfolioData.projects) return;

    const projects = window.portfolioData.projects;

    // Elements inside modal
    const modalCategory = document.getElementById('modal-project-category');
    const modalTitle = document.getElementById('modal-project-title');
    const modalImg = document.getElementById('modal-project-img');
    const modalDesc = document.getElementById('modal-project-desc');
    const modalHighlights = document.getElementById('modal-project-highlights');
    const modalTags = document.getElementById('modal-project-tags');
    const modalDemoBtn = document.getElementById('modal-demo-btn');
    const modalGithubBtn = document.getElementById('modal-github-btn');

    function openModal(projectId) {
        const project = projects.find(p => p.id === projectId);
        if (!project) return;

        modalCategory.textContent = project.category_label || 'Project Details';
        modalTitle.textContent = project.title;
        modalImg.src = project.image;
        modalImg.alt = project.title;
        modalDesc.textContent = project.description || project.summary;

        // Populate highlights
        modalHighlights.innerHTML = '';
        if (project.highlights && project.highlights.length) {
            project.highlights.forEach(h => {
                const li = document.createElement('li');
                li.textContent = h;
                modalHighlights.appendChild(li);
            });
        }

        // Populate tags
        modalTags.innerHTML = '';
        if (project.tags && project.tags.length) {
            project.tags.forEach(tag => {
                const span = document.createElement('span');
                span.className = 'tag-chip';
                span.textContent = tag;
                modalTags.appendChild(span);
            });
        }

        // Configure links
        if (project.demo && project.demo !== '#') {
            modalDemoBtn.href = project.demo;
            modalDemoBtn.target = '_blank';
            modalDemoBtn.onclick = null;
        } else {
            modalDemoBtn.href = '#';
            modalDemoBtn.onclick = (e) => {
                e.preventDefault();
                showToast(`Live demo for ${project.title} will open in a separate window.`, 'info');
            };
        }
        modalGithubBtn.href = project.github || 'https://github.com';

        // Show modal
        modalBackdrop.classList.add('active');
        modalBackdrop.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modalBackdrop.classList.remove('active');
        modalBackdrop.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    openBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const projectId = btn.getAttribute('data-project-id');
            openModal(projectId);
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    modalBackdrop.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalBackdrop.classList.contains('active')) {
            closeModal();
        }
    });
}

/* --------------------------------------------------------------------------
   6. One-Click Copy Email to Clipboard
   -------------------------------------------------------------------------- */
function initCopyEmail() {
    const copyBtn = document.getElementById('copy-email-btn');
    const emailEl = document.getElementById('portfolio-email');

    if (!copyBtn || !emailEl) return;

    copyBtn.addEventListener('click', async () => {
        const email = emailEl.textContent.trim();
        const copyTextEl = copyBtn.querySelector('.copy-text');

        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(email);
            } else {
                // Fallback for non-https or older browsers
                const textArea = document.createElement('textarea');
                textArea.value = email;
                textArea.style.position = 'fixed';
                textArea.style.left = '-9999px';
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
            }

            if (copyTextEl) copyTextEl.textContent = 'Copied!';
            showToast('Email address copied to clipboard!', 'success');

            setTimeout(() => {
                if (copyTextEl) copyTextEl.textContent = 'Copy';
            }, 2500);
        } catch (err) {
            console.error('Copy failed: ', err);
            showToast(email, 'info');
        }
    });
}

/* --------------------------------------------------------------------------
   7. Contact Form AJAX Submission with PHP Backend
   -------------------------------------------------------------------------- */
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const submitBtn = document.getElementById('submit-contact-btn');
    const statusBox = document.getElementById('ajax-form-status');
    const nameError = document.getElementById('name-error');
    const emailError = document.getElementById('email-error');
    const messageError = document.getElementById('message-error');

    function clearErrors() {
        form.querySelectorAll('.form-group').forEach(group => group.classList.remove('has-error'));
        if (nameError) nameError.textContent = '';
        if (emailError) emailError.textContent = '';
        if (messageError) messageError.textContent = '';
        if (statusBox) {
            statusBox.style.display = 'none';
            statusBox.className = 'ajax-form-status';
            statusBox.textContent = '';
        }
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();

        // Basic client pre-validation
        const nameVal = form.name.value.trim();
        const emailVal = form.email.value.trim();
        const messageVal = form.message.value.trim();
        let hasClientError = false;

        if (nameVal.length < 2) {
            form.name.closest('.form-group').classList.add('has-error');
            if (nameError) nameError.textContent = 'Please enter your name (at least 2 characters).';
            hasClientError = true;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailVal)) {
            form.email.closest('.form-group').classList.add('has-error');
            if (emailError) emailError.textContent = 'Please provide a valid email address.';
            hasClientError = true;
        }

        if (messageVal.length < 10) {
            form.message.closest('.form-group').classList.add('has-error');
            if (messageError) messageError.textContent = 'Message must be at least 10 characters long.';
            hasClientError = true;
        }

        if (hasClientError) return;

        // Prepare FormData
        const formData = new FormData(form);
        formData.append('ajax', '1');

        // Loading UI state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        try {
            const response = await fetch('contact-handler.php', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                form.reset();
                if (statusBox) {
                    statusBox.className = 'ajax-form-status status-success';
                    statusBox.textContent = data.message || 'Thank you! Your message was sent successfully.';
                    statusBox.style.display = 'block';
                }
                showToast(data.message || 'Message received successfully!', 'success');
            } else {
                // Server validation error
                if (statusBox) {
                    statusBox.className = 'ajax-form-status status-error';
                    statusBox.textContent = data.message || 'Please fix the errors below.';
                    statusBox.style.display = 'block';
                }
                if (data.errors) {
                    if (data.errors.name && nameError) {
                        form.name.closest('.form-group').classList.add('has-error');
                        nameError.textContent = data.errors.name;
                    }
                    if (data.errors.email && emailError) {
                        form.email.closest('.form-group').classList.add('has-error');
                        emailError.textContent = data.errors.email;
                    }
                    if (data.errors.message && messageError) {
                        form.message.closest('.form-group').classList.add('has-error');
                        messageError.textContent = data.errors.message;
                    }
                }
                showToast('Please check the form for errors.', 'error');
            }
        } catch (error) {
            console.warn('Backend unavailable (static/GitHub mode). Storing message locally:', error);
            try {
                const inquiries = JSON.parse(localStorage.getItem('portfolio_inquiries') || '[]');
                inquiries.push({
                    name: nameVal,
                    email: emailVal,
                    interest: form.interest ? form.interest.value : '',
                    subject: form.subject ? form.subject.value : '',
                    message: messageVal,
                    timestamp: new Date().toISOString()
                });
                localStorage.setItem('portfolio_inquiries', JSON.stringify(inquiries));
            } catch (e) {
                console.error('LocalStorage write failed:', e);
            }

            form.reset();
            if (statusBox) {
                statusBox.className = 'ajax-form-status status-success';
                statusBox.textContent = `Thank you, ${nameVal}! Your message has been received. You can also reach me directly at jevytoledo1@gmail.com.`;
                statusBox.style.display = 'block';
            }
            showToast(`Thank you, ${nameVal}! Message received.`, 'success');
        } finally {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }
    });
}

/* --------------------------------------------------------------------------
   8. Back to Top Button
   -------------------------------------------------------------------------- */
function initBackToTop() {
    const backBtn = document.getElementById('back-to-top');
    if (!backBtn) return;

    backBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/* --------------------------------------------------------------------------
   9. Global Toast Notification System
   -------------------------------------------------------------------------- */
let toastTimeout = null;
function showToast(message, type = 'info') {
    const toast = document.getElementById('toast-notification');
    const toastMsg = document.getElementById('toast-message');
    const toastIcon = document.getElementById('toast-icon');

    if (!toast || !toastMsg) return;

    if (toastTimeout) {
        clearTimeout(toastTimeout);
    }

    toastMsg.textContent = message;

    if (toastIcon) {
        if (type === 'success') {
            toastIcon.textContent = '✓';
            toastIcon.style.color = 'var(--accent-emerald)';
        } else if (type === 'error') {
            toastIcon.textContent = '✕';
            toastIcon.style.color = 'var(--accent-rose)';
        } else if (type === 'theme') {
            toastIcon.textContent = '◐';
            toastIcon.style.color = 'var(--primary)';
        } else {
            toastIcon.textContent = 'ℹ';
            toastIcon.style.color = 'var(--accent-cyan)';
        }
    }

    toast.classList.add('show');

    toastTimeout = setTimeout(() => {
        toast.classList.remove('show');
    }, 3500);
}

/* --------------------------------------------------------------------------
   Mock Interview Video Controls (jevy.mp4)
   -------------------------------------------------------------------------- */

function _jevyVid() {
    return document.getElementById('jevy-interview-video');
}

window.jevyTogglePlay = function () {
    const vid = _jevyVid();
    if (!vid) return;
    if (vid.paused) {
        vid.play().then(() => {
            _jevySetPlayUI(true);
            const overlay = document.getElementById('jevyVideoOverlay');
            if (overlay) overlay.classList.add('playing');
        }).catch(() => { });
    } else {
        vid.pause();
        _jevySetPlayUI(false);
    }
};

window.jevyRestartVideo = function () {
    const vid = _jevyVid();
    if (!vid) return;
    vid.currentTime = 0;
    vid.play().then(() => {
        _jevySetPlayUI(true);
        const overlay = document.getElementById('jevyVideoOverlay');
        if (overlay) overlay.classList.add('playing');
    }).catch(() => { });
};

window.jevyToggleMute = function () {
    const vid = _jevyVid();
    if (!vid) return;
    vid.muted = !vid.muted;
    const label = document.getElementById('jevyMuteLabel');
    if (label) label.textContent = vid.muted ? 'Unmute' : 'Mute';
};

window.jevySetSpeed = function (rate, btn) {
    const vid = _jevyVid();
    if (!vid) return;
    vid.playbackRate = rate;
    document.querySelectorAll('.speed-chip').forEach(c => c.classList.remove('active'));
    if (btn) btn.classList.add('active');
};

window.jevySeek = function (seconds) {
    const vid = _jevyVid();
    if (!vid) return;
    vid.currentTime = seconds;
    if (vid.paused) {
        vid.play().then(() => {
            _jevySetPlayUI(true);
            const overlay = document.getElementById('jevyVideoOverlay');
            if (overlay) overlay.classList.add('playing');
        }).catch(() => { });
    }
};

window.jevyFullscreen = function () {
    const wrapper = document.getElementById('interviewVideoWrapper');
    const vid = _jevyVid();
    const target = wrapper || vid;
    if (!target) return;
    if (!document.fullscreenElement) {
        if (target.requestFullscreen) target.requestFullscreen();
        else if (target.webkitRequestFullscreen) target.webkitRequestFullscreen();
    } else {
        if (document.exitFullscreen) document.exitFullscreen();
    }
};

function _jevySetPlayUI(playing) {
    const label = document.getElementById('jevyCtrlLabel');
    const icon = document.getElementById('jevyCtrlIcon');
    if (label) label.textContent = playing ? 'Pause' : 'Play';
    if (icon) {
        icon.innerHTML = playing
            ? '<rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect>'
            : '<polygon points="6 4 20 12 6 20 6 4"></polygon>';
    }
}

// Attach event listeners once DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const vid = _jevyVid();
    if (!vid) return;
    const overlay = document.getElementById('jevyVideoOverlay');

    vid.addEventListener('play', () => {
        _jevySetPlayUI(true);
        if (overlay) overlay.classList.add('playing');
    });
    vid.addEventListener('pause', () => {
        _jevySetPlayUI(false);
    });
    vid.addEventListener('ended', () => {
        _jevySetPlayUI(false);
        if (overlay) overlay.classList.remove('playing');
    });
});
