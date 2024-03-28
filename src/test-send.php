<?php
include 'includes/autoloader.php';

$email = new Email();

$to = 'admin@gmail.com';
$subject = 'Test Email';
$type = 'test_email';
$message = '
    <p>Hi Admin,</p>
    <p>This is a test email.</p>
    <p>Thank you.</p>
';

$email = $email->sendEmail($to, $subject, $type, $message);