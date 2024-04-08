<?php

include 'includes/autoloader.php';

$token = $_POST['token'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password != $confirm_password) {
    header('Location: reset-password.php?error=Passwords do not match.&token=' . $token);
    exit();
}

$conn = new Database();
$user = new User($conn);

$checkToken = $user->checkToken($token);

if ($checkToken) {
    // hash password
    $pass = $user->resetPassword($token, $password);
    if ($pass) {
        header('Location: forgot-password.php?success=Password reset successful.');
    } else {
        header('Location: forgot-password.php?error=Failed to reset password.');
    }
} else {
    header('Location: forgot-password.php?error=Token is invalid.');
}