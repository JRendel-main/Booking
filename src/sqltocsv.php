<?php
include 'includes/autoloader.php';

$db = new Database();
$user = new User($db);

$users = $user->getAllGuest();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="guests.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'First Name', 'Last Name', 'Address', 'Email', 'Phone']);

foreach ($users as $user) {
    fputcsv($output, $user);
}

fclose($output);