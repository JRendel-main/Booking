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
$database = "booking";

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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--TAB TITLE-->
  <title>PACKAGES</title>

  <!--TAB ICON-->
  <link rel="icon" type="image/jpg" href="assets/img/favicon.png" />

  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

  <!--CSS / JS-->
  <script src="https://kit.fontawesome.com/ff8e777e2d.js" crossorigin="anonymous"></script>
  <!--ICON RESOURCES-->
  <link href="styles2.css" rel="stylesheet" />


</head>

<body class="body-package">

  <!--  NAVIGATION BAR -->

  <header class="page-header">

    <div class="mainNav">

      <!--WEBSITE PAGES-->
      <ul>
        <li><a href="home.php">Home </a></li>
        <li><a href="gallery.php">Gallery </a></li>
        <li><a href="offers.php">Offers </a></li>
        <li><a href="about.php">About</a></li>
      </ul>




      <div class="button-container">

        <label style="color:white;">Hi,
          <?php echo $row['first_name']; ?>
        </label>

        <!--LOGOUT BUTTON-->
        <a href="login.php">Log out</a>
      </div>

    </div>
  </header>





  <!--PACKAGE SECTION-->

  <section class="package">
    <div class="package-content">


      <!--PACKAGE 1-->

      <div class="card-space">
        <div class="card">
          <img src="p1.png" alt="Package 1" style="width:100%">
          <div class="container">
            <h4><b>Day Stay</b></h4>
            <h3>15 000</h3>
            <form method="post" action="booking2.php">
              <input class="card-button" type="submit" name="package1" value="Select" />
            </form>
          </div>
        </div>
      </div>

      <!--PACKAGE 2-->

      <div class="card-space">
        <div class="card">
          <img src="p2.png" alt="Package 2" style="width:100%">
          <div class="container">
            <h4><b>Night Stay</b></h4>
            <h3>18 000</h3>
            <form method="post" action="booking2.php">
              <input class="card-button" type="submit" name="package2" value="Select" />
            </form>
          </div>
        </div>
      </div>

      <!--PACKAGE 3-->
      <div class="card-space">
        <div class="card">
          <img src="p3.png" alt="Package 3" style="width:100%">
          <div class="container">
            <h4><b>Overnight Stay</b></h4>
            <h3>25 000</h3>
            <form method="post" action="booking2.php">
              <input class="card-button" type="submit" name="package3" value="Select" />
            </form>
          </div>
        </div>
      </div>






    </div>
  </section>

  <script src="main.js"></script>
</body>

</html>