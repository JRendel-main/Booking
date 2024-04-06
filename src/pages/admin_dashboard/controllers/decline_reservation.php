<?php
include '../../../includes/autoloader.php';

// Check if reservation ID is provided
if (!isset($_GET['id'])) {
    header('Location: ../dashboard.php?error=Reservation ID not provided');
    exit();
}

$reservation_id = $_GET['id'];

// Instantiate database connection
$conn = new Database();
$connection = $conn->getConnection();

// Instantiate Reservations object
$reservation = new Reservations($connection);

// Decline the reservation
$declineReservation = $reservation->declineReservation($reservation_id);

if ($declineReservation) {
    // Fetch user details for sending email
    $guest_id = $reservation->getReservationUser($reservation_id)['GuestID'];
    $user = new GetUser($connection);
    $userDetails = $user->getUserbyId($guest_id);

    // Fetch reservation details
    $reservationDetails = $reservation->getReservationDetails($reservation_id);
    $reservationDate = $reservationDetails['CheckInDate'];

    // Convert date to human-readable format
    $reservationDate = date('F j, Y', strtotime($reservationDate));

    // Prepare email content
    $vendor = '../../../../vendor/autoload.php';
    $email = new Email($vendor);
    $to = $userDetails['Email'];
    $subject = 'Reservation Declined';
    $type = 'reservation_declined';
    $message = "
        <p>Hi {$userDetails['FirstName']} {$userDetails['LastName']},</p>
        <p>Your reservation for {$reservationDate} has been declined.</p>
        <p>For further inquiries, please contact us at <a href='mailto:officialnexuslink@gmail.com'>villaresort@gmail.com</a>.</p>
    ";

    // Send email notification
    $emailSent = $email->sendEmail($to, $subject, $type, $message);

    // Redirect with appropriate message based on email sending result
    if ($emailSent) {
        header('Location: ../dashboard.php?reservation=Reservation declined successfully. Email sent to user');
    } else {
        header('Location: ../dashboard.php?reservation=Reservation declined successfully. Failed to send email to user');
    }
} else {
    // Redirect with error message if decline operation fails
    header('Location: ../dashboard.php?error=Failed to decline reservation');
}