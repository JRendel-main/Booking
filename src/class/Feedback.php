<?php
date_default_timezone_set('Asia/Manila');
class Feedback
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getFeedbacks()
    {
        $sql = "SELECT a.*, b.* FROM feedbacks a, guests b WHERE a.GuestID = b.GuestID";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $feedbacks = array();
            while ($row = $result->fetch_assoc()) {
                $feedbacks[] = $row;
            }
            return $feedbacks;
        } else {
            return false;
        }
    }

    public function checkAlreadySubmitted($GuestID)
    {
        $sql = "SELECT * FROM feedbacks WHERE GuestID = '$GuestID'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkForFeedback($GuestID)
    {
        // query for check on reservation table if the user already done on reservation on column CheckInDate and check status if approved also
        $sql = "SELECT * FROM reservations WHERE GuestID = '$GuestID' AND status = 'approved'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function submitFeedback($feedback, $GuestID)
    {
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO feedbacks (feedback, GuestID, timestamp) VALUES ('$feedback', $GuestID, '$timestamp')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFeedback($feedback_id)
    {
        $sql = "DELETE FROM feedbacks WHERE feedback_id = $feedback_id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}