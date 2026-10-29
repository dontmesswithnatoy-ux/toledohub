<?php
/**
 * GrandStay — Hotel Online Booking System
 * Live Demo Project by Jevy B. Toledo
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandStay Hotel & Suites | Online Reservation System — Live Demo by Jevy B. Toledo</title>
    <meta name="description" content="Hotel online room reservation engine with dynamic stay date calculation, room availability, and instant booking confirmation. Built by Jevy B. Toledo.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0a0f1d;
            --bg-card: #111a2e;
            --bg-card-hover: #18243e;
            --surface: #1e293b;
            --primary: #f59e0b;
            --primary-hover: #d97706;
            --accent-blue: #38bdf8;
            --accent-emerald: #10b981;
            --accent-purple: #a855f7;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.1);
            --radius-md: 12px;
            --radius-lg: 18px;
            --shadow-card: 0 15px 35px -5px rgba(0, 0, 0, 0.5);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            line-height: 1.5;
            min-height: 100vh;
            padding-bottom: 60px;
        }

        /* Top Demo Banner */
        .demo-top-bar {
            background: linear-gradient(90deg, #0f172a, #1f1b2e);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            padding: 10px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .demo-brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .demo-badge {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.4);
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #f59e0b;
            box-shadow: 0 0 8px #f59e0b;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .back-portfolio-btn {
            background: rgba(255, 255, 255, 0.08);
            color: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .back-portfolio-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #000;
            transform: translateX(-2px);
        }

        /* Hotel Brand Header */
        .hotel-hero {
            background: radial-gradient(circle at 50% 20%, rgba(245, 158, 11, 0.15), rgba(10, 15, 29, 0.95) 75%), url('../../assets/images/project-hotel.svg') center/cover;
            padding: 60px 24px 40px;
            border-bottom: 1px solid var(--border);
            text-align: center;
        }

        .hotel-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hotel-stars {
            color: #f59e0b;
            letter-spacing: 4px;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .hotel-title {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }

        .hotel-subtitle {
            color: var(--text-muted);
            font-size: 1.05rem;
            max-width: 650px;
            margin: 0 auto 30px;
        }

        /* Search & Booking Filter Bar */
        .booking-search-bar {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-lg);
            padding: 20px 28px;
            box-shadow: var(--shadow-card);
            display: grid;
            grid-template-columns: repeat(4, 1fr) auto;
            gap: 20px;
            align-items: end;
            text-align: left;
            margin-top: -20px;
            position: relative;
            z-index: 20;
        }

        .search-field label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .search-field input, .search-field select {
            width: 100%;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: white;
            padding: 10px 14px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: inherit;
        }

        .search-field input:focus, .search-field select:focus {
            border-color: var(--primary);
            outline: none;
        }

        .search-action-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #000;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s;
            height: 44px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        /* Stay Summary Banner */
        .stay-calculator-pill {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 10px;
            padding: 12px 20px;
            margin: 24px auto 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }

        .stay-calc-text strong {
            color: #f59e0b;
        }

        /* Rooms Grid */
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 28px;
        }

        .room-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }

        .room-card:hover {
            transform: translateY(-6px);
            border-color: rgba(245, 158, 11, 0.5);
            box-shadow: var(--shadow-card);
        }

        .room-media {
            height: 200px;
            position: relative;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4.5rem;
            border-bottom: 1px solid var(--border);
        }

        .room-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f59e0b;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .room-status-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.4);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .room-content {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .room-name {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .room-specs {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 14px;
        }

        .amenities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .amenity-chip {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            color: #cbd5e1;
        }

        .room-price-row {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .price-box {
            display: flex;
            flex-direction: column;
        }

        .price-rate {
            font-size: 1.5rem;
            font-weight: 800;
            color: #f59e0b;
            font-family: 'JetBrains Mono', monospace;
        }

        .price-sub {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .book-room-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #000;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s;
        }

        .book-room-btn:hover {
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            transform: scale(1.02);
        }

        /* Booking Modal */
        .modal-wrap {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(5px);
            z-index: 300;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .modal-wrap.open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-box {
            background: #111a2e;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 550px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 30px;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.7);
        }

        .modal-title {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .invoice-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px;
            margin: 18px 0;
            font-size: 0.85rem;
        }

        .inv-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            color: var(--text-muted);
        }

        .inv-row.total {
            font-size: 1.15rem;
            font-weight: 800;
            color: #f59e0b;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed rgba(255, 255, 255, 0.15);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: white;
            padding: 10px 12px;
            font-size: 0.88rem;
            font-family: inherit;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #f59e0b;
            outline: none;
        }

        .voucher-card {
            background: #0f172a;
            border: 2px dashed rgba(245, 158, 11, 0.5);
            border-radius: 14px;
            padding: 24px;
            text-align: left;
            margin: 20px 0;
            position: relative;
        }

        .voucher-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .voucher-ref {
            font-family: 'JetBrains Mono', monospace;
            color: #f59e0b;
            font-weight: 800;
            font-size: 1.1rem;
        }

        @media (max-width: 850px) {
            .booking-search-bar {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Top Portfolio Bar -->
    <header class="demo-top-bar">
        <div class="demo-brand-pill">
            <span class="demo-badge"><span class="pulse-dot"></span> LIVE WEB APP DEMO</span>
            <span>Project: <strong>GrandStay Hotel Online Booking</strong></span>
            <span>• Developed by <strong>Jevy B. Toledo</strong></span>
        </div>
        <a href="../../#projects" class="back-portfolio-btn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Back to Portfolio</span>
        </a>
    </header>

    <!-- Hotel Hero Header -->
    <section class="hotel-hero">
        <div class="hotel-container">
            <div class="hotel-stars">★★★★★ LUXURY RESORT</div>
            <h1 class="hotel-title">GrandStay Hotel &amp; Suites</h1>
            <p class="hotel-subtitle">
                Experience world-class hospitality in Las Piñas & Manila Bay. Select your dates to check live room availability, calculate stays, and confirm your VIP reservation.
            </p>
        </div>
    </section>

    <!-- Main Content Container -->
    <main class="hotel-container">
        <!-- Date Search Bar -->
        <div class="booking-search-bar">
            <div class="search-field">
                <label>Check-In Date</label>
                <input type="date" id="checkin-date">
            </div>

            <div class="search-field">
                <label>Check-Out Date</label>
                <input type="date" id="checkout-date">
            </div>

            <div class="search-field">
                <label>Guests</label>
                <select id="guest-count">
                    <option value="1">1 Adult (Solo)</option>
                    <option value="2" selected>2 Adults (Couple)</option>
                    <option value="3">3 Adults</option>
                    <option value="4">4 Guests (Family)</option>
                </select>
            </div>

            <div class="search-field">
                <label>Room Category</label>
                <select id="room-filter">
                    <option value="all">All Room Tiers (4)</option>
                    <option value="suite">Suites Only</option>
                    <option value="villa">Villas Only</option>
                    <option value="standard">Standard King</option>
                </select>
            </div>

            <button type="button" class="search-action-btn" id="update-search-btn">
                <span>Update Rates</span>
            </button>
        </div>

        <!-- Calculated Stay Pill -->
        <div class="stay-calculator-pill" id="stay-summary-pill">
            <div class="stay-calc-text">
                Calculated Stay: <strong id="nights-display">3 Nights</strong> (<span id="dates-display">Oct 29 – Nov 01</span>) • <span id="guests-display">2 Guests</span>
            </div>
            <div style="color: #34d399; font-weight: 700; font-size: 0.85rem;">
                ✓ Best Rate Guarantee Active
            </div>
        </div>

        <!-- Rooms Available Grid -->
        <div class="rooms-grid" id="rooms-grid">
            <!-- Populated via JavaScript -->
        </div>
    </main>

    <!-- Reservation Modal -->
    <div class="modal-wrap" id="booking-modal">
        <div class="modal-box">
            <h3 class="modal-title">Complete Your Reservation</h3>
            <p style="color: var(--text-muted); font-size: 0.85rem;">
                Enter guest details to reserve your suite at GrandStay.
            </p>

            <div class="invoice-card" id="invoice-breakdown">
                <!-- Dynamically generated by JS -->
            </div>

            <form id="reservation-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Lead Guest Name *</label>
                        <input type="text" id="guest-name" required value="Jevy B. Toledo">
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" id="guest-email" required value="jevytoledo1@gmail.com">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" id="guest-phone" required value="0915-290-3182">
                    </div>
                    <div class="form-group">
                        <label>Expected Arrival Time</label>
                        <select id="guest-eta">
                            <option value="2:00 PM (Standard Check-in)">2:00 PM (Standard Check-in)</option>
                            <option value="4:00 PM - 6:00 PM">4:00 PM - 6:00 PM</option>
                            <option value="Late Evening (After 8 PM)">Late Evening (After 8 PM)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Special Requests (Optional)</label>
                    <textarea id="guest-requests" rows="2" placeholder="e.g. High floor, extra pillows, airport shuttle pickup"></textarea>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <button type="button" class="back-portfolio-btn" style="flex: 1; justify-content: center; padding: 12px;" id="cancel-booking-btn">
                        Cancel
                    </button>
                    <button type="submit" class="book-room-btn" style="flex: 1; padding: 12px;">
                        Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Booking Confirmation Voucher Modal -->
    <div class="modal-wrap" id="voucher-modal">
        <div class="modal-box" style="text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 8px;">🏨</div>
            <h3 class="modal-title" style="color: #f59e0b;">Reservation Confirmed!</h3>
            <p style="color: var(--text-muted); font-size: 0.85rem;">
                A confirmation voucher and receipt has been generated.
            </p>

            <div class="voucher-card" id="voucher-content">
                <!-- Generated by JS -->
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="button" class="back-portfolio-btn" style="flex: 1; justify-content: center; padding: 12px;" onclick="window.print()">
                    🖨️ Print Voucher
                </button>
                <button type="button" class="book-room-btn" style="flex: 1; padding: 12px;" id="close-voucher-btn">
                    Done
                </button>
            </div>
        </div>
    </div>

    <script>
        // Room inventory
        const hotelRooms = [
            {
                id: 'deluxe-ocean',
                name: 'Deluxe Ocean Suite',
                type: 'suite',
                ratePerNight: 4500,
                specs: '1 King Bed • 55m² • Panoramic Ocean View',
                amenities: ['Private Balcony', 'Deep Soaking Tub', 'Complimentary Breakfast', 'Free High-speed Wi-Fi', 'Nespresso Bar'],
                emoji: '🌊',
                badge: 'Guest Favorite',
                availableCount: 3
            },
            {
                id: 'garden-villa',
                name: 'Executive Garden Villa',
                type: 'villa',
                ratePerNight: 6800,
                specs: '2 Queen Beds • 90m² • Private Tropical Garden',
                amenities: ['Plunge Pool', 'Outdoor Rain Shower', 'Complimentary Minibar', 'VIP Airport Transfer', 'Buffet Breakfast'],
                emoji: '🌴',
                badge: 'Exclusive Oasis',
                availableCount: 2
            },
            {
                id: 'presidential-penthouse',
                name: 'Presidential Penthouse',
                type: 'suite',
                ratePerNight: 12500,
                specs: '2 Master Suites • 180m² • 360° Skydeck View',
                amenities: ['Rooftop Jacuzzi', '24/7 Butler Service', 'Premium Champagne', 'Walk-in Closets', 'Private Chef Dinner'],
                emoji: '👑',
                badge: 'Ultra VIP Luxury',
                availableCount: 1
            },
            {
                id: 'superior-king',
                name: 'Superior King Room',
                type: 'standard',
                ratePerNight: 3200,
                specs: '1 King Bed • 40m² • City Skyline View',
                amenities: ['Ergonomic Work Desk', 'Smart 4K TV', 'Rain Shower', 'High-speed Wi-Fi', '24h Room Service'],
                emoji: '🏙️',
                badge: 'Great Value',
                availableCount: 5
            }
        ];

        let selectedRoom = null;
        let stayNights = 3;

        // Initialize Dates (Tomorrow to +4 days)
        const checkinInput = document.getElementById('checkin-date');
        const checkoutInput = document.getElementById('checkout-date');

        const now = new Date();
        const tomorrow = new Date(now);
        tomorrow.setDate(now.getDate() + 1);
        const checkOutDef = new Date(now);
        checkOutDef.setDate(now.getDate() + 4);

        checkinInput.value = tomorrow.toISOString().split('T')[0];
        checkoutInput.value = checkOutDef.toISOString().split('T')[0];

        function calculateNights() {
            const start = new Date(checkinInput.value);
            const end = new Date(checkoutInput.value);
            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            stayNights = diffDays > 0 ? diffDays : 1;

            const opt = { month: 'short', day: 'numeric' };
            document.getElementById('nights-display').textContent = `${stayNights} Night${stayNights > 1 ? 's' : ''}`;
            document.getElementById('dates-display').textContent = `${start.toLocaleDateString('en-US', opt)} – ${end.toLocaleDateString('en-US', opt)}`;
            document.getElementById('guests-display').textContent = `${document.getElementById('guest-count').value} Guests`;

            renderRooms();
        }

        checkinInput.addEventListener('change', calculateNights);
        checkoutInput.addEventListener('change', calculateNights);
        document.getElementById('guest-count').addEventListener('change', calculateNights);
        document.getElementById('room-filter').addEventListener('change', renderRooms);
        document.getElementById('update-search-btn').addEventListener('click', calculateNights);

        function renderRooms() {
            const container = document.getElementById('rooms-grid');
            container.innerHTML = '';
            const filter = document.getElementById('room-filter').value;

            const filtered = filter === 'all' 
                ? hotelRooms 
                : hotelRooms.filter(r => r.type === filter);

            filtered.forEach(room => {
                const totalStayPrice = room.ratePerNight * stayNights;
                const card = document.createElement('div');
                card.className = 'room-card';
                card.innerHTML = `
                    <div class="room-media">
                        <span class="room-badge">${room.badge}</span>
                        <span class="room-status-badge">● ${room.availableCount} Available</span>
                        <span>${room.emoji}</span>
                    </div>
                    <div class="room-content">
                        <h3 class="room-name">${room.name}</h3>
                        <p class="room-specs">${room.specs}</p>

                        <div class="amenities-list">
                            ${room.amenities.map(a => `<span class="amenity-chip">✓ ${a}</span>`).join('')}
                        </div>

                        <div class="room-price-row">
                            <div class="price-box">
                                <span class="price-rate">₱${room.ratePerNight.toLocaleString()}</span>
                                <span class="price-sub">per night • ₱${totalStayPrice.toLocaleString()} for ${stayNights} night${stayNights > 1 ? 's' : ''}</span>
                            </div>
                            <button type="button" class="book-room-btn" onclick="openBookingModal('${room.id}')">
                                Book Room
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        const bookingModal = document.getElementById('booking-modal');
        function openBookingModal(roomId) {
            selectedRoom = hotelRooms.find(r => r.id === roomId);
            if (!selectedRoom) return;

            const roomTotal = selectedRoom.ratePerNight * stayNights;
            const serviceCharge = roomTotal * 0.10;
            const tourismTax = 150 * stayNights;
            const grandTotal = roomTotal + serviceCharge + tourismTax;

            const breakdown = document.getElementById('invoice-breakdown');
            breakdown.innerHTML = `
                <div style="font-weight: 700; color: #fff; margin-bottom: 8px;">
                    ${selectedRoom.name} (${stayNights} Night${stayNights > 1 ? 's' : ''})
                </div>
                <div class="inv-row">
                    <span>Stay Dates:</span>
                    <span>${checkinInput.value} to ${checkoutInput.value}</span>
                </div>
                <div class="inv-row">
                    <span>Room Rate (₱${selectedRoom.ratePerNight.toLocaleString()} × ${stayNights}n):</span>
                    <span>₱${roomTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}</span>
                </div>
                <div class="inv-row">
                    <span>10% Service Charge:</span>
                    <span>₱${serviceCharge.toLocaleString('en-US', {minimumFractionDigits: 2})}</span>
                </div>
                <div class="inv-row">
                    <span>Local Tourism Tax (₱150/n):</span>
                    <span>₱${tourismTax.toLocaleString('en-US', {minimumFractionDigits: 2})}</span>
                </div>
                <div class="inv-row total">
                    <span>Total Amount Payable:</span>
                    <span>₱${grandTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}</span>
                </div>
            `;

            bookingModal.classList.add('open');
        }

        document.getElementById('cancel-booking-btn').addEventListener('click', () => {
            bookingModal.classList.remove('open');
        });

        // Form Submit
        const voucherModal = document.getElementById('voucher-modal');
        document.getElementById('reservation-form').addEventListener('submit', (e) => {
            e.preventDefault();
            bookingModal.classList.remove('open');

            const name = document.getElementById('guest-name').value;
            const email = document.getElementById('guest-email').value;
            const phone = document.getElementById('guest-phone').value;
            const randRef = 'GS-2026-' + Math.floor(1000 + Math.random() * 9000);

            const roomTotal = selectedRoom.ratePerNight * stayNights;
            const grandTotal = roomTotal + (roomTotal * 0.10) + (150 * stayNights);

            const voucher = document.getElementById('voucher-content');
            voucher.innerHTML = `
                <div class="voucher-header">
                    <div>
                        <div style="font-size: 0.8rem; color: #94a3b8;">BOOKING REFERENCE</div>
                        <div class="voucher-ref">${randRef}</div>
                    </div>
                    <div style="text-align: right;">
                        <span style="background: #10b981; color: #fff; font-size: 0.72rem; padding: 4px 8px; border-radius: 4px; font-weight: 700;">
                            CONFIRMED &amp; GUARANTEED
                        </span>
                    </div>
                </div>

                <div style="font-size: 0.88rem; line-height: 1.6;">
                    <p><strong>Primary Guest:</strong> ${name}</p>
                    <p><strong>Contact:</strong> ${email} | ${phone}</p>
                    <p><strong>Room Reserved:</strong> ${selectedRoom.name} (${selectedRoom.specs})</p>
                    <p><strong>Check-In:</strong> ${checkinInput.value} (from 2:00 PM)</p>
                    <p><strong>Check-Out:</strong> ${checkoutInput.value} (until 12:00 PM)</p>
                    <p><strong>Stay Duration:</strong> ${stayNights} Night(s)</p>
                    <hr style="margin: 10px 0; border: none; border-top: 1px dashed rgba(255,255,255,0.15);">
                    <p style="font-size: 1.05rem; font-weight: 800; color: #f59e0b;">
                        Total Invoice: ₱${grandTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}
                    </p>
                    <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 4px;">
                        Payment to be settled at front desk upon check-in. Valid Government ID required.
                    </p>
                </div>
            `;

            voucherModal.classList.add('open');
        });

        document.getElementById('close-voucher-btn').addEventListener('click', () => {
            voucherModal.classList.remove('open');
        });

        // Init
        calculateNights();
    </script>
</body>
</html>
