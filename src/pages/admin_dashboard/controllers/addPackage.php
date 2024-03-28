<?php
include '../../../includes/autoloader.php';

$packageName = $_POST['packageName'];
$packagePrice = $_POST['packagePrice'];
$packageDescription = $_POST['packageDescription'];
$packageType = $_POST['packageType'];

$db = new Database();
$connection = $db->getConnection();

$package = new Packages($connection);
$package->addPackage($packageName, $packagePrice, $packageDescription, $packageType);

if ($package) {
    $response = [
        'status' => 'success',
        'message' => 'Package added successfully'
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Failed to add package'
    ];
}

echo json_encode($response);