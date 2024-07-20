<?php
class Donation {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllDonations() {
        $query = "SELECT * FROM donations";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->db->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getDonationById($id) {
        $query = "SELECT * FROM donations WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->db->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createDonation($donor_name, $amount) {
        $donor_name = htmlspecialchars($donor_name);
        $amount = floatval($amount);

        $query = "INSERT INTO donations (donor_name, amount) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->db->error);
        }
        $stmt->bind_param("sd", $donor_name, $amount);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Failed to create donation: " . $stmt->error);
        }
    }

    public function updateDonation($id, $donor_name, $amount) {
        $donor_name = htmlspecialchars($donor_name);
        $amount = floatval($amount);

        $query = "UPDATE donations SET donor_name = ?, amount = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->db->error);
        }
        $stmt->bind_param("sdi", $donor_name, $amount, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Failed to update donation: " . $stmt->error);
        }
    }

    public function deleteDonation($id) {
        $query = "DELETE FROM donations WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->db->error);
        }
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Failed to delete donation: " . $stmt->error);
        }
    }
}
?>
