<?php
class Event {
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
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $start_date = htmlspecialchars($start_date);
        $end_date = htmlspecialchars($end_date);
        $address = htmlspecialchars($address);
        $location = htmlspecialchars($location);
        $image = htmlspecialchars($image);

        $query = "INSERT INTO events (title, description, start_date, end_date, address, location, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssss", $title, $description, $start_date, $end_date, $address, $location, $image);
        return $stmt->execute();
    }

    public function updateEvent($id, $title, $description, $start_date, $end_date, $address, $location, $image) {
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $start_date = htmlspecialchars($start_date);
        $end_date = htmlspecialchars($end_date);
        $address = htmlspecialchars($address);
        $location = htmlspecialchars($location);
        $image = htmlspecialchars($image);

        $query = "UPDATE events SET title = ?, description = ?, start_date = ?, end_date = ?, address = ?, location = ?, image = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssi", $title, $description, $start_date, $end_date, $address, $location, $image, $id);
        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $query = "DELETE FROM events WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
