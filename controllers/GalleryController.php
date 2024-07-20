<?php
class GalleryController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPhotos() {
        $query = "SELECT g.*, e.title AS event_title, e.event_date FROM galleries g LEFT JOIN events e ON g.event_id = e.id ORDER BY g.uploaded_at DESC";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPhotosByPage($limit, $offset) {
        $query = "SELECT g.*, e.title AS event_title, e.event_date 
                  FROM galleries g 
                  LEFT JOIN events e ON g.event_id = e.id 
                  ORDER BY g.uploaded_at DESC 
                  LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalPhotos() {
        $query = "SELECT COUNT(*) as total FROM galleries";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getAllEvents() {
        $query = "SELECT id, title, event_date FROM events ORDER BY event_date DESC";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function uploadPhotos($event_id, $photos) {
        foreach ($photos['name'] as $key => $photoName) {
            $photoTmpName = $photos['tmp_name'][$key];
            $target_dir = "../uploads/gallery/";
            $target_file = $target_dir . basename($photoName);
            move_uploaded_file($photoTmpName, $target_file);

            $query = "INSERT INTO galleries (event_id, photo) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            if ($stmt === false) {
                throw new Exception('Failed to prepare statement: ' . $this->db->error);
            }

            // Allow null value for event_id
            if ($event_id === '') {
                $stmt->bind_param("is", $null, $target_file);
            } else {
                $stmt->bind_param("is", $event_id, $target_file);
            }
            
            $stmt->execute();
        }
    }

    public function deletePhoto($id) {
        $query = "DELETE FROM galleries WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
