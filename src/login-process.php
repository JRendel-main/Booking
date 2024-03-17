<?php
include 'includes/autoloader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();
    $user = new User($db);
    $auth = new Authentication($user);
    $session = new Session();

    $loggingIn = $auth->login($email, $password);
    if ($loggingIn) {
        $session->set('email', $email);
        $session->set('user_id', $user->getUserId($email));

        // check if the user_id is null
        if ($session->get('user_id') == null) {
            header('Location: index.php?error=Invalid email or password');
        }
        header('Location: pages/_dashboard/index.php');
    } else {
        header('Location: index.php?error=Invalid email or password');
    }
} else {
    header('Location: index.php');
}