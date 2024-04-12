<?php

$path = $_GET['path'];

// display the proof of payment photo 
if (isset($_GET['path'])) {
    $path = $_GET['path'];
    echo "<img src='../user_dashboard/uploads/payments/$path' class='img-fluid' alt='proof of payment' width='800' height='480'>";
}