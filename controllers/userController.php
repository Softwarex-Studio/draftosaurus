<?php
require_once __DIR__ . '/../config/database.php';

class UserController {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE email = :email AND active = 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password_hash'])) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['nickname'] = $user['nickname'];
                $_SESSION['is_admin'] = $user['is_admin'];
                return true;
            }
        }
        return false;
    }

    public function checkLogin() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return isset($_SESSION['nickname']);
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header("Location: /draftosaurus/index.php");
        exit();
    }

    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT user_id FROM Users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() !== false;
    }

    public function nicknameExists(string $nickname): bool {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Users WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    private function insertUser(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO Users (nickname, first_name, last_name, email, password_hash, active, is_admin)
            VALUES (:nickname, :first_name, :last_name, :email, :password_hash, 1, 0)
        ");
        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt->bindParam(':nickname', $data['nickname'], PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $passwordHash, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function register(array $data): array {
        $response = ['success' => false, 'error' => ''];

        if ($this->emailExists($data['email'])) {
            $response['error'] = 'El email ya existe.';
        } elseif ($this->nicknameExists($data['nickname'])) {
            $response['error'] = 'El nickname ya existe.';
        } else {
            if ($this->insertUser($data)) {
                $response['success'] = true;
            } else {
                $response['error'] = 'Error al registrar el usuario. Inténtalo de nuevo.';
            }
        }

        return $response;
    }

    public function getUserData() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) return null;

        $stmt = $this->db->prepare("
            SELECT user_id, nickname, first_name, last_name, email, is_admin 
            FROM Users WHERE user_id = :id
        ");
        $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNickname($nickname) {
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : false;
    }
}