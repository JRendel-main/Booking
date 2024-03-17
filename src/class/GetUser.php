<?php
class getUser
{
    protected $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserbyEmail($email)
    {
        $sql = "SELECT * FROM guests WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        // get the GuestId only
        $row = $result->fetch_assoc();
        return $row['GuestId'];
    }
}