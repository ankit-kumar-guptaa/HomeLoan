<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$name = $_POST['firstName'] . ' ' . $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Simple email (you can add PHPMailer later)
$to = 'admin@elitecorporate.com';
$subject = 'New Contact Form Submission';
$body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

$sent = mail($to, $subject, $body);

echo json_encode([
    'success' => true,
    'message' => 'Thank you! We will contact you soon.'
]);
?>
