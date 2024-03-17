<?php
include '../../includes/autoloader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();
    $user = new User($db);
    $auth = new Authentication($user);
    $session = new Session();

    $loggingIn = $auth->adminLogin($email, $password);
    if (isset ($loggingIn)) {
        $session->set('email', $email);
        $session->set('user_id', $loggingIn);
        header('Location: dashboard.php');
    } else {
        header('Location: ../../index.php?error=Invalid email or password');
    }
} else {
    header('Location: index.php');
}