<?php

include 'includes/autoloader.php';
$db = new Database();
$conn = $db->getConnection();

$report_type = $_POST['reportType'];

if ($report_type == 'guests') {
    $user = new User($db);
    $users = $user->getAllGuest();

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="guests_lists.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['First Name', 'Last Name', 'Email', 'Phone Number', 'Address']);

    foreach ($users as $user) {
        fputcsv($output, [$user['FirstName'], $user['LastName'], $user['Email'], $user['Phone'], $user['Address']]);
    }

    fclose($output);
    exit();
} else if ($report_type == 'reservations') {
    $reservation = new Reservations($conn);
    $reservationList = $reservation->getAllReservations();

    // Create an empty array to store reservation details
    $reservationDetails = [];

    // Loop through each reservation and collect details
    foreach ($reservationList as $reservationItem) {
        $user = new GetUser($conn);
        $guest = $user->getUserbyId($reservationItem['GuestID']);

        $packages = new Packages($conn);
        $package = $packages->getPackageDetails($reservationItem['PackageID']);

        $CheckInDate = date('Y-m-d', strtotime($reservationItem['CheckInDate']));

        // Add reservation details to the array
        $reservationDetails[] = [
            'Reservation ID' => $reservationItem['ReservationID'],
            'Guest Name' => $guest['FirstName'] . ' ' . $guest['LastName'],
            'Package Name' => $package['PackageName'],
            'Package Price' => $reservationItem['TotalAmount'],
            'Check In' => $CheckInDate,
            'Status' => $reservationItem['status']
        ];
    }

    // Set CSV file headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="reservations_lists.csv"');

    // Open file handle for writing
    $output = fopen('php://output', 'w');

    // Write CSV headers
    fputcsv($output, ['Reservation ID', 'Guest Name', 'Package Name', 'Package Price', 'Check In', 'Status']);

    // Loop through reservation details and write data to CSV
    foreach ($reservationDetails as $reservation) {
        fputcsv($output, $reservation);
    }

    // Close file handle
    fclose($output);
    exit();

} else if ($report_type == 'payments') {
    $payment = new Payment($conn);
    $paymentList = $payment->getAllPayments();

    // Create an empty array to store payment details
    $paymentDetails = [];

    // Loop through each payment and collect details
    foreach ($paymentList as $paymentItem) {
        $reservation = new Reservations($conn);
        $reservationDetails = $reservation->getReservationDetails($paymentItem['ReservationID']);

        $user = new GetUser($conn);
        $guest = $user->getUserbyId($reservationDetails['GuestID']);

        $packages = new Packages($conn);
        $package = $packages->getPackageDetails($reservationDetails['PackageID']);

        $CheckInDate = date('Y-m-d', strtotime($reservationDetails['CheckInDate']));

        // Add payment details to the array
        $paymentDetails[] = [
            'Payment ID' => $paymentItem['PaymentID'],
            'Reservation ID' => $paymentItem['ReservationID'],
            'Guest Name' => $guest['FirstName'] . ' ' . $guest['LastName'],
            'Package Name' => $package['PackageName'],
            'Amount' => $paymentItem['AmountPaid'],
            'Payment Date' => $paymentItem['PaymentDate']
        ];
    }

    // Set CSV file headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="payments_lists.csv"');

    // Open file handle for writing
    $output = fopen('php://output', 'w');

    // Write CSV headers
    fputcsv($output, ['Payment ID', 'Reservation ID', 'Guest Name', 'Package Name', 'Amount', 'Payment Date']);

    // Loop through payment details and write data to CSV
    foreach ($paymentDetails as $payment) {
        fputcsv($output, $payment);
    }

    // Close file handle
    fclose($output);
    exit();
} else {
    echo 'Invalid report type';
    exit;
}