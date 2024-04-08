<?php
include 'includes/autoloader.php';

// Autoload file path
$vendor = '../vendor/autoload.php';

// Check if email is provided
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Initialize database connection
    $conn = new Database();

    // Initialize User object
    $user = new User($conn);

    // Check if the email exists in the database
    if ($user->checkEmail($email)) {
        // Generate a token
        $token = bin2hex(random_bytes(50));

        // Insert the reset password token into the database
        if ($user->insertResetPassword($email, $token)) {
            // Send an email with the reset password link
            $to = $email;
            $subject = "Reset Password";
            $message = "<p>Click the link below to reset your password.</p>
                        <a href='http://localhost/booking/src/reset-password.php?token=$token'>Reset Password</a>";
            $type = 'reset_password';

            // Initialize Email object
            $emailObj = new Email($vendor);

            // Send the email
            $emailObj->sendEmail($to, $subject, $type, $message);

            // Redirect to forgot-password.php with success message
            header('Location: forgot-password.php?success=Check your email to reset your password.');
            exit();
        } else {
            // Redirect to forgot-password.php with error message
            header('Location: forgot-password.php?error=Failed to reset your password.');
            exit();
        }
    } else {
        // Redirect to forgot-password.php with error message
        header('Location: forgot-password.php?error=Email does not exist.');
        exit();
    }
} else {
    // Redirect to forgot-password.php with error message
    header('Location: forgot-password.php?error=Email not provided.');
    exit();
}
?>