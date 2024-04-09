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
    <style>
    .container {
        position: relative;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-panel {
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 0 40px;
        height: 100%;
        width: 50%;
        text-align: center;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <!-- sign up -->
            <form id="signup" method="POST" action="signup-process.php">
                <h1>Create Account</h1>
                <input type="text" id="first_name" name="first_name" required="required" placeholder="First Name" />
                <input type="text" id="last_name" name="last_name" required="required" placeholder="Last Name" />
                <input type="text" id="address" name="address" required placeholder="Address" />
                <input type="email" id="email" name="email" required="required" placeholder="Email" />
                <input type="number" id="cont_no" name="cont_no" required="required" placeholder="Contact Number" />
                <input type="password" id="password" name="password" required="required" placeholder="Password" />
                <span id="message"></span>
                <input type="password" id="confirm_password" name="confirm_password" required="required"
                    placeholder="Confirm Password" />
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <!-- Sign in -->
        <div class="form-container sign-in-container">
            <form id="login-form" method="post" action="login-process.php">
                <h1>Sign in</h1>
                <input type="email" id="signin_email" name="email" placeholder="Email" />
                <input type="password" id="signin_password" name="password" placeholder="Password" />
                <a href="forgot-password.php">Forgot your password?</a>
                <button type="submit">Sign In</button>
                <!-- Admin login -->
                <a href="pages/admin_dashboard/index.php">Admin Login</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="../script.js"></script>
    <script>
    $(document).ready(function() {
        // password validation on sign up
        // 8 characters, 1 uppercase, 1 number dont use regex, every keyup
        $('#password').keyup(function() {
            var password = $('#password').val();
            var passwordLength = password.length;
            var hasUppercase = /[A-Z]/.test(password);
            var hasNumber = /\d/.test(password);
            if (passwordLength >= 8 && hasUppercase && hasNumber) {
                // remove message password
                $('#message').text('');
            } else {
                $('#message').text(
                        'Password needs atleast 8 characters with 1 number and atleast 1 uppercase')
                    .css('color',
                        'red');
            }

            // remove message if not keyup
            $('#password').focusout(function() {
                $('#message').text('');
            });
        });
    });
    </script>
</body>

</html>