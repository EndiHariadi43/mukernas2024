<?php
class Database {
    private $host = 'localhost';
    private $user = 'developer';
    private $pass = 'developer';
    private $dbname = 'ponpes';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function getMessages() {
        $query = "SELECT * FROM messages ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->conn->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
