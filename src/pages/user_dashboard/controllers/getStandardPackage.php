<?php
$conn = new Database();
$connection = $conn->getConnection();

$packages = new Packages($connection);
$packages = $packages->getStandardPackage();

$packageList = [];

if (is_array($packages)) {
    foreach ($packages as $package) {
        $packageList[] = [
            "package_id" => $package['PackageID'],
            "package_name" => $package['PackageName'],
            "package_description" => $package['PackageDescription'],
            "package_price" => '₱ ' . number_format($package['Price'], 2),
            "package_image" => $package['PackageImage']
        ];
    }
}