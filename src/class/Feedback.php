<?php
class Feedback
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getFeedbacks()
    {
        $sql = "SELECT * FROM feedbacks";
        $result = $this->conn->query($sql);
        $feedbacks = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $feedbacks[] = $row;
            }
        }
        return $feedbacks;
    }
}