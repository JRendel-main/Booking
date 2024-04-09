<?php
include 'includes/autoloader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $cont_no = $_POST['cont_no'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $db = new Database();
        $user = new User($db);
        $auth = new Authentication($user);

        $registering = $auth->register($firstname, $lastname, $address, $email, $cont_no, $password);

        if ($registering) {
            header('Location: index.php?success=You have successfully registered!');
        } else {
            header('Location: index.php?error=Email already exists');
        }
    } else {
        header('Location: index.php?error=Passwords do not match');
        exit();
    }
} else {
    header('Location: index.php');
}