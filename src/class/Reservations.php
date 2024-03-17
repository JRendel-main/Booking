<?php

class Reservations
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function getReservations()
    {
        $query = "SELECT * FROM reservations";
        $result = $this->conn->query($query);
        $reservations = [];
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
        return $reservations;
    }

    public function getTotalReservations()
    {
        $query = "SELECT COUNT(*) as total_reservations FROM reservations";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total_reservations'];
    }
}