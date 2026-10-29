<?php
/**
 * Contact Form Handler
 * Validates, sanitizes, and records inquiries.
 * Integrates with MySQL via db_config.php with automatic JSON fallback.
 */

session_start();
require_once __DIR__ . '/db_config.php';

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
          (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) ||
          isset($_POST['ajax']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($isAjax) {
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
        exit;
    }
    header('Location: index.php');
    exit;
}

// Honeypot anti-spam check
if (!empty($_POST['website_hp'])) {
    // Silent fail for bots
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Thank you for reaching out!']);
        exit;
    }
    $_SESSION['flash_message'] = [
        'type' => 'success',
        'text' => 'Thank you for reaching out! Your message has been received.'
    ];
    header('Location: index.php#contact');
    exit;
}

// Retrieve and sanitize fields
$name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$email = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
$subject = isset($_POST['subject']) ? trim(strip_tags($_POST['subject'])) : 'Portfolio Inquiry';
$interest = isset($_POST['interest']) ? trim(strip_tags($_POST['interest'])) : 'General Inquiry';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

$errors = [];

if (empty($name) || mb_strlen($name) < 2) {
    $errors['name'] = 'Please enter your name (at least 2 characters).';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (empty($message) || mb_strlen($message) < 10) {
    $errors['message'] = 'Please enter a message of at least 10 characters.';
}

if (!empty($errors)) {
    if ($isAjax) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Please correct the highlighted fields.',
            'errors' => $errors
        ]);
        exit;
    }

    $_SESSION['flash_errors'] = $errors;
    $_SESSION['flash_old'] = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'interest' => $interest,
        'message' => $message
    ];
    $_SESSION['flash_message'] = [
        'type' => 'error',
        'text' => 'There were problems with your submission. Please check the form errors below.'
    ];
    header('Location: index.php#contact');
    exit;
}

// 1. Save to MySQL Database if connected
$savedToDb = false;
if (function_exists('saveContactMessage')) {
    $savedToDb = saveContactMessage([
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'interest' => $interest,
        'message' => $message,
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
    ]);
}

// 2. Also save to JSON file as dual-backup
$messagesFile = __DIR__ . '/data/messages.json';
$messages = [];

if (file_exists($messagesFile)) {
    $content = @file_get_contents($messagesFile);
    if ($content) {
        $messages = json_decode($content, true) ?: [];
    }
}

$newMessage = [
    'id' => uniqid('msg_'),
    'date' => date('Y-m-d H:i:s'),
    'name' => htmlspecialchars($name),
    'email' => htmlspecialchars($email),
    'subject' => htmlspecialchars($subject),
    'interest' => htmlspecialchars($interest),
    'message' => htmlspecialchars($message),
    'saved_to_db' => $savedToDb,
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
];

array_unshift($messages, $newMessage);
$messages = array_slice($messages, 0, 50);

@file_put_contents($messagesFile, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Thank you, ' . htmlspecialchars($name) . '! Your message was received successfully. I will get back to you soon!',
        'timestamp' => date('M j, Y, g:i a'),
        'db_saved' => $savedToDb
    ]);
    exit;
}

$_SESSION['flash_message'] = [
    'type' => 'success',
    'text' => 'Thank you, ' . htmlspecialchars($name) . '! Your message was sent successfully. I will get back to you soon!'
];

header('Location: index.php#contact');
exit;
