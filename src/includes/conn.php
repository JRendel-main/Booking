<?php

class conn
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "booking_system";

    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function __destruct()
    {
        $this->conn->close();
    }
}