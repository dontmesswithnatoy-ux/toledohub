-- ==========================================================
-- Database Schema for Junior Web Developer Portfolio
-- Compatible with MySQL / MariaDB (XAMPP default)
-- ==========================================================

-- 1. Create Database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `portfolio_db` 
    DEFAULT CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE `portfolio_db`;

-- 2. Table: users (Login & Register authentication)
CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `full_name`  VARCHAR(150)  NOT NULL,
    `username`   VARCHAR(30)   NOT NULL UNIQUE,
    `email`      VARCHAR(150)  NOT NULL UNIQUE,
    `password`   VARCHAR(255)  NOT NULL COMMENT 'bcrypt hash',
    `last_login` DATETIME      DEFAULT NULL,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Table: messages (Contact form inquiries)
CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `subject` VARCHAR(200) DEFAULT 'Portfolio Inquiry',
    `interest` VARCHAR(100) DEFAULT 'General Inquiry',
    `message` TEXT NOT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Table: projects
CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `project_slug` VARCHAR(50) NOT NULL UNIQUE,
    `title` VARCHAR(150) NOT NULL,
    `category` VARCHAR(50) NOT NULL,
    `category_label` VARCHAR(100) NOT NULL,
    `summary` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `image_path` VARCHAR(255) NOT NULL,
    `tags` VARCHAR(255) NOT NULL,
    `github_url` VARCHAR(255) DEFAULT 'https://github.com',
    `demo_url` VARCHAR(255) DEFAULT '#',
    `is_featured` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Table: skills
CREATE TABLE IF NOT EXISTS `skills` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(100) NOT NULL,
    `skill_name` VARCHAR(100) NOT NULL,
    `proficiency_level` VARCHAR(50) NOT NULL,
    `percentage` INT NOT NULL,
    `notes` VARCHAR(255) DEFAULT NULL,
    `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Table: testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `author` VARCHAR(100) NOT NULL,
    `role` VARCHAR(100) NOT NULL,
    `quote` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================================
-- Initial Seed Data for User's Core Projects
-- ==========================================================

-- Clean old sample projects and insert user's 3 real projects
INSERT INTO `projects` (`project_slug`, `title`, `category`, `category_label`, `summary`, `description`, `image_path`, `tags`, `github_url`, `demo_url`, `is_featured`, `sort_order`) 
VALUES
(
    'tapseafood',
    'TapSeafood — Online Food Ordering Website',
    'php',
    'PHP & MySQL E-Commerce',
    'A full-featured seafood restaurant ordering platform with categorized seafood menus, dynamic cart, checkout, and order logging.',
    'TapSeafood is an online food ordering web platform tailored for fresh seafood lovers. Customers can explore fresh fish, shrimp platters, king crab, and paella, customize quantities, add items to an active session-based cart, and submit orders with delivery details stored directly in MySQL.',
    'assets/images/project-tapseafood.jpg',
    'PHP 8, MySQL Database, JavaScript, Session Cart, Responsive CSS',
    'https://github.com',
    '#',
    1,
    1
),
(
    'hotel-booking',
    'GrandStay — Hotel Online Booking System',
    'php',
    'PHP & MySQL Web App',
    'A room reservation portal featuring real-time date availability, room tier selections, automated stay price calculation, and booking confirmations.',
    'A web-based hotel reservation application built with PHP and MySQL. Guests can browse room types (Deluxe Ocean Suite, Executive Double Queen, Penthouse), select check-in and check-out dates, check availability, and receive instant booking receipts.',
    'assets/images/project-hotel.svg',
    'PHP 8, MySQL, Date Calculation, Booking Engine, CRUD System',
    'https://github.com',
    '#',
    1,
    2
),
(
    'arduino-dispenser',
    'SmartDispense — Touchless Arduino Water Dispenser',
    'hardware',
    'IoT & Embedded Systems',
    'An automated, hygienic touchless drinking water dispenser powered by Arduino Uno, ultrasonic proximity sensor, and relay-controlled pump.',
    'SmartDispense is an embedded IoT automation system designed for touchless, germ-free liquid dispensing. It uses an HC-SR04 ultrasonic sensor to detect a cup placed within 10cm, triggering a 5V relay module to activate a 12V DC water pump. Includes an I2C 16x2 LCD screen for live status and an overflow protection cutoff timer.',
    'assets/images/project-arduino.svg',
    'Arduino (C++), Ultrasonic HC-SR04, 5V Relay Module, 16x2 I2C LCD, 12V DC Pump',
    'https://github.com',
    '#',
    1,
    3
)
ON DUPLICATE KEY UPDATE 
    `title` = VALUES(`title`),
    `category` = VALUES(`category`),
    `category_label` = VALUES(`category_label`),
    `summary` = VALUES(`summary`),
    `description` = VALUES(`description`),
    `image_path` = VALUES(`image_path`),
    `tags` = VALUES(`tags`);

-- Skills Seed Data
INSERT INTO `skills` (`category_name`, `skill_name`, `proficiency_level`, `percentage`, `notes`, `sort_order`) 
VALUES
('Web & Backend Development', 'PHP 8 & Modular Architecture', 'Intermediate', 82, 'Session state, form validation, cart logic, dynamic templates', 1),
('Web & Backend Development', 'MySQL & Relational Databases', 'Intermediate', 78, 'Schema design, foreign keys, prepared statements, CRUD queries', 2),
('Web & Backend Development', 'JavaScript (ES6+) & DOM', 'Intermediate', 75, 'Dynamic cart updates, modal popups, date validation', 3),
('Web & Backend Development', 'HTML5 & Responsive CSS3', 'Proficient', 88, 'Flexbox, CSS Grid, mobile-first layouts, modern styling', 4),

('IoT & Embedded Systems', 'Arduino (C / C++)', 'Intermediate', 80, 'Microcontroller programming, pin I/O, timing delays, hardware interrupts', 5),
('IoT & Embedded Systems', 'Sensors & Actuators', 'Intermediate', 85, 'HC-SR04 ultrasonic sensor, relay modules, 12V submersible pumps', 6),
('IoT & Embedded Systems', 'Display & User Feedback', 'Intermediate', 76, '16x2 I2C LCD displays, buzzer indicators, status LEDs', 7),
('IoT & Embedded Systems', 'Circuit Prototyping', 'Intermediate', 74, 'Breadboarding, power distribution, DC voltage stepping', 8),

('Workflow & Tools', 'XAMPP & Apache', 'Proficient', 85, 'Local web hosting, phpMyAdmin, MySQL administration', 9),
('Workflow & Tools', 'Arduino IDE', 'Proficient', 88, 'Library management, serial monitor debugging, board flashing', 10),
('Workflow & Tools', 'Git & GitHub', 'Intermediate', 80, 'Version control, commit history, repository management', 11),
('Workflow & Tools', 'VS Code & Chrome DevTools', 'Proficient', 88, 'Modern editor tooling, responsive inspection, debugging', 12);

-- Testimonials Seed Data
INSERT INTO `testimonials` (`author`, `role`, `quote`)
VALUES
('Marcus Vance', 'Senior Developer & Mentor', 'Jevy demonstrated exceptional initiative when building TapSeafood and the Hotel Booking system, managing database schemas, session carts, and date logic cleanly.'),
('Elena Rostova', 'Peer Developer & Collaborator', 'The Arduino touchless water dispenser showed great versatility! Combining C++ microcontroller code with physical electronics and web development shows true passion.');
