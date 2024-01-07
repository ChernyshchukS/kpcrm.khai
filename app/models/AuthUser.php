<?php
require_once 'app/models/User.php';

class AuthUser
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `users` LIMIT 1');
        } catch (PDOException $e) {
            $user = new User();
        }
    }

    public function register($data): bool
    {
        $user = new User();
        return $user->create($data);
//        $name = $data['name'];
//        $email = trim(strtolower($data['email']));
//        $login = trim(strtolower($data['login']));
//        $password = password_hash($data['password'], PASSWORD_DEFAULT);
//        $role = $data['role'];
//        $query = "
//INSERT
//    INTO `users`
//        (`name`, `email`, `login`, `password`, `role`)
//    VALUES
//        (?, ?, ?, ?, ?)
//        ";
//        try {
//            $stmt = $this->db->prepare($query);
//            $stmt->execute([$name, $email, $login, $password, $role]);
//            return true;
//        } catch (PDOException $e) {
//            return false;
//        }
    }

    public function findByEmail($email)
    {
        $email = strtolower($email);
        $query = "SELECT * FROM `users` WHERE email = ? LIMIT 1";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user
            && password_verify($password, $user['password'])) {
            $this->lastLogin($email);
            return $user;
        }
        return false;
    }

    public function lastLogin($email): bool
    {
        $email = strtolower($email);
        $query = "
UPDATE `users` SET `last_login` = NOW()
    WHERE `email` = ?
                ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
