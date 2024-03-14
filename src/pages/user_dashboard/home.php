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
  <title>Home</title>

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




<!-- ======= NAVIGATION BAR ======= -->


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

    <div class="button-container">

      <!--BOOK BUTTON-->
      <a href="#" id="button" class="button">Book Now</a>

      <label style="color:white;">Hi,
        <?php echo $row['first_name']; ?>
      </label>

      <!--LOGOUT BUTTON-->
      <a href="login.php">Log out</a>
    </div>

  </div>
</header>

<body class="body-home">
  <section class="hero">
    <div class="hero-content">
    </div>
  </section>
  <!-- <footer class="footer">
            <div class="container-footer">

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



</body>

</html>