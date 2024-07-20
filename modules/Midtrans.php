<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Midtrans\Config;
use Midtrans\Snap;

class Midtrans {
    public function __construct() {
        // Set konfigurasi Midtrans
        Config::$serverKey = 'Mid-server-qWN7Etrunv-9EM1CRWhgUkXo';
        Config::$isProduction = true;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($orderId, $amount, $customerDetails) {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => $customerDetails,
        ];

        return Snap::createTransaction($params)->redirect_url;
    }

    public function getSnapToken($orderId, $amount, $customerDetails) {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => $customerDetails,
        ];

        return Snap::getSnapToken($params);
    }
}
?>
