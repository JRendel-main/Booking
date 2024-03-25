<?php
include '../../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

// Reservation lists
$reservationList = [];

$reservations = new Reservations($connection);
$reservations = $reservations->getReservations();

$guests = new User($conn);

foreach ($reservations as $reservation) {
    $user = new User($conn);

    $user_name = $user->getGuests($reservation['GuestID']);
    $fullname = $user_name['FirstName'] . ' ' . $user_name['LastName'];
    if ($reservation['PackageID'] == 1) {
        $package = 'Package 1';
    } elseif ($reservation['PackageID'] == 2) {
        $package = 'Package 2';
    } elseif ($reservation['PackageID'] == 3) {
        $package = 'Package 3';
    }

    $date = $reservation['CheckInDate'];
    // make this readable
    $date = date('F j, Y', strtotime($date));

    // make the contact number readable
    $user_name['Phone'] = substr($user_name['Phone'], 0, 4) . ' ' . substr($user_name['Phone'], 4, 3) . ' ' . substr($user_name['Phone'], 7, 4);

    // make the total amount readable and comma separated
    $reservation['TotalAmount'] = number_format($reservation['TotalAmount'], 2);

    $reservationList[] = [
        "reservation_date" => $date,
        "package_name" => $package,
        "guest_name" => $fullname,
        "guest_contact" => $user_name['Phone'],
        "total_paid" => '₱ ' . $reservation['TotalAmount'],
        "status" => '<badge class="badge badge-pill badge-success">Status</badge>'
    ];
}

echo json_encode($reservationList);