<?php 

class Packages {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPackages() {
        $query = "SELECT * FROM packages";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}