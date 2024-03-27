<?php
include '../../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

$packages = new Packages($connection);
$result = $packages->getCustomPackage();

// check if package is not null
if ($result != null) {
    echo ($result);
} else {
    echo null;
}