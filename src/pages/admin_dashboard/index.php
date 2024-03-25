<?php
include '../../includes/autoloader.php';

// check the session if the user is logged in
$session = new Session();
if ($session->get('email') != null) {
    header('Location: ../index.php');
}

// check the error or success message
$error = isset ($_GET['error']) ? $_GET['error'] : '';
$success = isset ($_GET['success']) ? $_GET['success'] : '';

// display the error or success message
if ($error) {
    echo "
    <script>
        alert('{$error}');
    </script>";
} else {
    echo "
    <script>
        alert('{$success}');
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Join Villa Delos Reyes!</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all. css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhnd0JK28anvf" crossorigin="anonymous">
    <link href="../../../loginpage.css" rel="stylesheet" />
</head>

<body>
    <div class="container" id="container">
        <!-- Sign in -->
        <div class="form-container sign-in-container">
            <form id="login-form" method="post" action="admin-login.php">
                <h1>Admin Login</h1>
                <input type="text" id="email" name="email" placeholder="Username" />
                <input type="password" id="password" name="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <button type="submit" value="Login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Hello, User!</h1>
                    <p>Enter your personal details and join us in Villa Delos Reyes!</p>
                    <button class="ghost" id="signUpButton">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
</body>

</html>