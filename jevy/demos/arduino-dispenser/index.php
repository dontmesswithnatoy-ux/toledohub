<?php
/**
 * SmartDispense — Touchless Arduino Water Dispenser
 * Interactive IoT Hardware Simulator & Live Demo
 * Built by Jevy B. Toledo
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDispense | Touchless Arduino Water Dispenser Simulator — Jevy B. Toledo</title>
    <meta name="description" content="Interactive hardware simulator and C++ firmware showcase for SmartDispense touchless Arduino water dispenser by Jevy B. Toledo.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0a0f1d;
            --bg-card: #111b2e;
            --bg-card-hover: #16243f;
            --arduino-teal: #00979c;
            --arduino-teal-glow: rgba(0, 151, 156, 0.4);
            --water-blue: #38bdf8;
            --status-green: #10b981;
            --status-red: #ef4444;
            --status-amber: #f59e0b;
            --lcd-bg: #032b21;
            --lcd-text: #34d399;
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
            background: linear-gradient(90deg, #091325, #042f2e);
            border-bottom: 1px solid rgba(0, 151, 156, 0.3);
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
            background: rgba(0, 151, 156, 0.2);
            color: #2dd4bf;
            border: 1px solid rgba(0, 151, 156, 0.4);
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
            background: #2dd4bf;
            box-shadow: 0 0 8px #2dd4bf;
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
            background: var(--arduino-teal);
            border-color: var(--arduino-teal);
            color: #fff;
            transform: translateX(-2px);
        }

        /* Container */
        .sim-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Simulator Header */
        .sim-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .sim-title {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .sim-title span {
            color: #2dd4bf;
        }

        .sim-desc {
            color: var(--text-muted);
            font-size: 0.95rem;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Mode Switcher Tabs */
        .tab-switcher {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .mode-btn {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--border);
            color: var(--text-muted);
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mode-btn.active, .mode-btn:hover {
            background: var(--arduino-teal);
            color: white;
            border-color: var(--arduino-teal);
            box-shadow: 0 4px 15px var(--arduino-teal-glow);
        }

        /* Workbench Layout */
        .workbench-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .bench-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-card);
            display: flex;
            flex-direction: column;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .card-heading {
            font-size: 1.15rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-chip {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* Physical Dispenser Mockup (Left Side) */
        .dispenser-visual-box {
            background: radial-gradient(circle at 50% 30%, #152238 0%, #0a1120 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-md);
            padding: 24px;
            height: 380px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow: hidden;
        }

        /* Spout & Ultrasonic sensor */
        .nozzle-housing {
            width: 140px;
            background: #1e293b;
            border: 2px solid #334155;
            border-radius: 12px;
            padding: 12px 16px;
            text-align: center;
            position: relative;
            z-index: 5;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        .sensor-eyes {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-bottom: 6px;
        }

        .eye {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #64748b;
            border: 3px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 800;
            color: #0f172a;
            font-family: 'JetBrains Mono', monospace;
        }

        .spout-pipe {
            width: 18px;
            height: 25px;
            background: #475569;
            margin: 0 auto;
            border-radius: 0 0 4px 4px;
            position: relative;
        }

        /* Water Stream Animation */
        .water-stream {
            position: absolute;
            top: 25px;
            left: 5px;
            width: 8px;
            height: 0;
            background: linear-gradient(180deg, #38bdf8, #0284c7);
            border-radius: 4px;
            box-shadow: 0 0 12px #38bdf8;
            transition: height 0.2s;
            z-index: 4;
        }

        .water-stream.flowing {
            height: 160px;
            animation: waterFlow 0.4s infinite alternate;
        }

        @keyframes waterFlow {
            0% { transform: scaleX(0.9); opacity: 0.9; }
            100% { transform: scaleX(1.1); opacity: 1; }
        }

        /* Distance wave pulses */
        .sonic-wave {
            position: absolute;
            top: 85px;
            width: 40px;
            height: 20px;
            border: 2px dashed rgba(45, 212, 191, 0.4);
            border-top: none;
            border-radius: 0 0 50px 50px;
            opacity: 0;
            pointer-events: none;
        }

        .sonic-wave.pulsing {
            animation: wavePulse 1s infinite linear;
        }

        @keyframes wavePulse {
            0% { transform: scale(0.5); opacity: 0.9; }
            100% { transform: translateY(80px) scale(2.2); opacity: 0; }
        }

        /* Glass Cup */
        .glass-cup-slot {
            position: absolute;
            bottom: 24px;
            width: 100px;
            height: 130px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: none;
            border-radius: 0 0 16px 16px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(4px);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            transition: all 0.3s;
        }

        .glass-cup-slot.present {
            border-color: #38bdf8;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.2);
            transform: translateY(0);
            opacity: 1;
        }

        .glass-cup-slot.absent {
            opacity: 0.2;
            transform: translateY(40px);
            pointer-events: none;
        }

        .cup-water-level {
            width: 100%;
            height: 0%;
            background: linear-gradient(180deg, rgba(56, 189, 248, 0.7), rgba(2, 132, 199, 0.9));
            transition: height 0.3s ease-out;
            position: relative;
        }

        .cup-water-level::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
        }

        .cup-volume-label {
            position: absolute;
            bottom: 6px;
            width: 100%;
            text-align: center;
            font-size: 0.72rem;
            font-weight: 800;
            font-family: 'JetBrains Mono', monospace;
            color: #fff;
            text-shadow: 0 1px 3px rgba(0,0,0,0.8);
        }

        /* 16x2 LCD Display */
        .lcd-display {
            background: var(--lcd-bg);
            border: 4px solid #064e3b;
            border-radius: 8px;
            padding: 14px 18px;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.8), 0 0 15px rgba(52, 211, 153, 0.2);
            font-family: 'JetBrains Mono', monospace;
            color: var(--lcd-text);
            margin-top: 18px;
        }

        .lcd-line {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 2px;
            height: 24px;
            text-shadow: 0 0 8px rgba(52, 211, 153, 0.7);
        }

        /* Controls Panel */
        .bench-controls {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .control-slider-group {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px;
        }

        .slider-header {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .distance-val {
            color: #2dd4bf;
            font-weight: 800;
            font-family: 'JetBrains Mono', monospace;
        }

        .range-slider {
            width: 100%;
            accent-color: #2dd4bf;
            cursor: pointer;
        }

        .action-btns-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .bench-btn {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--border);
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .bench-btn:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .bench-btn.btn-active {
            background: var(--arduino-teal);
            border-color: var(--arduino-teal);
        }

        /* Hardware Indicator Board (Right Side) */
        .components-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .comp-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .comp-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .comp-status-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.88rem;
            font-weight: 700;
        }

        .led-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #475569;
            box-shadow: none;
            transition: all 0.2s;
        }

        .led-indicator.led-on-green {
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
        }

        .led-indicator.led-on-red {
            background: #ef4444;
            box-shadow: 0 0 10px #ef4444;
        }

        .led-indicator.led-on-blue {
            background: #38bdf8;
            box-shadow: 0 0 10px #38bdf8;
        }

        /* Serial Monitor Console */
        .serial-console-wrap {
            background: #060b14;
            border: 1px solid rgba(0, 151, 156, 0.3);
            border-radius: 10px;
            padding: 16px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            height: 220px;
            overflow-y: auto;
            color: #94a3b8;
            display: flex;
            flex-direction: column-reverse;
        }

        .serial-line {
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .serial-line .ts {
            color: #64748b;
        }

        .serial-line .event {
            color: #38bdf8;
            font-weight: 700;
        }

        .serial-line .success {
            color: #34d399;
        }

        .serial-line .warn {
            color: #fbbf24;
        }

        /* Code Viewer Section */
        .code-container {
            display: none;
            background: #0f172a;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-top: 24px;
        }

        .code-container.show {
            display: block;
        }

        pre code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            color: #e2e8f0;
            line-height: 1.6;
        }

        .c-comment { color: #64748b; font-style: italic; }
        .c-preproc { color: #f43f5e; }
        .c-type { color: #38bdf8; font-weight: 700; }
        .c-func { color: #fbbf24; }
        .c-num { color: #a855f7; }
        .c-str { color: #34d399; }

        @media (max-width: 900px) {
            .workbench-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Top Portfolio Bar -->
    <header class="demo-top-bar">
        <div class="demo-brand-pill">
            <span class="demo-badge"><span class="pulse-dot"></span> HARDWARE &amp; IOT SIMULATOR</span>
            <span>Project: <strong>SmartDispense Arduino Water Dispenser</strong></span>
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

    <!-- Main Container -->
    <main class="sim-container">
        <!-- Simulator Header -->
        <div class="sim-header">
            <h1 class="sim-title">Smart<span>Dispense</span> IoT Simulator</h1>
            <p class="sim-desc">
                An interactive electronic bench and live C++ firmware simulation of the touchless automated water dispenser prototype developed by Jevy Toledo using Arduino Uno, HC-SR04 ultrasonic sensor, 5V relay, and 16x2 I2C LCD.
            </p>
        </div>

        <!-- Mode Switcher -->
        <div class="tab-switcher">
            <button class="mode-btn active" id="btn-workbench" onclick="switchView('workbench')">
                <span>⚡ Interactive Hardware Workbench</span>
            </button>
            <button class="mode-btn" id="btn-code" onclick="switchView('code')">
                <span>📄 Arduino C++ Firmware Code</span>
            </button>
        </div>

        <!-- WORKBENCH VIEW -->
        <div class="workbench-grid" id="workbench-view">
            <!-- Left: Dispenser Station Visual & Controls -->
            <div class="bench-card">
                <div class="card-header-row">
                    <h3 class="card-heading">
                        <span>🚰</span> Physical Dispenser Station
                    </h3>
                    <span class="status-chip" id="dispenser-mode-chip">SYSTEM STANDBY</span>
                </div>

                <!-- Dispenser Visual Graphic -->
                <div class="dispenser-visual-box">
                    <div class="nozzle-housing">
                        <div class="sensor-eyes">
                            <div class="eye" title="Transmitter">TX</div>
                            <div class="eye" title="Receiver">RX</div>
                        </div>
                        <div style="font-size: 0.65rem; color: #94a3b8; font-weight: 700;">HC-SR04 SENSOR</div>
                        <div class="spout-pipe">
                            <div class="water-stream" id="water-stream"></div>
                        </div>
                    </div>

                    <div class="sonic-wave pulsing" id="sonic-wave"></div>

                    <!-- Glass Cup -->
                    <div class="glass-cup-slot present" id="glass-cup">
                        <div class="cup-water-level" id="water-fill-level"></div>
                        <div class="cup-volume-label" id="cup-vol-label">0 ml</div>
                    </div>
                </div>

                <!-- 16x2 I2C LCD Display -->
                <div class="lcd-display">
                    <div class="lcd-line" id="lcd-line-1">SMART DISPENSE</div>
                    <div class="lcd-line" id="lcd-line-2">READY - PLACE CUP</div>
                </div>

                <!-- Interactive Sensor Slider & Placement Controls -->
                <div class="bench-controls">
                    <div class="control-slider-group">
                        <div class="slider-header">
                            <span>Simulated Distance to Sensor:</span>
                            <span class="distance-val" id="distance-readout">25.0 cm</span>
                        </div>
                        <input type="range" class="range-slider" id="distance-slider" min="2" max="30" value="25" step="0.5">
                        <div style="display: flex; justify-content: space-between; font-size: 0.72rem; color: #64748b; margin-top: 4px;">
                            <span>2cm (Close - Pour)</span>
                            <span style="color: #2dd4bf; font-weight: 700;">▲ 10cm Threshold</span>
                            <span>30cm (Far - Idle)</span>
                        </div>
                    </div>

                    <div class="action-btns-grid">
                        <button type="button" class="bench-btn" id="btn-place-glass" onclick="placeGlassAt(6)">
                            🥛 Place Glass (6cm)
                        </button>
                        <button type="button" class="bench-btn" id="btn-remove-glass" onclick="removeGlass()">
                            🚫 Remove Glass (25cm)
                        </button>
                        <button type="button" class="bench-btn" id="btn-empty-cup" onclick="emptyCup()">
                            🔄 Empty Cup
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right: Microcontroller Pin States & Serial Stream -->
            <div class="bench-card">
                <div class="card-header-row">
                    <h3 class="card-heading">
                        <span>📟</span> Hardware Pin States &amp; Serial Monitor
                    </h3>
                    <span class="status-chip" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border-color: rgba(56, 189, 248, 0.3);">
                        BAUD: 9600
                    </span>
                </div>

                <!-- Component Status Grid -->
                <div class="components-grid">
                    <div class="comp-card">
                        <div class="comp-title">Arduino Uno R3</div>
                        <div class="comp-status-row">
                            <span class="led-indicator led-on-green"></span>
                            <span>POWER 5V: ACTIVE</span>
                        </div>
                        <div class="comp-status-row">
                            <span class="led-indicator" id="pin13-led"></span>
                            <span style="font-size: 0.8rem; color: #94a3b8;">PIN 13 LED (FLOW)</span>
                        </div>
                    </div>

                    <div class="comp-card">
                        <div class="comp-title">5V Relay Module</div>
                        <div class="comp-status-row">
                            <span class="led-indicator" id="relay-led"></span>
                            <span id="relay-status-text">RELAY: OFF</span>
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b;">Pin 8: HIGH (Active LOW)</div>
                    </div>

                    <div class="comp-card">
                        <div class="comp-title">12V Submersible Pump</div>
                        <div class="comp-status-row">
                            <span class="led-indicator" id="pump-led"></span>
                            <span id="pump-status-text">PUMP: IDLE</span>
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b;">Flow Rate: 1.2 L/min</div>
                    </div>

                    <div class="comp-card">
                        <div class="comp-title">Safety Fail-Safe</div>
                        <div class="comp-status-row">
                            <span class="led-indicator led-on-green" id="safety-led"></span>
                            <span id="safety-status-text">LIMIT: 5.0s MAX</span>
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b;">Prevents cup overflow</div>
                    </div>
                </div>

                <!-- Real-time Serial Monitor -->
                <div style="font-size: 0.78rem; font-weight: 700; color: #94a3b8; margin-bottom: 6px; display: flex; justify-content: space-between;">
                    <span>LIVE SERIAL OUTPUT (COM4):</span>
                    <span style="color: #64748b; cursor: pointer;" onclick="clearSerial()">Clear Logs</span>
                </div>
                <div class="serial-console-wrap" id="serial-stream">
                    <!-- Logs stream here -->
                </div>
            </div>
        </div>

        <!-- CODE VIEW -->
        <div class="code-container" id="code-view">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h3 style="font-size: 1.2rem; font-weight: 800;">
                    SmartDispense.ino — Arduino C++ Firmware
                </h3>
                <span class="status-chip">C++ (ATmega328P)</span>
            </div>
            <pre><code><span class="c-comment">/**
 * SmartDispense: Automated Touchless Water Dispenser
 * Microcontroller: Arduino Uno R3
 * Author: Jevy B. Toledo
 * Hardware: HC-SR04, 5V Relay, 12V DC Pump, 16x2 I2C LCD
 */</span>

<span class="c-preproc">#include</span> <span class="c-str">&lt;Wire.h&gt;</span>
<span class="c-preproc">#include</span> <span class="c-str">&lt;LiquidCrystal_I2C.h&gt;</span>

<span class="c-comment">// Pin Definitions</span>
<span class="c-type">const int</span> TRIG_PIN  = <span class="c-num">9</span>;   <span class="c-comment">// HC-SR04 Trigger</span>
<span class="c-type">const int</span> ECHO_PIN  = <span class="c-num">10</span>;  <span class="c-comment">// HC-SR04 Echo</span>
<span class="c-type">const int</span> RELAY_PIN = <span class="c-num">8</span>;   <span class="c-comment">// 5V Relay IN (Active LOW)</span>
<span class="c-type">const int</span> FLOW_LED  = <span class="c-num">13</span>;  <span class="c-comment">// Status LED Indicator</span>

<span class="c-comment">// Constants</span>
<span class="c-type">const float</span> DISTANCE_THRESHOLD = <span class="c-num">10.0</span>; <span class="c-comment">// Detect cup within 10cm</span>
<span class="c-type">const unsigned long</span> MAX_POUR_TIME  = <span class="c-num">5000</span>; <span class="c-comment">// 5 second safety cutoff (~250ml)</span>

<span class="c-type">LiquidCrystal_I2C</span> <span class="c-func">lcd</span>(<span class="c-num">0x27</span>, <span class="c-num">16</span>, <span class="c-num">2</span>);

<span class="c-type">void</span> <span class="c-func">setup</span>() {
  <span class="c-func">Serial</span>.<span class="c-func">begin</span>(<span class="c-num">9600</span>);
  <span class="c-func">pinMode</span>(TRIG_PIN, OUTPUT);
  <span class="c-func">pinMode</span>(ECHO_PIN, INPUT);
  <span class="c-func">pinMode</span>(RELAY_PIN, OUTPUT);
  <span class="c-func">pinMode</span>(FLOW_LED, OUTPUT);

  <span class="c-comment">// Turn off relay initially (relay is Active-LOW)</span>
  <span class="c-func">digitalWrite</span>(RELAY_PIN, HIGH);
  <span class="c-func">digitalWrite</span>(FLOW_LED, LOW);

  <span class="c-comment">// Initialize I2C LCD</span>
  lcd.<span class="c-func">init</span>();
  lcd.<span class="c-func">backlight</span>();
  lcd.<span class="c-func">setCursor</span>(<span class="c-num">0</span>, <span class="c-num">0</span>);
  lcd.<span class="c-func">print</span>(<span class="c-str">"SMART DISPENSE"</span>);
  lcd.<span class="c-func">setCursor</span>(<span class="c-num">0</span>, <span class="c-num">1</span>);
  lcd.<span class="c-func">print</span>(<span class="c-str">"READY - PLACE CUP"</span>);

  <span class="c-func">Serial</span>.<span class="c-func">println</span>(<span class="c-str">"[BOOT] SmartDispense v1.0 Initialized."</span>);
}

<span class="c-type">void</span> <span class="c-func">loop</span>() {
  <span class="c-type">float</span> distance = <span class="c-func">readDistanceCM</span>();

  <span class="c-func">if</span> (distance &gt; <span class="c-num">0</span> &amp;&amp; distance &lt;= DISTANCE_THRESHOLD) {
    <span class="c-func">Serial</span>.<span class="c-func">print</span>(<span class="c-str">"[DETECT] Cup Detected at "</span>);
    <span class="c-func">Serial</span>.<span class="c-func">print</span>(distance);
    <span class="c-func">Serial</span>.<span class="c-func">println</span>(<span class="c-str">" cm. Starting Dispense..."</span>);

    <span class="c-func">dispenseWater</span>();
  } <span class="c-func">else</span> {
    <span class="c-func">delay</span>(<span class="c-num">100</span>);
  }
}

<span class="c-type">float</span> <span class="c-func">readDistanceCM</span>() {
  <span class="c-func">digitalWrite</span>(TRIG_PIN, LOW);
  <span class="c-func">delayMicroseconds</span>(<span class="c-num">2</span>);
  <span class="c-func">digitalWrite</span>(TRIG_PIN, HIGH);
  <span class="c-func">delayMicroseconds</span>(<span class="c-num">10</span>);
  <span class="c-func">digitalWrite</span>(TRIG_PIN, LOW);

  <span class="c-type">long</span> duration = <span class="c-func">pulseIn</span>(ECHO_PIN, HIGH, <span class="c-num">30000</span>);
  <span class="c-func">if</span> (duration == <span class="c-num">0</span>) <span class="c-func">return</span> <span class="c-num">999.0</span>;
  <span class="c-func">return</span> (duration * <span class="c-num">0.0343</span>) / <span class="c-num">2</span>;
}

<span class="c-type">void</span> <span class="c-func">dispenseWater</span>() {
  <span class="c-comment">// Update LCD</span>
  lcd.<span class="c-func">setCursor</span>(<span class="c-num">0</span>, <span class="c-num">1</span>);
  lcd.<span class="c-func">print</span>(<span class="c-str">"STATUS: POURING "</span>);

  <span class="c-comment">// Engage Relay and LED</span>
  <span class="c-func">digitalWrite</span>(RELAY_PIN, LOW);  <span class="c-comment">// Activate Pump</span>
  <span class="c-func">digitalWrite</span>(FLOW_LED, HIGH);

  <span class="c-type">unsigned long</span> startTime = <span class="c-func">millis</span>();

  <span class="c-comment">// Dispense loop with safety cutoff & cup presence check</span>
  <span class="c-func">while</span> (<span class="c-func">millis</span>() - startTime &lt; MAX_POUR_TIME) {
    <span class="c-type">float</span> currentDist = <span class="c-func">readDistanceCM</span>();
    <span class="c-func">if</span> (currentDist &gt; DISTANCE_THRESHOLD + <span class="c-num">3.0</span>) {
      <span class="c-func">Serial</span>.<span class="c-func">println</span>(<span class="c-str">"[ALERT] Cup removed early. Halting pump."</span>);
      <span class="c-func">break</span>;
    }
    <span class="c-func">delay</span>(<span class="c-num">100</span>);
  }

  <span class="c-comment">// Shut off pump</span>
  <span class="c-func">digitalWrite</span>(RELAY_PIN, HIGH);
  <span class="c-func">digitalWrite</span>(FLOW_LED, LOW);

  lcd.<span class="c-func">setCursor</span>(<span class="c-num">0</span>, <span class="c-num">1</span>);
  lcd.<span class="c-func">print</span>(<span class="c-str">"ENJOY YOUR WATER"</span>);
  <span class="c-func">delay</span>(<span class="c-num">1500</span>);

  lcd.<span class="c-func">setCursor</span>(<span class="c-num">0</span>, <span class="c-num">1</span>);
  lcd.<span class="c-func">print</span>(<span class="c-str">"READY - PLACE CUP"</span>);
}</code></pre>
        </div>
    </main>

    <script>
        // Simulation State
        let distance = 25.0;
        let isPouring = false;
        let cupVolume = 0; // max 250ml
        let pourTimer = null;
        let audioCtx = null;

        // Elements
        const distanceSlider = document.getElementById('distance-slider');
        const distanceReadout = document.getElementById('distance-readout');
        const waterStream = document.getElementById('water-stream');
        const waterFillLevel = document.getElementById('water-fill-level');
        const cupVolLabel = document.getElementById('cup-vol-label');
        const lcdLine1 = document.getElementById('lcd-line-1');
        const lcdLine2 = document.getElementById('lcd-line-2');
        const dispenserModeChip = document.getElementById('dispenser-mode-chip');
        const pin13Led = document.getElementById('pin13-led');
        const relayLed = document.getElementById('relay-led');
        const relayStatusText = document.getElementById('relay-status-text');
        const pumpLed = document.getElementById('pump-led');
        const pumpStatusText = document.getElementById('pump-status-text');
        const serialStream = document.getElementById('serial-stream');

        // Play synthetic relay mechanical click
        function playRelayClick(turnOn = true) {
            try {
                if (!audioCtx) {
                    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                }
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.type = turnOn ? 'square' : 'triangle';
                osc.frequency.setValueAtTime(turnOn ? 440 : 220, audioCtx.currentTime);
                gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.05);
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.05);
            } catch (e) {
                // Ignore audio restriction on unclicked gesture
            }
        }

        // Add Log to Serial Monitor
        function logSerial(msg, type = 'normal') {
            const line = document.createElement('div');
            line.className = 'serial-line';
            const time = new Date().toTimeString().split(' ')[0] + '.' + Math.floor(Math.random() * 900 + 100);
            
            let typeClass = '';
            if (type === 'event') typeClass = 'event';
            if (type === 'success') typeClass = 'success';
            if (type === 'warn') typeClass = 'warn';

            line.innerHTML = `<span class="ts">[${time}]</span> <span class="${typeClass}">${msg}</span>`;
            serialStream.prepend(line);
        }

        function clearSerial() {
            serialStream.innerHTML = '';
            logSerial('Serial monitor cleared at 9600 baud.', 'normal');
        }

        // Distance Slider Listener
        distanceSlider.addEventListener('input', (e) => {
            distance = parseFloat(e.target.value);
            updateHardware();
        });

        function placeGlassAt(d = 6.0) {
            distanceSlider.value = d;
            distance = d;
            document.getElementById('glass-cup').classList.remove('absent');
            document.getElementById('glass-cup').classList.add('present');
            logSerial(`Manual event: Cup placed at ${d} cm`, 'event');
            updateHardware();
        }

        function removeGlass() {
            distanceSlider.value = 25.0;
            distance = 25.0;
            document.getElementById('glass-cup').classList.remove('present');
            document.getElementById('glass-cup').classList.add('absent');
            logSerial('Manual event: Cup removed (>25 cm)', 'warn');
            updateHardware();
        }

        function emptyCup() {
            cupVolume = 0;
            waterFillLevel.style.height = '0%';
            cupVolLabel.textContent = '0 ml';
            logSerial('Cup emptied. Ready for next dispense cycle.', 'normal');
            updateHardware();
        }

        function updateHardware() {
            distanceReadout.textContent = `${distance.toFixed(1)} cm`;

            // Threshold: distance <= 10.0cm
            if (distance <= 10.0 && cupVolume < 250) {
                if (!isPouring) {
                    startPouring();
                }
            } else {
                if (isPouring) {
                    stopPouring();
                }
                if (cupVolume >= 250) {
                    lcdLine1.textContent = 'CUP IS FULL!';
                    lcdLine2.textContent = 'PLEASE TAKE CUP';
                    dispenserModeChip.textContent = 'CUP FULL (250ml)';
                    dispenserModeChip.style.background = 'rgba(245, 158, 11, 0.2)';
                    dispenserModeChip.style.color = '#fbbf24';
                } else {
                    lcdLine1.textContent = 'SMART DISPENSE';
                    lcdLine2.textContent = 'READY - PLACE CUP';
                    dispenserModeChip.textContent = 'SYSTEM STANDBY';
                    dispenserModeChip.style.background = 'rgba(16, 185, 129, 0.15)';
                    dispenserModeChip.style.color = '#34d399';
                }
            }
        }

        function startPouring() {
            isPouring = true;
            playRelayClick(true);

            // Hardware states
            waterStream.classList.add('flowing');
            pin13Led.className = 'led-indicator led-on-blue';
            relayLed.className = 'led-indicator led-on-green';
            pumpLed.className = 'led-indicator led-on-blue';
            relayStatusText.textContent = 'RELAY: ON (Active LOW)';
            pumpStatusText.textContent = 'PUMP: RUNNING';

            dispenserModeChip.textContent = 'DISPENSING WATER...';
            dispenserModeChip.style.background = 'rgba(56, 189, 248, 0.2)';
            dispenserModeChip.style.color = '#38bdf8';

            lcdLine1.textContent = `DIST: ${distance.toFixed(1)}cm [OK]`;
            lcdLine2.textContent = 'STATUS: POURING...';

            logSerial(`[TRIGGER] Distance ${distance.toFixed(1)}cm <= 10.0cm. Relay Pin 8 -> LOW`, 'event');
            logSerial(`[PUMP] 12V DC Pump engaged. Dispensing clean water...`, 'normal');

            // Fill loop (fills 250ml over ~4.5 seconds)
            pourTimer = setInterval(() => {
                cupVolume += 15;
                if (cupVolume > 250) cupVolume = 250;

                const percent = (cupVolume / 250) * 100;
                waterFillLevel.style.height = `${percent}%`;
                cupVolLabel.textContent = `${cupVolume} ml`;

                lcdLine2.textContent = `POURING: ${cupVolume}ml/250ml`;

                if (cupVolume >= 250) {
                    stopPouring();
                    logSerial(`[AUTO-STOP] Target 250ml portion reached. Shutting off pump.`, 'success');
                    playRelayClick(false);
                    updateHardware();
                }
            }, 250);
        }

        function stopPouring() {
            isPouring = false;
            clearInterval(pourTimer);
            playRelayClick(false);

            waterStream.classList.remove('flowing');
            pin13Led.className = 'led-indicator';
            relayLed.className = 'led-indicator';
            pumpLed.className = 'led-indicator';
            relayStatusText.textContent = 'RELAY: OFF';
            pumpStatusText.textContent = 'PUMP: IDLE';
        }

        function switchView(view) {
            const benchView = document.getElementById('workbench-view');
            const codeView = document.getElementById('code-view');
            const btnBench = document.getElementById('btn-workbench');
            const btnCode = document.getElementById('btn-code');

            if (view === 'workbench') {
                benchView.style.display = 'grid';
                codeView.classList.remove('show');
                btnBench.classList.add('active');
                btnCode.classList.remove('active');
            } else {
                benchView.style.display = 'none';
                codeView.classList.add('show');
                btnBench.classList.remove('active');
                btnCode.classList.add('active');
            }
        }

        // Initialize boot log
        window.addEventListener('DOMContentLoaded', () => {
            logSerial('[BOOT] ATmega328P initial boot sequence completed.', 'success');
            logSerial('[INIT] HC-SR04 ultrasonic echo pin 10, trig pin 9 configured.', 'normal');
            logSerial('[INIT] 5V Relay active-LOW pin 8 set to HIGH (OFF).', 'normal');
            logSerial('[INIT] 16x2 I2C LCD initialized at address 0x27.', 'normal');
            logSerial('[READY] Scanning for cups under spout (Threshold: <= 10.0cm)...', 'success');
        });
    </script>
</body>
</html>
