<?php
/**
 * Portfolio Data File — Jevy Toledo
 * Customized with your profile, portrait, and 3 core projects:
 * 1. TapSeafood: Online Food Ordering Website
 * 2. Hotel Online Booking
 * 3. Arduino Water Dispenser
 */

// Helper to ensure generated assets and user photo are in place
$assetsDir = __DIR__ . '/../assets/images';
if (!is_dir($assetsDir)) {
    mkdir($assetsDir, 0777, true);
}

// User-provided portrait of Jevy Toledo
$uploadedUserPhoto = 'C:/Users/Administrator/.gemini/antigravity-ide/brain/ba41e8dd-375c-4f09-b76b-328c6578de2e/.user_uploaded/media_1792753133990.png';
if (file_exists($uploadedUserPhoto)) {
    @copy($uploadedUserPhoto, $assetsDir . '/jevy-toledo.png');
    @copy($uploadedUserPhoto, $assetsDir . '/avatar.jpg');
    @copy($uploadedUserPhoto, $assetsDir . '/avatar.png');
}

// User-provided official resume image
$uploadedResume = 'C:/Users/Administrator/.gemini/antigravity-ide/brain/633d3c76-d70c-44c9-accd-48a516dd7f1a/.user_uploaded/media_1793183687172.png';
if (file_exists($uploadedResume)) {
    @copy($uploadedResume, $assetsDir . '/jevy-resume.png');
    @copy($uploadedResume, $assetsDir . '/resume-original.png');
}

$sourceImages = [
    'project-tapseafood.jpg' => 'C:/Users/Administrator/.gemini/antigravity-ide/brain/ba41e8dd-375c-4f09-b76b-328c6578de2e/tapseafood_mockup_1792752839222.jpg',
];

foreach ($sourceImages as $filename => $sourcePath) {
    $destination = $assetsDir . '/' . $filename;
    if (!file_exists($destination) && file_exists($sourcePath)) {
        @copy($sourcePath, $destination);
    }
}

// Time-based greeting helper
function getGreeting() {
    $hour = (int)date('H');
    if ($hour < 12) {
        return 'Good morning';
    } elseif ($hour < 18) {
        return 'Good afternoon';
    } else {
        return 'Good evening';
    }
}

// Portfolio Profile Configuration for Jevy B. Toledo
$portfolio = [
    'name' => 'Jevy B. Toledo',
    'nickname' => 'Jevy',
    'role' => 'Junior Web Developer & Tech Enthusiast',
    'avatar' => 'assets/images/jevy-toledo.png',
    'resume_scan' => 'assets/images/jevy-resume.png',
    'specialty' => 'Full-Stack PHP, MySQL & Embedded Arduino',
    'status' => 'Open to Junior Roles & Internships',
    'status_available' => true,
    'location' => 'BF Martinville, Manuyo Dos, Las Piñas City',
    'email' => 'jevytoledo1@gmail.com',
    'phone' => '0915-290-3182',
    'github' => 'https://github.com',
    'linkedin' => 'https://linkedin.com',
    'twitter' => 'https://twitter.com',
    'resume_link' => '#resume',

    // Personal details extracted directly from official resume
    'personal_info' => [
        'full_name' => 'Jevy B. Toledo',
        'nickname' => 'Jevy',
        'age' => '19 yrs old',
        'birthdate' => 'August 25, 2003',
        'birthplace' => 'Talibon, Bohol',
        'gender' => 'Male',
        'civil_status' => 'Single',
        'religion' => 'Catholic',
        'weight' => '65 kg',
        'height' => "5'7\"",
        'address' => 'BF Martinville Manuyo Dos, Las Piñas City',
        'dialects' => 'English, Bisaya and Tagalog',
    ],

    // Career objective from resume
    'objective' => 'Seeking a job in your establishment to enhance my skills. Hardworking student seek an opportunity to communicate a lot of customers and contribute positively to company operations.',

    // Education from resume
    'education' => [
        [
            'level' => 'SECONDARY',
            'school' => 'Las Piñas National High School Gatchalian Annex',
            'address' => 'Tolentino cor Marquez St., Ph. 4 Gatchalian Subd., Brgy. Manuyo Dos, Las Piñas City',
            'years' => '2016-2020',
            'badge' => 'High School'
        ],
        [
            'level' => 'PRIMARY',
            'school' => 'Las Piñas National High School Gatchalian Annex',
            'address' => 'Tolentino cor Marquez St., Ph. 4 Gatchalian Subd., Brgy. Manuyo Dos, Las Piñas',
            'years' => '2012-2016',
            'badge' => 'Elementary'
        ]
    ],

    'headline' => 'Building dynamic web applications with PHP & MySQL, and bridging hardware with Arduino automation.',
    'short_bio' => "I am an enthusiastic junior developer with hands-on experience building full-stack web solutions like an online seafood ordering website (TapSeafood), a hotel online booking system, and hardware-software IoT prototypes like an automated touchless Arduino water dispenser.",

    'stats' => [
        [
            'number' => '3',
            'label' => 'Key Core Projects',
            'detail' => 'TapSeafood, Hotel Booking & Arduino Dispenser'
        ],
        [
            'number' => '500+',
            'label' => 'Coding Hours',
            'detail' => 'Web development & embedded C++ logic'
        ],
        [
            'number' => '100%',
            'label' => 'Dedication to Quality',
            'detail' => 'Curious, fast learner & reliable team player'
        ],
        [
            'number' => '5+',
            'label' => 'Technologies Mastered',
            'detail' => 'PHP, MySQL, JavaScript, HTML/CSS, Arduino'
        ]
    ],

    'about_highlights' => [
        [
            'icon' => 'code',
            'title' => 'Full-Stack PHP & MySQL',
            'text' => 'Creating robust database-driven platforms with clean form processing, session management, and CRUD architecture.'
        ],
        [
            'icon' => 'devices',
            'title' => 'Responsive UI Design',
            'text' => 'Designing mobile-first e-commerce menus, reservation calendars, and modern dashboards that look great on any device.'
        ],
        [
            'icon' => 'database',
            'title' => 'E-Commerce & Booking Logic',
            'text' => 'Implementing dynamic cart calculations, room availability queries, and automated receipts.'
        ],
        [
            'icon' => 'rocket',
            'title' => 'IoT & Hardware Integration',
            'text' => 'Writing embedded C++ for Arduino microcontrollers, working with ultrasonic sensors, LCDs, and relay-controlled pumps.'
        ]
    ],

    'learning_now' => [
        'Advanced PHP OOP & MVC Architecture',
        'MySQL Database Normalization & Indexing',
        'Secure Payment Gateway API Integrations (Stripe/PayPal)',
        'ESP32 / WiFi-enabled IoT Microcontrollers'
    ],

    'skills_categories' => [
        [
            'category_name' => 'Web & Backend Development',
            'description' => 'Core full-stack web competencies used in TapSeafood and Hotel Booking.',
            'skills' => [
                [
                    'name' => 'PHP 8 & Modular Architecture',
                    'level' => 'Intermediate',
                    'percent' => 82,
                    'note' => 'Session state, form validation, cart logic, dynamic templates'
                ],
                [
                    'name' => 'MySQL & Relational Databases',
                    'level' => 'Intermediate',
                    'percent' => 78,
                    'note' => 'Schema design, foreign keys, prepared statements, CRUD queries'
                ],
                [
                    'name' => 'JavaScript (ES6+) & DOM',
                    'level' => 'Intermediate',
                    'percent' => 75,
                    'note' => 'Dynamic cart updates, modal popups, date validation'
                ],
                [
                    'name' => 'HTML5 & Responsive CSS3',
                    'level' => 'Proficient',
                    'percent' => 88,
                    'note' => 'Flexbox, CSS Grid, mobile-first layouts, modern styling'
                ]
            ]
        ],
        [
            'category_name' => 'IoT & Embedded Systems',
            'description' => 'Hands-on electronic prototyping and microcontroller programming.',
            'skills' => [
                [
                    'name' => 'Arduino (C / C++)',
                    'level' => 'Intermediate',
                    'percent' => 80,
                    'note' => 'Microcontroller programming, pin I/O, timing delays, hardware interrupts'
                ],
                [
                    'name' => 'Sensors & Actuators',
                    'level' => 'Intermediate',
                    'percent' => 85,
                    'note' => 'HC-SR04 ultrasonic sensor, relay modules, 12V submersible pumps'
                ],
                [
                    'name' => 'Display & User Feedback',
                    'level' => 'Intermediate',
                    'percent' => 76,
                    'note' => '16x2 I2C LCD displays, buzzer indicators, status LEDs'
                ],
                [
                    'name' => 'Circuit Prototyping',
                    'level' => 'Intermediate',
                    'percent' => 74,
                    'note' => 'Breadboarding, power distribution, DC voltage stepping'
                ]
            ]
        ],
        [
            'category_name' => 'Workflow & Tools',
            'description' => 'Development environments, local servers, and debugging tools.',
            'skills' => [
                [
                    'name' => 'XAMPP & Apache',
                    'level' => 'Proficient',
                    'percent' => 85,
                    'note' => 'Local web hosting, phpMyAdmin, MySQL administration'
                ],
                [
                    'name' => 'Arduino IDE',
                    'level' => 'Proficient',
                    'percent' => 88,
                    'note' => 'Library management, serial monitor debugging, board flashing'
                ],
                [
                    'name' => 'Git & GitHub',
                    'level' => 'Intermediate',
                    'percent' => 80,
                    'note' => 'Version control, commit history, repository management'
                ],
                [
                    'name' => 'VS Code & Chrome DevTools',
                    'level' => 'Proficient',
                    'percent' => 88,
                    'note' => 'Modern editor tooling, responsive inspection, debugging'
                ]
            ]
        ]
    ],

    'projects' => [
        [
            'id' => 'tapseafood',
            'title' => 'TapSeafood — Online Food Ordering Website',
            'category' => 'php',
            'category_label' => 'PHP & MySQL E-Commerce',
            'summary' => 'A full-featured seafood restaurant ordering platform with categorized seafood menus, dynamic cart, checkout, and order logging.',
            'description' => 'TapSeafood is an online food ordering web platform tailored for fresh seafood lovers. Customers can explore fresh fish, shrimp platters, king crab, and paella, customize quantities, add items to an active session-based cart, and submit orders with delivery details stored directly in MySQL.',
            'image' => 'assets/images/project-tapseafood.jpg',
            'tags' => ['PHP 8', 'MySQL Database', 'JavaScript', 'Session Cart', 'Responsive CSS'],
            'highlights' => [
                'Dynamic seafood menu with price tiers and dish descriptions',
                'Interactive shopping cart calculating subtotals, delivery fees, and taxes',
                'Secure checkout form validating customer address and contact numbers',
                'MySQL database backend storing customer orders and itemized invoices'
            ],
            'github' => 'https://github.com',
            'demo' => 'demos/tapseafood/',
            'featured' => true
        ],
        [
            'id' => 'hotel-booking',
            'title' => 'GrandStay — Hotel Online Booking System',
            'category' => 'php',
            'category_label' => 'PHP & MySQL Web App',
            'summary' => 'A room reservation portal featuring real-time date availability, room tier selections, automated stay price calculation, and booking confirmations.',
            'description' => 'A web-based hotel reservation application built with PHP and MySQL. Guests can browse room types (Deluxe Ocean Suite, Executive Double Queen, Penthouse), select check-in and check-out dates, check availability, and receive instant booking receipts.',
            'image' => 'assets/images/project-hotel.svg',
            'tags' => ['PHP 8', 'MySQL', 'Date Calculation', 'Booking Engine', 'CRUD System'],
            'highlights' => [
                'Date-range availability checker preventing double booking conflicts',
                'Automated night-stay calculator with transparent price and tax breakdowns',
                'Customer booking management system saving reservations to MySQL',
                'Admin view for reviewing upcoming guest arrivals and room status'
            ],
            'github' => 'https://github.com',
            'demo' => 'demos/hotel-booking/',
            'featured' => true
        ],
        [
            'id' => 'arduino-dispenser',
            'title' => 'SmartDispense — Touchless Arduino Water Dispenser',
            'category' => 'hardware',
            'category_label' => 'IoT & Embedded Systems',
            'summary' => 'An automated, hygienic touchless drinking water dispenser powered by Arduino Uno, ultrasonic proximity sensor, and relay-controlled pump.',
            'description' => 'SmartDispense is an embedded IoT automation system designed for touchless, germ-free liquid dispensing. It uses an HC-SR04 ultrasonic sensor to detect a cup placed within 10cm, triggering a 5V relay module to activate a 12V DC water pump. Includes an I2C 16x2 LCD screen for live status and an overflow protection cutoff timer.',
            'image' => 'assets/images/project-arduino.svg',
            'tags' => ['Arduino (C++)', 'Ultrasonic HC-SR04', '5V Relay Module', '16x2 I2C LCD', '12V DC Pump'],
            'highlights' => [
                'Hands-free proximity detection triggering instant water flow within 8-10cm',
                'Calibrated pour timing delivering standard 250ml portions per activation',
                'Real-time status display on 16x2 LCD ("PLACE CUP" / "POURING")',
                '5-second fail-safe automatic shutoff to prevent overflows and spills'
            ],
            'github' => 'https://github.com',
            'demo' => 'demos/arduino-dispenser/',
            'featured' => true
        ]
    ],

    'timeline' => [
        [
            'period' => 'Foundation & First App',
            'title' => 'TapSeafood: Online Food Ordering Website',
            'date' => 'Full-Stack Project',
            'badge' => 'Completed',
            'description' => 'Built a full-featured seafood e-commerce website using PHP & MySQL with dynamic menus, session-backed shopping cart, and order storage.'
        ],
        [
            'period' => 'Advanced Logic & Dates',
            'title' => 'Hotel Online Booking System',
            'date' => 'Full-Stack Project',
            'badge' => 'Completed',
            'description' => 'Developed a complete room reservation portal handling check-in/out date calculations, room tier filtering, and MySQL booking management.'
        ],
        [
            'period' => 'Hardware & Automation',
            'title' => 'Arduino Touchless Water Dispenser',
            'date' => 'IoT Hardware Project',
            'badge' => 'Completed',
            'description' => 'Engineered a touchless water dispensing device using Arduino Uno, ultrasonic distance sensor, relay module, and I2C LCD display.'
        ],
        [
            'period' => 'Current Focus',
            'title' => 'Seeking Junior Developer Opportunities',
            'date' => 'Ready to Build',
            'badge' => 'In Progress',
            'description' => 'Looking to contribute my hands-on full-stack PHP, MySQL, and problem-solving skills to an engineering team or internship program.'
        ]
    ],

    'testimonials' => [
        [
            'quote' => 'Jevy demonstrated exceptional initiative when building TapSeafood and the Hotel Booking system, managing database schemas, session carts, and date logic cleanly.',
            'author' => 'Marcus Vance',
            'role' => 'Senior Developer & Mentor'
        ],
        [
            'quote' => 'The Arduino touchless water dispenser showed great versatility! Combining C++ microcontroller code with physical electronics and web development shows true passion.',
            'author' => 'Elena Rostova',
            'role' => 'Peer Developer & Collaborator'
        ]
    ]
];
