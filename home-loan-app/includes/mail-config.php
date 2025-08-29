<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Install PHPMailer via Composer: composer require phpmailer/phpmailer
require_once __DIR__ . '/../vendor/autoload.php';

// Email configuration - Update these with your SMTP credentials
define('SMTP_HOST', 'smtp.gmail.com'); // Your SMTP host
define('SMTP_PORT', 587); // 587 for TLS, 465 for SSL
define('SMTP_USERNAME', ''); // Your email - ADD YOUR EMAIL HERE
define('SMTP_PASSWORD', ''); // Your app password - ADD YOUR APP PASSWORD HERE
define('FROM_EMAIL', ''); // Your email - ADD YOUR EMAIL HERE
define('FROM_NAME', 'Elite Corporate Solutions');
define('ADMIN_EMAIL', ''); // Admin email to receive notifications - ADD ADMIN EMAIL HERE
define('REPLY_TO_EMAIL', ''); // Reply-to email - ADD YOUR EMAIL HERE

/**
 * Create and configure PHPMailer instance
 */
function createMailer() {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
        $mail->Port = SMTP_PORT;
        
        // Character encoding
        $mail->CharSet = 'UTF-8';
        
        // Default sender
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addReplyTo(REPLY_TO_EMAIL, FROM_NAME);
        
        return $mail;
        
    } catch (Exception $e) {
        error_log('Mailer setup error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send contact form notification to admin
 */
function sendContactEmail($data) {
    $mail = createMailer();
    if (!$mail) return false;
    
    try {
        $mail->addAddress(ADMIN_EMAIL);
        $mail->Subject = '🔔 New Contact Form Submission - Elite Corporate Solutions';
        
        $mail->isHTML(true);
        $mail->Body = getContactEmailTemplate($data);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log('Contact email error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send auto-reply to contact form submitter
 */
function sendContactAutoReply($email, $firstName) {
    $mail = createMailer();
    if (!$mail) return false;
    
    try {
        $mail->addAddress($email);
        $mail->Subject = 'Thank you for contacting Elite Corporate Solutions 🏠';
        
        $mail->isHTML(true);
        $mail->Body = getContactAutoReplyTemplate($firstName);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log('Contact auto-reply error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send loan application notification to admin
 */
function sendLoanApplicationEmail($data) {
    $mail = createMailer();
    if (!$mail) return false;
    
    try {
        $mail->addAddress(ADMIN_EMAIL);
        $mail->Subject = '🏠 URGENT: New Loan Application - ' . $data['applicationId'];
        
        // High priority
        $mail->Priority = 1;
        $mail->addCustomHeader('X-Priority', '1');
        
        $mail->isHTML(true);
        $mail->Body = getLoanApplicationEmailTemplate($data);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log('Loan application email error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send loan application confirmation to applicant
 */
function sendLoanApplicationAutoReply($email, $firstName, $applicationId) {
    $mail = createMailer();
    if (!$mail) return false;
    
    try {
        $mail->addAddress($email);
        $mail->Subject = '✅ Loan Application Received - ' . $applicationId;
        
        $mail->isHTML(true);
        $mail->Body = getLoanApplicationAutoReplyTemplate($firstName, $applicationId);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log('Loan application auto-reply error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send newsletter subscription confirmation
 */
function sendNewsletterConfirmation($email, $firstName = '') {
    $mail = createMailer();
    if (!$mail) return false;
    
    try {
        $mail->addAddress($email);
        $mail->Subject = '🎉 Welcome to Elite Corporate Solutions Newsletter!';
        
        $mail->isHTML(true);
        $mail->Body = getNewsletterConfirmationTemplate($firstName);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log('Newsletter confirmation error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Contact email template
 */
function getContactEmailTemplate($data) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f8fafc; }
            .container { max-width: 600px; margin: 0 auto; background: white; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
            .content { padding: 30px; }
            .detail { margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea; }
            .label { font-weight: bold; color: #1e40af; margin-bottom: 5px; }
            .value { color: #4b5563; }
            .footer { background: #1f2937; color: #d1d5db; padding: 30px; text-align: center; }
            .urgent { background: #fee2e2; border-left: 4px solid #ef4444; padding: 15px; margin: 20px 0; border-radius: 8px; }
            .urgent-text { color: #dc2626; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>🔔 New Contact Form Submission</h2>
                <p>Elite Corporate Solutions</p>
            </div>
            <div class='content'>
                <div class='urgent'>
                    <div class='urgent-text'>⚡ IMMEDIATE ATTENTION REQUIRED</div>
                    <p>A potential customer has reached out. Please respond within 2 hours for best conversion rates.</p>
                </div>
                
                <div class='detail'>
                    <div class='label'>👤 Full Name</div>
                    <div class='value'>{$data['firstName']} {$data['lastName']}</div>
                </div>
                
                <div class='detail'>
                    <div class='label'>📧 Email Address</div>
                    <div class='value'>{$data['email']}</div>
                </div>
                
                <div class='detail'>
                    <div class='label'>📱 Phone Number</div>
                    <div class='value'>{$data['phone']}</div>
                </div>
                
                <div class='detail'>
                    <div class='label'>📋 Subject</div>
                    <div class='value'>{$data['subject']}</div>
                </div>
                
                <div class='detail'>
                    <div class='label'>💬 Message</div>
                    <div class='value'>" . nl2br(htmlspecialchars($data['message'])) . "</div>
                </div>
                
                <div class='detail'>
                    <div class='label'>🕒 Submitted At</div>
                    <div class='value'>" . date('Y-m-d H:i:s') . "</div>
                </div>
                
                <div style='background: #e0f2fe; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                    <h3 style='color: #0277bd; margin-bottom: 15px;'>📞 Quick Actions</h3>
                    <p><strong>Call:</strong> <a href='tel:{$data['phone']}'>{$data['phone']}</a></p>
                    <p><strong>Email:</strong> <a href='mailto:{$data['email']}'>{$data['email']}</a></p>
                    <p><strong>Best Response Time:</strong> Within 2 hours (Higher conversion rate)</p>
                </div>
            </div>
            <div class='footer'>
                <p><strong>Elite Corporate Solutions</strong><br>
                Serving Since 2010 | Home Loan Specialists<br>
                📞 +91 98765 43210 | 📧 info@elitecorporate.com</p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Contact auto-reply template
 */
function getContactAutoReplyTemplate($firstName) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f8fafc; }
            .container { max-width: 600px; margin: 0 auto; background: white; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px; text-align: center; }
            .content { padding: 30px; }
            .highlight { background: #fef3cd; padding: 20px; border-left: 4px solid #f59e0b; margin: 20px 0; border-radius: 8px; }
            .contact-info { background: #f0fdf4; padding: 20px; margin: 20px 0; border-radius: 8px; border-left: 4px solid #10b981; }
            .footer { background: #1f2937; color: #d1d5db; padding: 30px; text-align: center; }
            .steps { background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0; }
            .step { display: flex; align-items: center; margin: 10px 0; }
            .step-number { background: #667eea; color: white; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 15px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>🎉 Thank You, {$firstName}!</h2>
                <p>We've received your message and we're excited to help!</p>
            </div>
            <div class='content'>
                <p>Dear {$firstName},</p>
                <p>Thank you for reaching out to <strong>Elite Corporate Solutions</strong>! We have received your message and truly appreciate your interest in our home loan services.</p>
                
                <div class='highlight'>
                    <h3 style='color: #d97706; margin-bottom: 15px;'>⚡ What happens next?</h3>
                    <div class='steps'>
                        <div class='step'>
                            <div class='step-number'>1</div>
                            <span>Our expert team will review your inquiry within <strong>2 hours</strong></span>
                        </div>
                        <div class='step'>
                            <div class='step-number'>2</div>
                            <span>You'll receive a personalized response from our loan specialist</span>
                        </div>
                        <div class='step'>
                            <div class='step-number'>3</div>
                            <span>We'll schedule a consultation at your convenience</span>
                        </div>
                    </div>
                </div>
                
                <div class='contact-info'>
                    <h3 style='color: #059669; margin-bottom: 15px;'>📞 Need immediate assistance?</h3>
                    <p><strong>Call us directly:</strong> <a href='tel:+919876543210'>+91 98765 43210</a></p>
                    <p><strong>Email:</strong> <a href='mailto:info@elitecorporate.com'>info@elitecorporate.com</a></p>
                    <p><strong>Office Hours:</strong> Mon-Fri 9:00 AM - 7:00 PM, Sat 9:00 AM - 5:00 PM</p>
                </div>
                
                <div style='background: #e0f7fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                    <h3 style='color: #00695c;'>🏠 Why Choose Elite Corporate Solutions?</h3>
                    <ul style='margin: 15px 0; padding-left: 20px;'>
                        <li><strong>15+ Years Experience</strong> - Serving customers since 2010</li>
                        <li><strong>Lowest Interest Rates</strong> - Starting from 8.5% per annum</li>
                        <li><strong>Quick Approval</strong> - Get approved in 24-48 hours</li>
                        <li><strong>10,000+ Happy Customers</strong> - Trust built over years</li>
                        <li><strong>End-to-End Support</strong> - From application to disbursement</li>
                    </ul>
                </div>
                
                <p>We look forward to helping you achieve your dream of homeownership!</p>
                <p style='margin-top: 30px;'>
                    Best regards,<br>
                    <strong>The Elite Corporate Solutions Team</strong><br>
                    <em>Your Trusted Home Loan Partner Since 2010</em>
                </p>
            </div>
            <div class='footer'>
                <p><strong>Elite Corporate Solutions</strong><br>
                📍 123 Business District, Mumbai, Maharashtra 400001<br>
                📞 +91 98765 43210 | 📧 info@elitecorporate.com<br>
                🌐 www.elitecorporate.com</p>
                <p style='margin-top: 20px; font-size: 12px; opacity: 0.8;'>
                    This is an automated response. Please do not reply to this email.<br>
                    For any queries, please contact us using the information above.
                </p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Loan application email template for admin
 */
function getLoanApplicationEmailTemplate($data) {
    $loanTypeNames = [
        'home-purchase' => 'Home Purchase Loan',
        'home-construction' => 'Home Construction Loan',
        'balance-transfer' => 'Balance Transfer',
        'loan-against-property' => 'Loan Against Property'
    ];
    
    $loanTypeName = $loanTypeNames[$data['loanType']] ?? $data['loanType'];
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f8fafc; }
            .container { max-width: 700px; margin: 0 auto; background: white; }
            .header { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 30px; text-align: center; }
            .content { padding: 30px; }
            .urgent { background: #fef2f2; border: 2px solid #ef4444; padding: 20px; margin: 20px 0; border-radius: 8px; text-align: center; }
            .urgent-text { color: #dc2626; font-weight: bold; font-size: 18px; }
            .application-id { background: #f59e0b; color: white; padding: 10px 20px; border-radius: 25px; display: inline-block; font-weight: bold; margin: 10px 0; }
            .details { background: #f8fafc; padding: 25px; margin: 20px 0; border-radius: 8px; border-left: 4px solid #667eea; }
            .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 15px 0; }
            .detail-item { background: white; padding: 15px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
            .label { font-weight: bold; color: #1e40af; font-size: 14px; }
            .value { color: #4b5563; font-size: 16px; margin-top: 5px; }
            .high-value { color: #059669; font-weight: bold; font-size: 18px; }
            .footer { background: #1f2937; color: #d1d5db; padding: 30px; text-align: center; }
            .actions { background: #e0f7fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>🏠 NEW LOAN APPLICATION ALERT</h2>
                <div class='application-id'>ID: {$data['applicationId']}</div>
                <p>High-value opportunity requires immediate attention!</p>
            </div>
            <div class='content'>
                <div class='urgent'>
                    <div class='urgent-text'>🚨 URGENT ACTION REQUIRED 🚨</div>
                    <p style='margin: 15px 0; font-size: 16px;'>New loan application for <strong>₹" . number_format($data['loanAmount']) . "</strong><br>
                    Contact applicant within <strong>30 minutes</strong> for highest conversion rate!</p>
                </div>
                
                <div class='details'>
                    <h3 style='color: #1e40af; margin-bottom: 20px;'>👤 Applicant Information</h3>
                    <div class='detail-grid'>
                        <div class='detail-item'>
                            <div class='label'>Full Name</div>
                            <div class='value'>{$data['firstName']} {$data['lastName']}</div>
                        </div>
                        <div class='detail-item'>
                            <div class='label'>Email Address</div>
                            <div class='value'><a href='mailto:{$data['email']}'>{$data['email']}</a></div>
                        </div>
                        <div class='detail-item'>
                            <div class='label'>Phone Number</div>
                            <div class='value'><a href='tel:{$data['phone']}'>{$data['phone']}</a></div>
                        </div>
                        <div class='detail-item'>
                            <div class='label'>Monthly Income</div>
                            <div class='value high-value'>₹" . number_format($data['monthlyIncome']) . "</div>
                        </div>
                    </div>
                </div>
                
                <div class='details'>
                    <h3 style='color: #1e40af; margin-bottom: 20px;'>💰 Loan Details</h3>
                    <div class='detail-grid'>
                        <div class='detail-item'>
                            <div class='label'>Loan Type</div>
                            <div class='value'>{$loanTypeName}</div>
                        </div>
                        <div class='detail-item'>
                            <div class='label'>Loan Amount</div>
                            <div class='value high-value'>₹" . number_format($data['loanAmount']) . "</div>
                        </div>
                        <div class='detail-item'>
                            <div class='label'>Calculated EMI</div>
                            <div class='value'>₹{$data['calculatedEMI']}</div>
                        </div>
                        <div class='detail-item'>
                            <div class='label'>Application Time</div>
                            <div class='value'>" . date('Y-m-d H:i:s') . "</div>
                        </div>
                    </div>
                </div>
                
                <div class='actions'>
                    <h3 style='color: #00695c; margin-bottom: 15px;'>📋 Immediate Action Plan</h3>
                    <div style='background: white; padding: 20px; border-radius: 6px;'>
                        <p><strong>⏰ Next 30 minutes:</strong></p>
                        <ul style='margin: 10px 0; padding-left: 20px;'>
                            <li>Call applicant immediately: <strong><a href='tel:{$data['phone']}'>{$data['phone']}</a></strong></li>
                            <li>Verify basic information and intent</li>
                            <li>Schedule detailed consultation</li>
                        </ul>
                        
                        <p><strong>📧 Follow-up within 2 hours:</strong></p>
                        <ul style='margin: 10px 0; padding-left: 20px;'>
                            <li>Send welcome email with document checklist</li>
                            <li>Share competitive rate quote</li>
                            <li>Assign relationship manager</li>
                        </ul>
                    </div>
                </div>
                
                <div style='background: #fff7ed; padding: 20px; border-radius: 8px; border-left: 4px solid #f59e0b; margin: 20px 0;'>
                    <h3 style='color: #ea580c; margin-bottom: 10px;'>💡 Conversion Tips</h3>
                    <ul style='margin: 10px 0; padding-left: 20px; color: #9a3412;'>
                        <li>Loan amount indicates serious intent - High priority lead</li>
                        <li>Income level suggests good repayment capacity</li>
                        <li>Quick response increases conversion by 50%</li>
                        <li>Emphasize our 15+ years experience and 10,000+ customers</li>
                    </ul>
                </div>
            </div>
            <div class='footer'>
                <p><strong>Elite Corporate Solutions - Admin Dashboard</strong><br>
                📞 +91 98765 43210 | 📧 admin@elitecorporate.com<br>
                🕒 Application received at " . date('Y-m-d H:i:s') . "</p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Loan application auto-reply template
 */
function getLoanApplicationAutoReplyTemplate($firstName, $applicationId) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f8fafc; }
            .container { max-width: 600px; margin: 0 auto; background: white; }
            .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 40px; text-align: center; }
            .success-icon { font-size: 48px; margin-bottom: 15px; }
            .content { padding: 30px; }
            .app-id { background: #f59e0b; color: white; padding: 15px 25px; border-radius: 25px; display: inline-block; font-weight: bold; font-size: 18px; margin: 15px 0; }
            .timeline { background: #f0fdf4; padding: 25px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #10b981; }
            .step { display: flex; align-items: center; margin: 15px 0; }
            .step-number { background: #10b981; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 15px; }
            .contact { background: #fef3cd; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #f59e0b; }
            .footer { background: #1f2937; color: #d1d5db; padding: 30px; text-align: center; }
            .benefits { background: #e0f7fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='success-icon'>✅</div>
                <h2>Application Submitted Successfully!</h2>
                <p>Welcome to Elite Corporate Solutions Family, {$firstName}!</p>
                <div class='app-id'>Application ID: {$applicationId}</div>
            </div>
            <div class='content'>
                <p>Dear {$firstName},</p>
                <p>🎉 <strong>Congratulations!</strong> Your home loan application has been successfully submitted and is now being processed by our expert team at Elite Corporate Solutions.</p>
                
                <div class='timeline'>
                    <h3 style='color: #059669; margin-bottom: 20px;'>🚀 What happens next?</h3>
                    <div class='step'>
                        <div class='step-number'>1</div>
                        <div>
                            <strong>Immediate Acknowledgment</strong><br>
                            <span style='color: #10b981;'>✓ Completed</span> - Application received and logged
                        </div>
                    </div>
                    <div class='step'>
                        <div class='step-number'>2</div>
                        <div>
                            <strong>Expert Review (Next 2 Hours)</strong><br>
                            Our loan specialist will review your application and contact you
                        </div>
                    </div>
                    <div class='step'>
                        <div class='step-number'>3</div>
                        <div>
                            <strong>Document Verification (24-48 Hours)</strong><br>
                            We'll guide you through the document submission process
                        </div>
                    </div>
                    <div class='step'>
                        <div class='step-number'>4</div>
                        <div>
                            <strong>Credit Assessment & Approval</strong><br>
                            Our team will process your loan approval
                        </div>
                    </div>
                    <div class='step'>
                        <div class='step-number'>5</div>
                        <div>
                            <strong>Loan Disbursement</strong><br>
                            Quick disbursement once all formalities are complete
                        </div>
                    </div>
                </div>
                
                <div class='contact'>
                    <h3 style='color: #d97706; margin-bottom: 15px;'>📞 Our Expert Will Contact You Soon!</h3>
                    <p><strong>Expected Contact Time:</strong> Within 2 hours during business hours</p>
                    <p><strong>For Immediate Assistance:</strong></p>
                    <p>📱 Call: <a href='tel:+919876543210'><strong>+91 98765 43210</strong></a><br>
                    📧 Email: <a href='mailto:loans@elitecorporate.com'><strong>loans@elitecorporate.com</strong></a></p>
                    <p><strong>Office Hours:</strong> Mon-Fri 9:00 AM - 7:00 PM, Sat 9:00 AM - 5:00 PM</p>
                </div>
                
                <div class='benefits'>
                    <h3 style='color: #00695c; margin-bottom: 15px;'>🏆 Why You Made the Right Choice</h3>
                    <ul style='margin: 15px 0; padding-left: 20px;'>
                        <li><strong>15+ Years of Trust</strong> - Serving customers since 2010</li>
                        <li><strong>10,000+ Happy Families</strong> - Proven track record</li>
                        <li><strong>Lowest Interest Rates</strong> - Starting from 8.5% p.a.</li>
                        <li><strong>Quick Processing</strong> - Approval in 24-48 hours</li>
                        <li><strong>Dedicated Support</strong> - Personal relationship manager</li>
                        <li><strong>End-to-End Service</strong> - From application to key handover</li>
                    </ul>
                </div>
                
                <div style='background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin: 20px 0;'>
                    <h3 style='color: #1e40af; margin-bottom: 15px;'>📋 Keep These Documents Ready</h3>
                    <p style='margin-bottom: 10px;'><strong>For faster processing, please keep these documents ready:</strong></p>
                    <ul style='margin: 10px 0; padding-left: 20px; color: #4b5563;'>
                        <li>PAN Card & Aadhaar Card</li>
                        <li>Last 3 months salary slips</li>
                        <li>Last 6 months bank statements</li>
                        <li>Property documents (if available)</li>
                        <li>Form 16 or ITR (last 2 years)</li>
                    </ul>
                </div>
                
                <p style='margin-top: 30px;'>Thank you for choosing <strong>Elite Corporate Solutions</strong>. We're committed to making your home loan journey smooth and hassle-free!</p>
                
                <p>Best regards,<br>
                <strong>The Elite Corporate Solutions Team</strong><br>
                <em>Your Trusted Home Loan Partner Since 2010</em></p>
            </div>
            <div class='footer'>
                <p><strong>Elite Corporate Solutions</strong><br>
                📍 123 Business District, Mumbai, Maharashtra 400001<br>
                📞 +91 98765 43210 | 📧 info@elitecorporate.com<br>
                🌐 www.elitecorporate.com</p>
                
                <p style='margin-top: 20px; font-size: 12px; opacity: 0.8;'>
                    Reference ID: {$applicationId} | Application Date: " . date('Y-m-d H:i:s') . "<br>
                    Please save this email for your records.
                </p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Newsletter confirmation template
 */
function getNewsletterConfirmationTemplate($firstName) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f8fafc; }
            .container { max-width: 600px; margin: 0 auto; background: white; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px; text-align: center; }
            .content { padding: 30px; }
            .footer { background: #1f2937; color: #d1d5db; padding: 30px; text-align: center; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>🎉 Welcome to Our Newsletter!</h2>
                <p>Hello " . ($firstName ?: 'Valued Subscriber') . "!</p>
            </div>
            <div class='content'>
                <p>Thank you for subscribing to Elite Corporate Solutions newsletter!</p>
                <p>You'll now receive:</p>
                <ul>
                    <li>Latest interest rate updates</li>
                    <li>Home loan tips and insights</li>
                    <li>Exclusive offers and promotions</li>
                    <li>Real estate market trends</li>
                </ul>
                <p>Stay connected with us for the best home loan deals!</p>
            </div>
            <div class='footer'>
                <p>Elite Corporate Solutions - Since 2010</p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Send SMS notification (if SMS service is integrated)
 */
function sendSMSNotification($phone, $message) {
    // Integrate with SMS service like Twilio, MSG91, etc.
    // Implementation depends on your SMS provider
    
    try {
        // Example implementation - replace with actual SMS service
        // $sms = new SMSProvider();
        // $sms->send($phone, $message);
        
        error_log("SMS would be sent to {$phone}: {$message}");
        return true;
        
    } catch (Exception $e) {
        error_log('SMS error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Log email activities
 */
function logEmailActivity($type, $recipient, $status, $details = '') {
    $logData = [
        'timestamp' => date('Y-m-d H:i:s'),
        'type' => $type,
        'recipient' => $recipient,
        'status' => $status,
        'details' => $details
    ];
    
    error_log('Email Log: ' . json_encode($logData));
}
?>
