<?php
include '../../includes/autoloader.php';

include '../../includes/conn.php';

$conn = new conn();
$session = new session();
include 'includes/header.php';
include 'includes/navbar.php';
?>

<body>
    <div class="container">
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