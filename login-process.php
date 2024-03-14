<?php
// Start a session
session_start();

// Connect to MySQL
$host = "localhost";
$user = "root";
$password = "";
$database = "booking";

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If the login form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM user WHERE email_address = '$email'";
    $result = mysqli_query($conn, $sql);

    // If a user was found
    if (mysqli_num_rows($result) === 1) {
        // Verify input password to database hash password
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;

            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            // Show an error message
            $error_message = "Invalid username or password.";
            header("Location: login.php?error=$error_message");
            exit();
        }
    } else {
        // Show an error message
        echo "Invalid username or password.";
        exit();
    }
}
?>