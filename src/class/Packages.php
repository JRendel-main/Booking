<?php

class Packages
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getStandardPackage()
    {
        $query = "SELECT * FROM packages WHERE type = 'standard'";
        $result = $this->conn->query($query);
        $packages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $packages[] = $row;
            }
        } else {
            $packages[] = '';
        }
        return json_encode($packages);
    }

    public function getCustomPackage()
    {
        $query = "SELECT * FROM packages WHERE type = 'custom'";
        $result = $this->conn->query($query);
        $packages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $packages[] = $row;
            }
        } else {
            $packages[] = null;
        }
        return json_encode($packages);
    }

    public function getAllPackage()
    {
        $query = "SELECT * FROM packages";
        $result = $this->conn->query($query);
        $packages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $packages[] = $row;
            }
        } else {
            $packages[] = null;
        }
        return json_encode($packages);
    }

    public function getCost($PackageID)
    {
        $query = "SELECT Price FROM packages WHERE PackageID = $PackageID";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $package = $row;
            }
        } else {
            $package = null;
        }
        return json_encode($package);
    }

    public function addPackage($packageName, $packagePrice, $packageDescription, $packageType)
    {
        $query = "INSERT INTO packages (PackageName, Price, Description, type) VALUES ('$packageName', '$packagePrice', '$packageDescription', '$packageType')";

        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}