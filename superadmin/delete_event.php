<?php
session_start();
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/EventController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: ../login");
    exit();
}

$db = new Database();
$eventController = new EventController($db);

if (isset($_GET['id'])) {
    $eventController->deleteEvent($_GET['id']);
}

header("Location: manage_events.php");
exit();
?>
