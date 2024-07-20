<?php
class EventController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllEvents() {
        $query = "SELECT * FROM events";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getEventById($id) {
        $query = "SELECT * FROM events WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createEvent($title, $description, $start_date, $end_date, $address, $location, $image) {
        $imagePath = $this->uploadImage($image);
        $query = "INSERT INTO events (title, description, start_date, end_date, address, location, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssss", $title, $description, $start_date, $end_date, $address, $location, $imagePath);
        $stmt->execute();
    }

    public function updateEvent($id, $title, $description, $start_date, $end_date, $address, $location, $image) {
        if ($image['size'] > 0) {
            $imagePath = $this->uploadImage($image);
        } else {
            $event = $this->getEventById($id);
            $imagePath = $event['image'];
        }

        $query = "UPDATE events SET title = ?, description = ?, start_date = ?, end_date = ?, address = ?, location = ?, image = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssi", $title, $description, $start_date, $end_date, $address, $location, $imagePath, $id);
        $stmt->execute();
    }

    public function deleteEvent($id) {
        $query = "DELETE FROM events WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    private function uploadImage($image) {
        $targetDir = "../uploads/event_images/";
        $targetFile = $targetDir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $targetFile);
        return $targetFile;
    }

    public static function formatTanggalIndonesia($tanggal) {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
?>
