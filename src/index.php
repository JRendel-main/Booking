<?php
include 'includes/autoloader.php';

// check the session if the user is logged in
$session = new Session();
if ($session->get('email') != null) {
    header('Location: pages/user_dashboard/index.php');
}

// check the error or success message
$error = isset($_GET['error']) ? $_GET['error'] : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';

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
    <link href="../loginpage.css" rel="stylesheet" />
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <!-- sign up -->
            <form action="signup-process.php" method="POST" id="signup">
                <h1>Create Account</h1>
                <input type="text" id="first_name" name="first_name" required="required" placeholder="First Name" />
                <input type="text" id="last_name" name="last_name" required="required" placeholder="Last Name" />
                <input type="email" id="email" name="email" required="required" placeholder="Email" />
                <input type="number" id="cont_no" name="cont_no" required="required" placeholder="Contact Number" />
                <input type="password" id="password" name="password" required="required" placeholder="Password" />
                <button>Sign Up</button>
            </form>
        </div>
        <!-- Sign in -->
        <div class="form-container sign-in-container">
            <form id="login-form" method="post" action="login-process.php">
                <h1>Sign in</h1>
                <input type="email" id="email" name="email" placeholder="Email" />
                <input type="password" id="password" name="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <button type="submit" value="Login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Please login with your personal info</p>
                    <button class="ghost" id="signInButton">Sign In</button>
                </div>
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