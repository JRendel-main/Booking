<?php
include '../../../includes/autoloader.php';
$reservation_id = $_GET['id'];

$conn = new Database();
$connection = $conn->getConnection();

$reservation = new Reservations($connection);
$approveReservation = $reservation->approveReservation($reservation_id);

$guest_id = $reservation->getReservationUser($reservation_id)['GuestID'];
$user = new GetUser($connection);
$userDetails = $user->getUserbyId($guest_id);

$reservationDetails = $reservation->getReservationDetails($reservation_id);
$reservationDate = $reservationDetails['CheckInDate'];

// convert date to human readable format
$reservationDate = date('F j, Y', strtotime($reservationDate));

if ($approveReservation) {
    $vendor = '../../../../vendor/autoload.php';
    $email = new Email($vendor);
    $to = $userDetails['Email'];
    $subject = 'Reservation Approved';
    $type = 'reservation_approved';
    $message = "
        <p>Hi {$userDetails['FirstName']} {$userDetails['LastName']},</p>
        <p>Your reservation at: {$reservationDate} has been approved.</p>
        <p>For more information, please contact us at <a href='mailto:officialnexuslink@gmail.com'>villaresort@gmail.com'</a></p>
    ";
    $email->sendEmail($to, $subject, $type, $message);

    if ($email) {
        header('Location: ../dashboard.php?reservation=Reservation approved successfully. Email sent to user');
    } else {
        header('Location: ../dashboard.php?reservation=Reservation approved successfully. Failed to send email to user');
    }
}