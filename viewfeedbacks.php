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
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Testimonials, INTUITIVE">
    <meta name="description" content="">
    <title>Home</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="styles3.css" media="screen">
    <link rel="stylesheet" href="styles2.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.5.3, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "",
        "logo": "images/default-logo.png"
    }
    </script>
    <header>
        <div class="mainNav sticky-top">

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
    </header>
    <section class="u-align-center u-clearfix u-container-align-center u-palette-2-base u-section-1 bg-white containerr"
        id="carousel_b1e3">
        <div class="u-clearfix u-sheet u-sheet-1">

            <div class="u-list u-list-1">
                <br>
                <h2 class="u-align-center u-text u-text-default u-text-1 paginationcenter">Testimonials</h2>
                <div class="u-repeater u-repeater-1">
                    <div class="u-container-align-center-xs u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-1"
                        data-animation-direction="Up" data-animation-name="customAnimationIn"
                        data-animation-duration="1500" data-animation-delay="500">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                            <p
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-black u-text-2">
                                Sample text. Click to select the text box. Click again or double click to start editing
                                the text.</p>
                            <h6
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-default u-text-palette-2-base u-text-3">
                                stella larson</h6>
                        </div>
                    </div>
                    <div class="u-container-align-center-xs u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-2"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="500">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
                            <p
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-black u-text-4">
                                Sample text. Click to select the text box. Click again or double click to start editing
                                the text.</p>
                            <h6
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-default u-text-palette-2-base u-text-5">
                                nick jhonson</h6>
                        </div>
                    </div>
                    <div class="u-container-align-center-xs u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-3"
                        data-animation-direction="Up" data-animation-name="customAnimationIn"
                        data-animation-duration="1500" data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                            <p
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-black u-text-6">
                                Sample text. Click to select the text box. Click again or double click to start editing
                                the text.</p>
                            <h6
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-default u-text-palette-2-base u-text-7">
                                olga ivanova</h6>
                        </div>
                    </div>
                    <div class="u-container-align-center-xs u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-4"
                        data-animation-direction="Up" data-animation-name="customAnimationIn"
                        data-animation-duration="1500" data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-4">
                            <p
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-black u-text-8">
                                Sample text. Click to select the text box. Click again or double click to start editing
                                the text.</p>
                            <h6
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-default u-text-palette-2-base u-text-9">
                                paul hudson</h6>
                        </div>
                    </div>
                    <div class="u-container-align-center-xs u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-5"
                        data-animation-direction="Up" data-animation-name="customAnimationIn"
                        data-animation-duration="1500" data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-5">
                            <p
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-black u-text-10">
                                Sample text. Click to select the text box. Click again or double click to start editing
                                the text.</p>
                            <h6
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-default u-text-palette-2-base u-text-11">
                                cash hudson</h6>
                        </div>
                    </div>
                    <div class="u-container-align-center-xs u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-6"
                        data-animation-direction="Up" data-animation-name="customAnimationIn"
                        data-animation-duration="1500" data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-6">
                            <p
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-black u-text-12">
                                Sample text. Click to select the text box. Click again or double click to start editing
                                the text.</p>
                            <h6
                                class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-text u-text-default u-text-palette-2-base u-text-13">
                                mike perry</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="paginationcenter">
            <form action="feedbacks.php" method="post">
                <input type="submit" value="Leave a feedback!" id="input-leavefeed-btt">
            </form>

        </div>
        <div class="paginationcenter">
            <div class="pagination">
                <br>
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div>
        </div>
    </section>



    </body>

</html>