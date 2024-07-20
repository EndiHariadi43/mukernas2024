<?php
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/modules/EventParticipant.php';

class EventParticipantController {
    private $db;
    private $eventParticipantModule;

    public function __construct($db) {
        $this->db = $db;
        $this->eventParticipantModule = new EventParticipant($db);
    }

    public function getParticipantsByEventId($event_id) {
        return $this->eventParticipantModule->getParticipantsByEventId($event_id);
    }

    public function addParticipant($event_id, $user_id) {
        if (!$this->isParticipant($event_id, $user_id)) {
            $result = $this->eventParticipantModule->addParticipant($event_id, $user_id);
            if ($result) {
                if ($_SESSION['user']['role'] == 'SuperAdmin' || $_SESSION['user']['role'] == 'Admin') {
                    header("Location: superadmin/manage_event_participants.php?event_id=$event_id");
                    exit();
                }
            }
            return $result;
        }
        return false; // Peserta sudah terdaftar
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

    public function removeParticipant($event_id, $user_id) {
        return $this->eventParticipantModule->removeParticipant($event_id, $user_id);
    }
}
?>
