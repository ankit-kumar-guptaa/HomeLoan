<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$applicationId = 'ECS' . date('Y') . rand(10000, 99999);

// Simple email
$to = 'admin@elitecorporate.com';
$subject = 'New Loan Application - ' . $applicationId;
$body = "Application ID: $applicationId\n";
$body .= "Name: " . $_POST['firstName'] . " " . $_POST['lastName'] . "\n";
$body .= "Email: " . $_POST['email'] . "\n";
$body .= "Phone: " . $_POST['phone'] . "\n";
$body .= "Loan Amount: ₹" . number_format($_POST['loanAmount']) . "\n";

mail($to, $subject, $body);

echo json_encode([
    'success' => true,
    'message' => 'Application submitted successfully!',
    'applicationId' => $applicationId
]);
?>
