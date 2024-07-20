<?php
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/AuthController.php';

$db = new Database();
$authController = new AuthController($db);

$token = $_GET['token'];

if ($authController->verifyEmail($token)) {
    echo "Akun Anda telah diverifikasi. Anda dapat login sekarang.";
} else {
    echo "Verifikasi gagal. Token tidak valid.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verifikasi Akun - FK-PKPPS Ponpes</title>
</head>
<body>
    <h1><?php echo $message; ?></h1>
    <a href="<?php echo BASE_URL; ?>login">Login</a>
</body>
</html>
