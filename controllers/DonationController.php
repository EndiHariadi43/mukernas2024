<?php
require_once dirname(__DIR__) . '/modules/Midtrans.php';
require_once dirname(__DIR__) . '/modules/Donation.php';

class DonationController {
    private $db;
    private $midtrans;
    private $donation;

    public function __construct($db) {
        $this->db = $db;
        $this->midtrans = new Midtrans();
        $this->donation = new Donation($db);
    }

    public function createDonation($donor_name, $amount) {
        $orderId = 'order-' . time(); // Unique order ID
        $customerDetails = [
            'first_name' => $donor_name,
            'email' => '', // Optionally add email or other details
        ];

        try {
            $snapToken = $this->midtrans->getSnapToken($orderId, $amount, $customerDetails);

            // Save the donation to the database
            $stmt = $this->db->prepare("INSERT INTO donations (order_id, donor_name, amount, snap_token) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $orderId, $donor_name, $amount, $snapToken);
            $stmt->execute();

            return $snapToken;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAllDonations() {
        return $this->donation->getAllDonations();
    }

    public function getDonationById($id) {
        return $this->donation->getDonationById($id);
    }

    public function updateDonation($id, $donor_name, $amount) {
        return $this->donation->updateDonation($id, $donor_name, $amount);
    }

    public function deleteDonation($id) {
        return $this->donation->deleteDonation($id);
    }
}
?>
