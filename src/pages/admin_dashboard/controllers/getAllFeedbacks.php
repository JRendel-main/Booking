<?php
include '../../../includes/autoloader.php';

$db = new Database();
$conn = $db->getConnection();

$feedback = new Feedback($conn);

$allFeedbacks = $feedback->getFeedbacks();
$feedbacks = array();
if ($allFeedbacks) {

    foreach ($allFeedbacks as $feedback) {
        // convert timestamp to human readable format
        $timestamp = date('F j, Y, g:i a', strtotime($feedback['timestamp']));

        $feedbacks[] = array(
            'feedback_id' => $feedback['feedback_id'],
            'feedback' => $feedback['feedback'],
            'guest_name' => $feedback['FirstName'] . ' ' . $feedback['LastName'],
            'timestamp' => $timestamp
        );
    }
}

echo json_encode($feedbacks);