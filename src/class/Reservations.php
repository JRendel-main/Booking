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
        $query = "SELECT * FROM reservations where status = 'approved'";
        $result = $this->conn->query($query);
        $reservations = [];
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
        return $reservations;
    }

    public function getPendingReservation()
    {
        $query = "SELECT * FROM reservations WHERE status = 'pending'";
        $result = $this->conn->query($query);
        $reservations = [];
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
        return $reservations;
    }

    public function getReservationUser($reservation_id)
    {
        $query = "SELECT * FROM reservations WHERE ReservationID = $reservation_id";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getTotalReservations()
    {
        $query = "SELECT COUNT(*) as total_reservations FROM reservations";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total_reservations'];
    }

    public function cancelReservation($reservation_id)
    {
        $query = "UPDATE reservations SET status = 'cancelled' WHERE ReservationID = $reservation_id";
        $result = $this->conn->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}