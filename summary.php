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

$button_value = isset($_SESSION['button_value']) ? $_SESSION['button_value'] : "No chosen package";
$packageprice = isset($_POST['packageprice']) ? $_POST['packageprice'] : 0;
$data_price = isset($_POST['data_price']) ? $_POST['data_price'] : 0;
$selected_addons = isset($_POST['selected_addons']) ? $_POST['selected_addons'] : [];

// Store values in session variables
$_SESSION['packageprice'] = $packageprice;
$_SESSION['data_price'] = $data_price;
$_SESSION['selected_addons'] = $selected_addons;
?>



<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <!--TAB TITLE-->
   <title>SUMMARY</title>
    
    <!--TAB ICON-->
    <link rel="icon" type="image/jpg" href="assets/img/favicon.png"/>
    
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    <!--CSS / JS-->
    <script src="https://kit.fontawesome.com/ff8e777e2d.js" crossorigin="anonymous"></script> <!--ICON RESOURCES-->
    <link href="styles2.css" rel="stylesheet" />
    
  
  </head>
  <body class="body-receipt">
    
   <!-- ======= NAVIGATION BAR ======= -->


   <!-- <header id="header" class="header fixed-top d-flex align-items-center"> ampawn--main box for navigation bar--> 
   <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav"> --homepage(1) -- get trasnparent feature -->
   <header>

   <div class="mainNav">

<!--WEBSITE PAGES-->
<ul>
       <li><a href="home.php">Home  </a></li>
            <li><a href="gallery.php">Gallery  </a></li>
            <li><a href="offers.php">Offers  </a></li>
            <li><a href="about.php">About</a></li>
        </ul>

    

    
      <div class="button-container">
      <label style="color:white;">Hi, <?php echo $row['first_name']; ?></label>

      <!--LOGOUT BUTTON-->
      <a href="login.php">Log out</a>
      </div>

</div>
   </header>

   <section class="payment">
    <div class="payment-content">

    <div id="receipt">
        <h1> Thank you! You're Already Reserved, <?php echo $row['first_name']; ?>!</h1>
        <p>Name: <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></p>
        <p>Booking Number: <??></p>
        <p>Reservation Date:<??> </p>
        <p>Package: <?php
//from booking1
if (isset($_SESSION['button_value'])) {
    $valueofbutton = $_SESSION['button_value'];
    echo $valueofbutton;
} else {
    echo "No chosen package";
}
?>
</p>
<p>Add-Ons: 
    <?php
    if (!empty($selected_addons)) {
        echo "<br>You chose the following add-on(s):<br>";
        foreach ($selected_addons as $addOn) {
            echo $addOn . "<br>";
        }
    } else {
        echo "You did not choose any add-on(s).";
    }
    ?>
</p>
        <hr>
        Total Due: <?php
        // Retrieve values from the session
        $packageprice = isset($_SESSION['packageprice']) ? $_SESSION['packageprice'] : 0;
        $data_price = isset($_SESSION['data_price']) ? $_SESSION['data_price'] : 0;

        // Calculate the total price
        $totalPrice = $packageprice + $data_price;
        echo $totalPrice;
        ?>
        <hr>
        <hr>

    
    <a href="home.php"><p style="color: blue;"> Go back to Home Page </p></a>
</div>
    

    </div>
    
   </section>


   
      
 
    

    
      <!--JS RESOURCE-->
      <script src="main.js"></script>


    
</body>
</html>