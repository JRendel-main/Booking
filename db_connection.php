<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
    // Check if the current page is not already login.php to avoid infinite loop
    if(basename($_SERVER['PHP_SELF']) != 'login.php'){
        // Temporarily output a message for debugging
        echo "Redirecting to login.php";
        // header("Location: login.php");
        // exit();
    }
}

$host = "localhost";
$user = "root";
$password = "";
$database = "login_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_email = $_SESSION['email'];
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];

$sql = "INSERT INTO bookings (user_email, start_date, end_date)
        VALUES (?, ?, ?)";

$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param("sss", $user_email, 
$_SESSION["start_date"], 
$_SESSION["end_date"]);

if ($stmt->execute()) {
    echo "Success";
    header("Location: payment.php");
    exit;
    
} else {
    if ($conn->errno === 1062) {
        die("Booking error");
    } else {
        die($conn->error . " " . $conn->errno);
    }
}
?>
</body>
</html>