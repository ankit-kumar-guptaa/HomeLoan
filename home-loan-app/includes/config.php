<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'home_loan_app');
define('DB_USER', 'root'); // Update with your DB username
define('DB_PASS', ''); // Update with your DB password

// Application configuration
define('APP_NAME', 'Elite Corporate Solutions');
define('APP_URL', 'https://yourwebsite.com'); // Update with your domain
define('ADMIN_EMAIL', 'admin@elitecorporate.com'); // Update with admin email
define('CONTACT_EMAIL', 'info@elitecorporate.com'); // Update with contact email

// Security settings
define('CSRF_TOKEN_NAME', 'csrf_token');
define('SESSION_TIMEOUT', 3600); // 1 hour

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0); // Set to 1 for development, 0 for production
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Session configuration
ini_set('session.cookie_lifetime', SESSION_TIMEOUT);
ini_set('session.gc_maxlifetime', SESSION_TIMEOUT);

// Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    die('Database connection failed');
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

/**
 * Sanitize input
 */
function sanitizeInput($input) {
    return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
}

/**
 * Validate email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (Indian format)
 */
function isValidPhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return preg_match('/^[6-9]\d{9}$/', $phone);
}

/**
 * Log security events
 */
function logSecurityEvent($event, $details = []) {
    $logData = [
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'event' => $event,
        'details' => $details
    ];
    
    error_log('Security Log: ' . json_encode($logData));
}

/**
 * Rate limiting
 */
function checkRateLimit($identifier, $maxRequests = 10, $timeWindow = 3600) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $key = 'rate_limit_' . $identifier;
    $now = time();
    
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = ['count' => 1, 'start_time' => $now];
        return true;
    }
    
    $rateData = $_SESSION[$key];
    
    if (($now - $rateData['start_time']) > $timeWindow) {
        $_SESSION[$key] = ['count' => 1, 'start_time' => $now];
        return true;
    }
    
    if ($rateData['count'] >= $maxRequests) {
        return false;
    }
    
    $_SESSION[$key]['count']++;
    return true;
}

/**
 * Create database tables if not exists
 */
function createTables() {
    global $pdo;
    
    try {
        // Contact submissions table
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS contact_submissions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                subject VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                ip_address VARCHAR(45) NOT NULL,
                user_agent TEXT,
                status ENUM('new', 'replied', 'closed') DEFAULT 'new',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Loan applications table
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS loan_applications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                application_id VARCHAR(50) UNIQUE NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                loan_type ENUM('home-purchase', 'home-construction', 'balance-transfer', 'loan-against-property') NOT NULL,
                loan_amount DECIMAL(15,2) NOT NULL,
                monthly_income DECIMAL(15,2) NOT NULL,
                message TEXT,
                calculated_emi VARCHAR(50),
                calculated_rate VARCHAR(10),
                calculated_tenure VARCHAR(10),
                ip_address VARCHAR(45) NOT NULL,
                user_agent TEXT,
                status ENUM('pending', 'reviewing', 'approved', 'rejected', 'disbursed') DEFAULT 'pending',
                assigned_to INT NULL,
                notes TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Newsletter subscriptions table
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS newsletter_subscriptions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) UNIQUE NOT NULL,
                first_name VARCHAR(100),
                status ENUM('active', 'inactive', 'unsubscribed') DEFAULT 'active',
                ip_address VARCHAR(45) NOT NULL,
                user_agent TEXT,
                subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                unsubscribed_at TIMESTAMP NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Admin users table (for future admin panel)
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS admin_users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) UNIQUE NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password_hash VARCHAR(255) NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                role ENUM('admin', 'manager', 'agent') DEFAULT 'agent',
                status ENUM('active', 'inactive') DEFAULT 'active',
                last_login TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        return true;
        
    } catch (PDOException $e) {
        error_log('Table creation failed: ' . $e->getMessage());
        return false;
    }
}

// Create tables on first run
createTables();

/**
 * Get application statistics
 */
function getApplicationStats() {
    global $pdo;
    
    try {
        $stats = [];
        
        // Total applications
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM loan_applications");
        $stats['total_applications'] = $stmt->fetch()['total'];
        
        // Applications today
        $stmt = $pdo->query("SELECT COUNT(*) as today FROM loan_applications WHERE DATE(created_at) = CURDATE()");
        $stats['today_applications'] = $stmt->fetch()['today'];
        
        // Pending applications
        $stmt = $pdo->query("SELECT COUNT(*) as pending FROM loan_applications WHERE status = 'pending'");
        $stats['pending_applications'] = $stmt->fetch()['pending'];
        
        // Total loan amount
        $stmt = $pdo->query("SELECT SUM(loan_amount) as total_amount FROM loan_applications WHERE status IN ('approved', 'disbursed')");
        $stats['total_amount'] = $stmt->fetch()['total_amount'] ?? 0;
        
        return $stats;
        
    } catch (PDOException $e) {
        error_log('Stats query failed: ' . $e->getMessage());
        return [];
    }
}
?>
