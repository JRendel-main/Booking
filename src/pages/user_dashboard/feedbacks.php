<?php
include '../../includes/autoloader.php';

include '../../includes/conn.php';

$conn = new conn();
$session = new session();
include 'includes/header.php';
include 'includes/navbar.php';
?>

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