<?php

include '../../../includes/autoloader.php';

$db = new Database();
$conn = $db->getConnection();
$session = new Session();

$GuestID = $session->get('user_id');
$feedbackText = $_POST['feedback'];

$feedback = new Feedback($conn);

$submitFeedback = $feedback->submitFeedback($feedbackText, $GuestID);

if ($submitFeedback) {
    header('Location: ../../user_dashboard/viewfeedbacks.php');
} else {
    header('Location: ../../user_dashboard/viewfeedbacks.php');
}