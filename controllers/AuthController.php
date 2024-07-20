<?php
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/modules/User.php';

class AuthController {
    private $db;
    private $userModule;

    public function __construct($db) {
        $this->db = $db;
        $this->userModule = new User($db);
    }

    public function getMessages() {
        return $this->db->getMessages();
    }

    public function login($email, $password) {
        $user = $this->userModule->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $this->createUserSession($user['id']);
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function register($name, $email, $password, $role) {
        if ($this->userModule->getUserByEmail($email)) {
            throw new Exception('Email sudah terdaftar!');
        }
        return $this->userModule->createUser($name, $email, $password, $role);
    }

    public function logout() {
        if (isset($_COOKIE['session_token'])) {
            $session_token = $_COOKIE['session_token'];
            $query = "DELETE FROM user_sessions WHERE session_token = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $session_token);
            $stmt->execute();

            setcookie('session_token', '', time() - 3600, "/");
        }
        session_destroy();
    }

    public function getUsersByRole($role) {
        return $this->userModule->getUsersByRole($role);
    }

    public function getAllUsers() {
        return $this->userModule->getAllUsers();
    }

    public function getAllUsersExcept($roles) {
        return $this->userModule->getAllUsersExcept($roles);
    }

    public function deleteUser($id) {
        return $this->userModule->deleteUser($id);
    }

    private function createUserSession($user_id) {
        $session_token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+30 days')); // Sesi berlaku selama 30 hari

        $query = "INSERT INTO user_sessions (user_id, session_token, expires_at) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", $user_id, $session_token, $expires_at);
        $stmt->execute();

        setcookie('session_token', $session_token, time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
    }

    public function checkUserSession() {
        if (isset($_COOKIE['session_token'])) {
            $session_token = $_COOKIE['session_token'];
            $query = "SELECT user_id FROM user_sessions WHERE session_token = ? AND expires_at > NOW()";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $session_token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user = $this->userModule->getUserById($row['user_id']);
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }

    public function getTotalUsers() {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getTotalLogins() {
        $query = "SELECT SUM(login_count) as total FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
    
    public function getUserById($userId) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateProfile($user_id, $data) {
        $query = "UPDATE users SET 
                    name = ?, 
                    email = ?, 
                    username = ?, 
                    birth_place = ?, 
                    birth_date = ?, 
                    institution = ?, 
                    institution_address = ?, 
                    sub_district = ?, 
                    district = ?, 
                    city = ?, 
                    province = ?, 
                    short_notes = ?, 
                    profile_pic = ? 
                  WHERE id = ?";
    
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
    
        $stmt->bind_param(
            "sssssssssssssi", 
            $data['name'], 
            $data['email'], 
            $data['username'], 
            $data['birth_place'], 
            $data['birth_date'], 
            $data['institution'], 
            $data['institution_address'], 
            $data['sub_district'], 
            $data['district'], 
            $data['city'], 
            $data['province'], 
            $data['short_notes'], 
            $data['profile_pic'], 
            $user_id
        );
    
        return $stmt->execute();
    }  
    
    
}
?>
