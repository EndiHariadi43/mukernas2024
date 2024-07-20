<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-dGC4OklhS8JrmTY4i9e5dxly';
\Midtrans\Config::$isProduction = false; // Ubah ke true untuk mode produksi
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
$snapToken = \Midtrans\Snap::getSnapToken($params);
?>
