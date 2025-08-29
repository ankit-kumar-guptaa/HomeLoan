<?php
header('Content-Type: application/json');
require_once '../includes/config.php';
require_once '../includes/mail-config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Rate limiting
    if (!checkRateLimit('newsletter_' . $_SERVER['REMOTE_ADDR'], 5, 3600)) {
        echo json_encode(['success' => false, 'message' => 'Too many requests. Please try again later.']);
        exit;
    }
    
    // Validate and sanitize input
    $email = trim($_POST['email'] ?? '');
    $firstName = trim($_POST['firstName'] ?? '');
    
    // Validation
    if (empty($email) || !isValidEmail($email)) {
        echo json_encode(['success' => false, 'message' => 'Valid email is required']);
        exit;
    }
    
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id, status FROM newsletter_subscriptions WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        if ($existing['status'] === 'active') {
            echo json_encode(['success' => false, 'message' => 'You are already subscribed to our newsletter']);
            exit;
        } else {
            // Reactivate subscription
            $stmt = $pdo->prepare("UPDATE newsletter_subscriptions SET status = 'active', first_name = ?, subscribed_at = NOW(), unsubscribed_at = NULL WHERE email = ?");
            $stmt->execute([$firstName, $email]);
        }
    } else {
        // New subscription
        $stmt = $pdo->prepare("
            INSERT INTO newsletter_subscriptions (email, first_name, ip_address, user_agent, subscribed_at) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $email, 
            $firstName, 
            $_SERVER['REMOTE_ADDR'], 
            $_SERVER['HTTP_USER_AGENT']
        ]);
    }
    
    // Send confirmation email
    $emailSent = sendNewsletterConfirmation($email, $firstName);
    
    echo json_encode([
        'success' => true,
        'message' => 'Successfully subscribed! Check your email for confirmation.',
        'emailSent' => $emailSent
    ]);
    
} catch (Exception $e) {
    error_log('Newsletter subscription error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Subscription failed. Please try again later.'
    ]);
}
?>
