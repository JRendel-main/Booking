<?php
include 'includes/autoloader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $cont_no = $_POST['cont_no'];
    $password = $_POST['password'];

    $db = new Database();
    $user = new User($db);
    $auth = new Authentication($user);

    $registering = $auth->register($firstname, $lastname, $email, $cont_no, $password);

    if ($registering) {
        header('Location: index.php?success=You have successfully registered!');
    } else {
        header('Location: index.php?error=Email already exists');
    }
}
else {
    header('Location: index.php');
}