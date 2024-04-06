<?php
include '../../../includes/autoloader.php';

$reservationID = $_POST['id'];

$db = new Database();
$connection = $db->getConnection();

$reservation = new Reservations($connection);
$cancelReservation = $reservation->cancelReservation($reservationID);

if ($cancelReservation) {

    $vendor = '../../../../vendor/autoload.php';
    $email = new Email($vendor);
    $reservationDetails = $reservation->getReservationUser($reservationID);

    $user = new GetUser($connection);
    $userDetails = $user->getUserbyId($reservationDetails['GuestID']);
    $to = $userDetails['Email'];
    $subject = 'Reservation Cancelled';
    $type = 'reservation_cancelled';
    $message = "
        <p>Hi {$userDetails['FirstName']} {$userDetails['LastName']},</p>
        <p>Your reservation with Reservation Name: {$reservationDetails['ReservationID']} has been cancelled.</p>
        <p>For more information, please contact us at <a href='mailto:officialnexuslink@gmail.com'>
    ";
    $email->sendEmail($to, $subject, $type, $message);

    if ($email) {
        $response = [
            'status' => 'success',
            'message' => 'Reservation cancelled successfully. Email sent to user'
        ];
    } else {
        $response = [
            'status' => 'success',
            'message' => 'Reservation cancelled successfully. Failed to send email to user'
        ];

    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Failed to cancel reservation'
    ];
}

echo json_encode($response);