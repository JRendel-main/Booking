<?php
include '../../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

// Reservation lists
$reservationList = [];

$reservations = new Reservations($connection);
$reservations = $reservations->getPendingReservation();

$guests = new User($conn);

foreach ($reservations as $reservation) {
    $user = new User($conn);

    $user_name = $user->getGuests($reservation['GuestID']);
    $fullname = $user_name['FirstName'] . ' ' . $user_name['LastName'];
    $package = new Packages($connection);
    $package = $package->getPackage($reservation['PackageID']);

    $date = $reservation['CheckInDate'];
    // make this readable
    $date = date('F j, Y', strtotime($date));

    // make the contact number readable
    $user_name['Phone'] = substr($user_name['Phone'], 0, 4) . ' ' . substr($user_name['Phone'], 4, 3) . ' ' . substr($user_name['Phone'], 7, 4);

    // make the total amount readable and comma separated
    $reservation['TotalAmount'] = number_format($reservation['TotalAmount'], 2);

    if ($reservation['status'] == 'pending') {
        $badge = '<badge class="badge badge-pill badge-warning">Pending</badge>';
    } elseif ($reservation['status'] == 'approved') {
        $badge = '<badge class="badge badge-pill badge-success">Approved</badge>';
    } elseif ($reservation['status'] == 'declined') {
        $badge = '<badge class="badge badge-pill badge-danger">Declined</badge>';
    }

    // if the date is past the current date, change the badge to expired
    if (strtotime($reservation['CheckInDate']) < strtotime(date('Y-m-d'))) {
        $badge = '<badge class="badge badge-pill badge-info">Finished</badge>';
    }
    $reservationList[] = [
        "reservation_id" => $reservation['ReservationID'],
        "reservation_date" => $date,
        "package_name" => $package,
        "guest_name" => $fullname,
        "guest_contact" => $user_name['Phone'],
        "total_paid" => '₱ ' . $reservation['TotalAmount'],
        "status" => $badge
    ];
}

echo json_encode($reservationList);