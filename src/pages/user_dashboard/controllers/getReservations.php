<?php

include '../../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

$reservations = new Reservations($connection);
$reservations = $reservations->getReservations();

echo json_encode($reservations);