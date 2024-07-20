<?php
file_put_contents('tes_notification.log', date('Y-m-d H:i:s') . ' - ' . file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
?>
