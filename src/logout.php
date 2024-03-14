<?php
include 'includes/autoloader.php';

$session = new Session();
$session->destroy();
header('Location: index.php');