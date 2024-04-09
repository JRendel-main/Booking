<?php
include '../../../includes/autoloader.php';

$feedback_id = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

$feedback = new Feedback($conn);
$deleteFeedback = $feedback->deleteFeedback($feedback_id);

if ($deleteFeedback) {
    header('Location: ../feedback.php?success=Feedback deleted successfully');
    exit();
} else {
    header('Location: ../feedback.php?error=Failed to delete feedback');
    exit();
}