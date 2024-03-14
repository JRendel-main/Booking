<?php

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
    <title>About</title>
    <style>
    /* CSS for the About page */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url("pool side.jpg");
        background-size: cover;
    }

    .containerr {
        max-width: 800px;
        margin: 0 auto;
        margin-top: 100px;
        padding: 20px;
        background-color: aliceblue;
        justify-content: center;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    p {
        margin-bottom: 10px;
    }

    .map-container {
        margin-top: 20px;
    }

    .map-container iframe {
        width: 100%;
        height: 450px;
        border: 0;
    }

    .contacts {
        margin-top: 20px;
        margin: 0 auto;
        display: inline-block;
        justify-content: center;
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

<body>
    <div class="mainNav">

        <!--WEBSITE PAGES-->
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="offers.php">Offers</a></li>
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

            <label style="color:white;">Hi,
                <?php echo $row['first_name']; ?>
            </label>

            <!--LOGOUT BUTTON-->
            <a href="login.php">Log out</a>
        </div>

    </div>
    </header>
    <div class="containerr">
        <h1>About</h1>
        <p>Welcome to a luxurious hotel located in a beautiful destination. Our hotel offers top-notch amenities and
            services to ensure an unforgettable stay for our guests.</p>

        <h2>Location</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.5603593230003!2d120.8737109148446!3d14.961567489573385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396ffdbf068fe23%3A0xf0ee2300cdb85362!2sVilla%20Delos%20Reyes!5e0!3m2!1sen!2sph!4v1684660399980!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contacts">
            Contact us:
            <a href="https://www.facebook.com/villadelosreyesresort/"> <img src="fblogo.png"> </a>
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
    document.getElementById('start_date').addEventListener('input', function() {
        var startDate = this.value;
        document.getElementById('end_date').min = startDate;
    });
    </script>
    <script src="main.js"></script>
</body>

</html>