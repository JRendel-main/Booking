<?php
// Start a session
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit();
}

// Connect to MySQL
$host = "localhost";
$user = "root";
$password = "";
$database = "login_db";

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email_address = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles3.css" rel="stylesheet" />
    <title>Feedback Page</title>
</head>
   <!--  NAVIGATION BAR -->
   <header class="page-header">
   <div class="mainNav">
     
        <!--WEBSITE PAGES-->
        <ul>
           <li><a href="home.php">Home  </a></li>
           <li><a href="gallery.php">Gallery  </a></li>
           <li><a href="offers.php">Offers  </a></li>
           <li><a href="about.php">About</a></li>
           <li><a href="viewfeedbacks.php">Feedbacks</a></li>
       </ul>
 
       <div class="button-checkbox-container">
        <!-- BRAND LOGO-->
        <a href="home.php">
          <div class="logo">VILLA DELOS REYES  
         </div>
         <!-- TEXT LOGO
        <img src="logo2.png" alt="">   
         IMAGE LOGO -->
        </a> 
        </div>
       <div class="button-container">

        <!--BOOK BUTTON-->
        <a href="#" id="button" class="button">Book Now</a>

  
        <!--LOGOUT BUTTON-->
        <a href="login.php">Log out</a>
        </div>

   </header>
<body>
<div class="feedback-box">
<h1>Feedback Form</h1>
<form action="/submit_feedback" method="post">
    <label for="bookingid">Booking ID:</label>
    <input type="text" id="bookingid-txt-fd" name="bookingid" placeholder="Enter Booking ID" required>

    <label for="firstname">First Name:</label>
    <input type="text" id="firstname-txt-fd" name="firstname" placeholder="Enter First Name" required>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname-txt-fd" name="lastname" placeholder="Enter Last Name" required>

    <label for="feedback">Feedback Message:</label>
    <textarea id="feedback" name="feedback-txt-fd" placeholder="Enter Feedback" required></textarea>

    <input type="submit" value="Submit" id="input-feed-btt">
</form>
</div>
</body>
</html>