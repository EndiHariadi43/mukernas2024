<?php
session_start();
require_once 'modules/Database.php';

$base_url = '/';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'Please log in to send a message.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $db = new Database();
    $query = "INSERT INTO messages (full_name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt === false) {
        die('Failed to prepare statement: ' . $db->error);
    }

    $stmt->bind_param('ssss', $full_name, $email, $phone, $message);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Pesan berhasil dikirim.';
    } else {
        $_SESSION['error'] = 'Gagal mengirim pesan.';
    }

    $stmt->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
