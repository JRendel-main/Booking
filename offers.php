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
<html>

<head>

  <title>Offers</title>
  <style>
    h1,
    h3 {
      text-align: center;
    }

    p {
      font-size: 20px;
    }

    /* CSS for the image container */
    .image-container {
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: auto;
      max-width: 800px;
      margin: 0 auto;
      overflow: hidden;
      text-align: center;
    }

    .image-container img {
      display: block;
      max-width: 100%;
      height: auto;
      transition: transform 0.3s, filter 0.3s;
    }

    .image-container:hover img {
      transform: scale(1.05);
      /* Adjust the scale factor as needed */
      filter: brightness(70%) blur(2px);
      /* Adjust the brightness and blur values as needed */
    }

    /* CSS for the hover tab */
    .hover-tab {
      position: absolute;
      bottom: -100%;
      /* Adjust the value as needed */
      left: 0;
      width: 100%;
      height: 100%;
      /* Adjust the value as needed */
      background-color: rgba(248, 248, 248, 0.9);
      /* Adjust the alpha value as needed */
      border-top: 1px solid #ccc;
      transition: bottom 0.3s;
      padding: 20px;
      box-sizing: border-box;
      font-size: 18px;
      opacity: 0.9;
      /* Adjust the opacity value as needed */
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .image-container:hover .hover-tab {
      bottom: 0;
    }

    .hover-tab p {
      margin: 0;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--TAB TITLE-->
  <title>INCLUSIONS</title>

  <!--TAB ICON-->
  <link rel="icon" type="image/jpg" href="favicon.png" />

  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

  <!--CSS / JS-->
  <script src="https://kit.fontawesome.com/ff8e777e2d.js" crossorigin="anonymous"></script>
  <!--ICON RESOURCES-->
  <link href="styles2.css" rel="stylesheet" />


</head>

<header>

  <div class="mainNav">

    <!--WEBSITE PAGES-->
    <ul>
      <li><a href="home.php">Home </a></li>
      <li><a href="gallery.php">Gallery </a></li>
      <li><a href="offers.php">Offers </a></li>
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


<body class="body-payment">
  <h1> </h1>
  <h3> </h3>
  <div class="image-container">
    <img src="package.jpg" alt="Image">
    <div class="hover-tab">
      <p>
        Inclusions: <br><br>
        • Adult Pool (3ft-5ft) <br>
        • Kiddie Pool (3ft) <br>
        • BBQ Grill <br>
        • Jacuzzi (additional: 300/hr) <br>
        • Refrigerator <br>
        • Rice cooker <br>
        • Billiards <br>
        • Basketball <br>
        • Gas stove (additional: 250/day) <br>
        • Dart <br>
        • Playground <br>
        • Water Dispenser: Free 1 Gal (additional: 50/refill) <br>
        • Smart TV with Netflix and Cable <br>
        • 4 Fully Airconditioned Rooms <br>
        • Wifi <br><br>

        Note: <br>
        • Please bring your own utensils and blankets. <br>
        • Maximum of 30 pax for all packages (for every person in excess of 30 pax, Php 200 will be charged).
        Kids 3 feet below are free. <br><br>
        • Additional Php 1000 for every hour excess of the package availed (Subject to availability).
      </p>
    </div>
  </div>
  <br>
  <h3> Event Packages </h3>
  <div class="image-container">
    <img src="package2.jpg" alt="Image">
    <div class="hover-tab">
      <p>
        Same inclusions for our day stay, night stay, and overnight packages. <br>
        + Php 1500 for outside catering service. <br>
        + Php 1500 for lights and sounds. <br>
        + Php 500 for a photo booth. <br>
        Sleeping capacity - 30 pax <br>
        Maximum accommodation - 150 pax.
      </p>
    </div>
  </div>
  <!-- ======= FOOTER ======= -->
  <!-- <footer class="footer">
    <div class="checkbox-container-footer">

       CONTACT DETAILS 
       LINK TO 
       NAMES
       SOCIAL MEDIA BUTTON
    </div>
</footer> -->

  <!--BOOKING MODAL-->
  <!--should always be at the last page-->
  <div class="bg-modal">
    <div class="modal-contents">

      <div class="close">x</div>

      <div class="Date_container">
        <h2>Enter Date: </h2>
        <form action="booking1.php" method="POST">
          <input type="date" name="start_date" id="start_date" min="<?php echo date("Y-m-d"); ?>" required>
          <br><br>
          <input type="date" name="end_date" id="end_date" required>
          <br><br>
          <button type="submit" value="submit">Proceed</button>
        </form>
      </div>

      </br>
    </div>
  </div>


  <!--JS RESOURCE-->
  <script>
    document.getElementById('start_date').addEventListener('input', function () {
      var startDate = this.value;
      document.getElementById('end_date').min = startDate;
    });
  </script>
  <script src="main.js"></script>

  </div>
  </div>

</body>

</html>