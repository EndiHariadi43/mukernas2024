<?php
session_start();
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/DonationController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: ../login.php");
    exit();
}

$db = new Database();
$donationController = new DonationController($db);

if (isset($_GET['id'])) {
    $donationController->deleteDonation($_GET['id']);
}

header("Location: manage_donations.php");
exit();
?>
