<?php
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'vendor/midtrans/midtrans-php/Midtrans.php';
\Midtrans\Config::$serverKey = 'Mid-server-qWN7Etrunv-9EM1CRWhgUkXo';
\Midtrans\Config::$isProduction = true;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
// Log
$logFile = 'notification.log';
$logData = date('Y-m-d H:i:s') . ' - ' . file_get_contents('php://input') . PHP_EOL;
file_put_contents($logFile, $logData, FILE_APPEND);

try {
    $notif = new \Midtrans\Notification();
    $transaction = $notif->transaction_status;
    $order_id = $notif->order_id;
    $fraud = $notif->fraud_status;

    $db = new Database();

    if ($transaction == 'capture') {
        if ($fraud == 'challenge') {
            $stmt = $db->prepare("UPDATE donations SET status = 'challenge' WHERE order_id = ?");
            $stmt->bind_param("s", $order_id);
            $stmt->execute();
        } else if ($fraud == 'accept') {
            $stmt = $db->prepare("UPDATE donations SET status = 'success' WHERE order_id = ?");
            $stmt->bind_param("s", $order_id);
            $stmt->execute();
        }
    } else if ($transaction == 'settlement') {
        $stmt = $db->prepare("UPDATE donations SET status = 'success' WHERE order_id = ?");
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
    } else if ($transaction == 'cancel' || $transaction == 'deny' || $transaction == 'expire') {
        $stmt = $db->prepare("UPDATE donations SET status = 'failed' WHERE order_id = ?");
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
    } else if ($transaction == 'pending') {
        $stmt = $db->prepare("UPDATE donations SET status = 'pending' WHERE order_id = ?");
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
    }
} catch (Exception $e) {
    file_put_contents('notification_error.log', date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
}
?>
