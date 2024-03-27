<?php
include '../../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

$packages = new Packages($connection);
$result = $packages->getStandardPackage();

// check if there are any packages
if ($result) {
    echo ($result);
} else {
    echo json_encode(array('message' => 'No packages found'));
}