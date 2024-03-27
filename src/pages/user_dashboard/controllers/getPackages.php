<?php
include '../../../includes/autoloader.php';

$conn = new Database();
$connection = $conn->getConnection();

$packages = new Packages($connection);
$packages = $packages->getAllPackage();

$packageList = [];

foreach ($packages as $package) {
    $packageList[] = [
        "package_id" => $package['PackageID'],
        "package_name" => $package['PackageName'],
        "package_description" => $package['PackageDescription'],
        "package_price" => '₱ ' . number_format($package['PackagePrice'], 2),
        "package_image" => $package['PackageImage']
    ];
}