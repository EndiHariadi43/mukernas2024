<?php
session_start();
require_once dirname(__DIR__) . '/modules/Database.php';
require_once 'AuthController.php';

$db = new Database();
$authController = new AuthController($db);

$authController->logout();

header("Location: /");
exit();
?>
