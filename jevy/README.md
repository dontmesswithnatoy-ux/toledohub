# 🌟 Jevy B. Toledo — Junior Web Developer Portfolio

A sleek, responsive, and modern portfolio website showcasing the technical work, projects, and skills of **Jevy B. Toledo**.

Built with native **Semantic HTML5**, **Modern Vanilla CSS**, and **JavaScript**, making it **100% ready for instant hosting on GitHub Pages** or on any standard web host / local XAMPP environment.

---

## 🚀 How to Publish to GitHub & GitHub Pages

This portfolio is fully optimized for **GitHub Pages** (with `index.html` at the root and static HTML versions of all 3 project demos).

### Step 1: Initialize Git & Push to GitHub
If you haven't already pushed to GitHub:
```bash
git init
git add .
git commit -m "Convert portfolio to static HTML for GitHub Pages"
git branch -M main
git remote add origin https://github.com/<your-username>/<your-repo-name>.git
git push -u origin main
```

### Step 2: Enable GitHub Pages in 1 Click
1. Open your repository on **GitHub.com**.
2. Go to **Settings** (tab at the top) &rarr; **Pages** (in the left sidebar).
3. Under **Build and deployment**:
   - **Source**: Select `Deploy from a branch`.
   - **Branch**: Select `main` (or `master`) and folder `/ (root)`.
4. Click **Save**.
5. Within 1–2 minutes, GitHub Pages will deploy your site at:
   ```
   https://<your-username>.github.io/<your-repo-name>/
   ```

---

## 💻 Local Testing

You can run this project in two ways locally:

### Option A: Open Directly or with VS Code Live Server
- Double-click [index.html](file:///c:/xampp/htdocs/jevy/index.html) in your browser.
- Or right-click [index.html](file:///c:/xampp/htdocs/jevy/index.html) in VS Code &rarr; **"Open with Live Server"**.

### Option B: Local Apache / XAMPP Server
Because this project is in `c:\xampp\htdocs\jevy`:
1. Start **Apache** in your XAMPP Control Panel.
2. Navigate to: [http://localhost/jevy/](http://localhost/jevy/)

---

## 🛠️ Featured Core Projects & Live Demos

All 3 projects are playable directly in the browser without any server dependencies:

1. **TapSeafood — Online Food Ordering Website**
   - *Path:* [`demos/tapseafood/index.html`](file:///c:/xampp/htdocs/jevy/demos/tapseafood/index.html)
   - *Features:* Dynamic seafood menu, category filters, interactive cart drawer, bill & discount calculation (`JEVYDEV` 15% voucher), order checkout modal, and simulated live order tracker.

2. **GrandStay — Hotel Online Booking System**
   - *Path:* [`demos/hotel-booking/index.html`](file:///c:/xampp/htdocs/jevy/demos/hotel-booking/index.html)
   - *Features:* Real-time date range night calculator, room category filtering, pricing & service tax calculation, VIP reservation modal, and printable confirmation voucher.

3. **SmartDispense — Touchless Arduino Water Dispenser Simulator**
   - *Path:* [`demos/arduino-dispenser/index.html`](file:///c:/xampp/htdocs/jevy/demos/arduino-dispenser/index.html)
   - *Features:* Interactive electronic bench simulating Arduino Uno, HC-SR04 ultrasonic proximity slider, 5V relay status, 12V pump flow animation, 16x2 LCD display, live serial monitor, and full Arduino C++ firmware code viewer.

---

## 📁 Repository Structure

```
jevy/
├── index.html                   # Primary entry point for GitHub Pages (100% static)
├── index.php                    # Modular PHP entry point (for local XAMPP)
├── jevy.mp4                     # Mock interview spotlight video
├── assets/
│   ├── css/
│   │   └── style.css            # Responsive CSS design system (Dark & Light themes)
│   ├── js/
│   │   └── main.js              # Theme toggle, filters, modal, video controls, form handling
│   └── images/
│       ├── jevy-toledo.png      # Profile portrait
│       ├── jevy-resume.png      # Official resume scan
│       ├── project-tapseafood.jpg
│       ├── project-hotel.svg
│       └── project-arduino.svg
├── demos/
│   ├── tapseafood/
│   │   ├── index.html           # Static TapSeafood demo
│   │   └── index.php
│   ├── hotel-booking/
│   │   ├── index.html           # Static Hotel Booking demo
│   │   └── index.php
│   └── arduino-dispenser/
│       ├── index.html           # Static Arduino Dispenser simulator
│       └── index.php
├── includes/                    # Modular PHP components (retained for XAMPP users)
│   ├── header.php
│   ├── nav.php
│   ├── hero.php
│   ├── about.php
│   ├── resume.php
│   ├── skills.php
│   ├── projects.php
│   ├── journey.php
│   ├── interview.php
│   ├── contact.php
│   └── footer.php
├── data/
│   └── portfolio_data.php       # Portfolio data model
└── README.md                    # Project documentation & GitHub setup
```

---

## ✨ Key Portfolio Features

- **GitHub Pages Ready**: Zero server requirements. Instant loading from any static CDN or GitHub repository.
- **Dark / Light Theme Toggle**: Seamless CSS custom property switching with `localStorage` persistence.
- **Dynamic Greeting**: Time-based greeting ("Good morning", "Good afternoon", "Good evening") rendered automatically via client-side JavaScript.
- **Integrated Video Player**: Interactive video showcase for `jevy.mp4` with custom playback toolbar, 0.75x–1.5x speed controls, and timestamp chapter jump chips.
- **Official Résumé Viewer & Lightbox**: Quick resume lightbox modal, CV section, and 1-click print / PDF export.
- **Working Contact Section**: Direct copy button for `jevytoledo1@gmail.com`, direct call link for `0915-290-3182`, and contact form with client validation, localStorage storage, and instant visual confirmation.
