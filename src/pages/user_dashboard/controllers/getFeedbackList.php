<?php

$conn = new Database();
$feedback = new Feedback($conn);

$feedbacks = $feedback->getFeedbacks();

$feedback_list = [];

// if feedback is empty
if (empty($feedbacks)) {
    $feedback_list = [
        'status' => 'error',
        'message' => 'No feedbacks found'
    ];
} else {
    $user = new User($conn);

}