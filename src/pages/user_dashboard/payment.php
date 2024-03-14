<?php
session_start();

// include('db_connection.php');
// $user_email = $_SESSION['email'];

// // Retrieve booking information from the database
// $sql = "SELECT * FROM bookings WHERE user_email = ? AND payment_status = 0";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("s", $user_email);
// $stmt->execute();
// $result = $stmt->get_result();

// // Check if a booking exists
// if ($result->num_rows == 1) {
//     $booking = $result->fetch_assoc();
//     $start_date = $booking['start_date'];
//     $end_date = $booking['end_date'];
// } else {
//     // Handle the case where no booking is found
//     echo "Error: Booking not found.";
//     // You might want to redirect the user or handle this differently based on your requirements
//     exit();
// }

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
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <!--TAB TITLE-->
   <title>PAYMENT</title>
    
    <!--TAB ICON-->
    <link rel="icon" type="image/jpg" href="assets/img/favicon.png"/>
    
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    <!--CSS / JS-->
    <script src="https://kit.fontawesome.com/ff8e777e2d.js" crossorigin="anonymous"></script> <!--ICON RESOURCES-->
    <link href="styles2.css" rel="stylesheet" />
    
  
  </head>
  <body class="body-payment">
    

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
    <div id="overlay">
    <div id="payment-card">
        <p>Name: <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></p>
        <p>Reservation Date: <?php echo $start_date; ?> to <?php echo $end_date; ?></p>
        <p>Package: 
        <?php
//from booking1
if (isset($_SESSION['button_value'])) {
    $valueofbutton = $_SESSION['button_value'];
    echo $valueofbutton;
} else {
    echo "No chosen package";
}
//from booking2
$name = $_GET['addOn'];

if (isset($_GET['addOn'])) {
    echo "<br> You chose the following add on(s): <br>";

    foreach ($name as $addOn){
        echo $addOn."<br />";
    }
} else {
    echo "You did not choose any add on(s).";
}

?>
        </p>
        <hr>
        Total Due:
        <?php
        // Retrieve values from the session
        $packageprice = isset($_SESSION['packageprice']) ? $_SESSION['packageprice'] : 0;
        $data_price = isset($_SESSION['data_price']) ? $_SESSION['data_price'] : 0;

        // Calculate the total price
        $totalPrice = $packageprice + $data_price;
        echo $totalPrice;
        ?>
        <hr>
        <hr>
    
        <img src="samplepayment.jpg"
        style="
        width: 50%; 
        height: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;"> 
    <form action="summary.php">
    <div style="background-color: white; width: 50%; display: block;
        margin-left: auto;
        margin-right: auto;">
        <label for="ProofofPayment"> Proof of Payment: 
    <input type="file" id="paymentProof" name="paymentProof" accept="image/png, image/gif, image/jpeg"  required>
    </label>
    </div>

    <div>
        <input type="number" id="referencenum" name="referencenum" placeholder="Reference Number" required/>
    </div>

    <div>
    <input type = "date" name = "paymentDate" id = "paymentDate" min="<?php echo date("Y-m-d"); ?>"  required>     </div>

    <button type="submit" id="payment-btn"> <a href="summary.php">Proceed </a></button>
</form>
</div>
</div>
    

    </div>
    
   </section>


 <!--BOOKING MODAL--> <!--should always be at the last page-->
 <div class="bg-modal">
                        <div class="modal-contents">

                        <div class="close">+</div>
            

                        <!-- CALENDAR -->
                        

</br>
                        <a href="booking1.php" class="button">BOOK</a>

                        </div>
                        </div>
    
      <!--JS RESOURCE-->
      <script src="main.js"></script>


    
</body>
</html>