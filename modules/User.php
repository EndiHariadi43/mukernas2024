<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($name, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
        return $stmt->execute();
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUsersByRole($role) {
        $query = "SELECT * FROM users WHERE role = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("s", $role);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUsersExcept($roles) {
        $query = "SELECT * FROM users WHERE role NOT IN (" . implode(',', array_fill(0, count($roles), '?')) . ")";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param(str_repeat('s', count($roles)), ...$roles);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
