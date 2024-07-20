<?php
session_start();
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/AuthController.php';
require_once 'modules/Mail.php';
$db = new Database();
$authController = new AuthController($db);
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];
$verification_token = bin2hex(random_bytes(32));
if ($authController->updateUserToken($user['id'], $verification_token)) {
    if (Mail::sendVerificationEmail($user['email'], $verification_token)) {
        echo "Email verifikasi telah dikirim ulang.";
    } else {
        echo "Gagal mengirim email verifikasi.";
    }
}
?>
