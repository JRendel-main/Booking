<?php

include '../../../includes/autoloader.php';

// Check if form is submitted
$id = $_GET['id'];

$db = new Database();
$connection = $db->getConnection();

$package = new Packages($connection);

$deletePackage = $package->deletePackage($id);

if ($deletePackage) {
    header('Location: ../packages.php?success=package_deleted');
} else {
    header('Location: ../packages.php?error=package_not_deleted');
}