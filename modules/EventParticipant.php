<?php
class EventParticipant {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getParticipantsByEventId($event_id) {
        $query = "SELECT users.id, users.name, users.email FROM event_participants 
                  JOIN users ON event_participants.user_id = users.id 
                  WHERE event_participants.event_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function addParticipant($event_id, $user_id) {
        // Validasi sebelum menambahkan peserta untuk menghindari duplikasi
        if (!$this->isParticipant($event_id, $user_id)) {
            $query = "INSERT INTO event_participants (event_id, user_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $event_id, $user_id);
            return $stmt->execute();
        }
        return false; // Peserta sudah terdaftar
    }    

    public function removeParticipant($event_id, $user_id) {
        $query = "DELETE FROM event_participants WHERE event_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $event_id, $user_id);
        return $stmt->execute();
    }

    public function isParticipant($event_id, $user_id) {
        $query = "SELECT COUNT(*) FROM event_participants WHERE event_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $event_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }
}
?>
