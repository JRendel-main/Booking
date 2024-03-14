<?php
session_start();
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    if (isset($_POST['package1'])) {
        $valueofbutton = "Package 1: Day Stay";
        $packageprice = "15000";
    } elseif (isset($_POST['package2'])) {
        $valueofbutton = "Package 2: Night Stay";
        $packageprice = "18000";
    } elseif (isset($_POST['package3'])) {
      $valueofbutton = "Package 3: Overnight Stay";
  } else {
        $valueofbutton = "No button clicked";
        $packageprice = "999999";
    }
  }

    // Store the value in a session variable
    $_SESSION['button_value'] = $valueofbutton;
    $_SESSION['packageprice'] = $packageprice;
    if (isset($_POST['addOn'])) {
      // Store the selected add-ons in session variable
      $_SESSION['selected_addons'] = $_POST['addOn'];
  } else {
      // If no add-ons are selected, set an empty array in the session variable
      $_SESSION['selected_addons'] = array();
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--TAB TITLE-->
    <title>ADD-ONS</title>

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

<body class="body-addOn">

    <!-- NAVIGATION BAR -->

    <header>

        <div class="mainNav">

            <!--WEBSITE PAGES-->
            <ul>
                <li><a href="home.php">Home </a></li>
                <li><a href="gallery.php">Gallery </a></li>
                <li><a href="offers.php">Offers </a></li>
                <li><a href="about.php">About</a></li>
            </ul>




            <div class="button-container">

                <label style="color:white;">Hi, <?php echo $row['first_name']; ?></label>

                <!--LOGOUT BUTTON-->
                <a href="login.php">Log out</a>
            </div>

        </div>
    </header>

    <!-- ======= INCLUSIONS ======= -->

    <section class="inclusion">
        <div class="inclusion-content">

            <!--SELECTED PACKAGE CARD-->
            <div class="package-card">
                <h1>Rules and Policies </h1>
                <div class="card">
                    <div class="container">

                    </div>
                </div>
            </div>

            <!--INCLUSION INFO/FORM-->
            <div class="inclusion-container">

                <h1 class="h1-inclusion">Inclusions: </h1>

                <div id="box1">
                    <p>Adult Pool</p>
                    <p>Kiddie Pool</p>
                    <p>Billiards</p>
                    <p>Basketball</p>
                    <p>Dart</p>
                    <p>Playground</p>
                    <p>Smart TV | Netflix & Cable </p>
                    <p>Wi-Fi</p>

                </div>

                <div id="box2">
                    <p>Videoke</p>
                    <p>Barbeque Grill</p>
                    <p>Refrigerator</p>
                    <p>Rice Cooker</p>
                    <p>Gas Stove</p>
                    <p>Water Dispener</p>
                    <p>4 Fully Airconditioned Rooms</p>
                </div>



                <div id="box3">
                    <h1 class="h1-inclusion"> Add-ons </h1>

                    <form action="payment.php" method="get">

                        <!--CHECKBOXES-->
                        <label class="checkbox-container">Jacuzzi | Additional - 300PHP/hour
                            <input type="checkbox" name="addOn[]" value="Jacuzzi" data_price="300">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">Gas Stove | Additional - 250PHP/day
                            <input type="checkbox" name="addOn[]" value="Gas Stove" data_price="250">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">Dryer Machine | 50PHP/hour
                            <input type="checkbox" name="addOn[]" value="Dryer Machine" data_price="50">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">Himalayan Charcoal | 100PHP/hour
                            <input type="checkbox" name="addOn[]" value="Himalayan Charcoal" data_price="100">
                            <span class="checkmark"></span>
                        </label>


                        <input type="submit" id="inclusion-btn" value="Submit">
                    </form>


                </div>
    </section>

    <script>
    document.getElementById("inclusion-btn").addEventListener("click", function() {
        // Calculate total price including packageprice and selected add-ons
        var selectedAddOns = document.querySelectorAll('input[name="addOn[]"]:checked');
        var totalPrice = parseInt(<?php echo $packageprice; ?>);

        selectedAddOns.forEach(function(addOn) {
            totalPrice += parseInt(addOn.getAttribute("data_price"));
        });

        // Set the calculated total price to the hidden input field
        document.querySelector('input[name="data_price"]').value = totalPrice;
    });
    </script>


    <script src="main.js"></script>



</body>

</html>