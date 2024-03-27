<?php

$package_id = $_POST['packageId'];

include '../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

$packages = new Packages($connection);
$package = $packages->getCost($package_id);

echo $package;