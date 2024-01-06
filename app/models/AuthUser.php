<?php

class AuthUser
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `users` LIMIT 1');
        } catch (PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $roleTableQuery = "
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
-- DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id роли',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'название роли',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'описание роли',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idxunic_roles_name`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'user', 'can view');
INSERT INTO `roles` VALUES (2, 'manager', 'can edit');
INSERT INTO `roles` VALUES (3, 'admin', 'admin have all roles');

SET FOREIGN_KEY_CHECKS = 1;
        ";
        $userTableQuery = "
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id пользователя',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'имя пользователя',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'почта пользователя',
  `email_verification` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT 'адрес проверен?',
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'логин пользователя',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'пароль пользователя',
  `is_admin` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT 'это админ?',
  `is_active` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT 'учетная запись активна?',
  `role` int UNSIGNED NOT NULL DEFAULT 0 COMMENT 'id роли',
  `last_login` timestamp NULL DEFAULT NULL COMMENT 'время входа в учетную запись',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата создания учетной записи',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idxunic_users_login`(`login` ASC) USING BTREE,
  INDEX `role`(`role` ASC) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT 
INTO `users`
    (`id`, `name`, `email`, `email_verification`, `login`, `password`, `is_admin`, `is_active`, `role`, `last_login`, `created_at`)
VALUES 
    (1, 'ravik', 'ravik@ravik.com', 1, 'ravik', ?, 1, 1, 1, '2024-01-05 13:22:23', '2024-01-05 13:22:23'),
    (2, 'mule', 'mule@mule.com', 1, 'mule', ?, 0, 1, 2, '2024-01-05 13:23:26', '2024-01-05 13:23:28'),
    (3, 'tester', 'tester@tester.com', 1, 'tester', ?, 0, 1, 3, '2024-01-05 13:24:26', '2024-01-05 13:24:28');

SET FOREIGN_KEY_CHECKS = 1;
        ";
        try {
            $this->db->exec($roleTableQuery);
            $password = password_hash('password', PASSWORD_DEFAULT);
            $stmt = $this->db->prepare($userTableQuery);
            $stmt->execute([$password, $password, $password]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function register($data): bool
    {
        $name = $data['name'];
        $email = trim(strtolower($data['email']));
        $login = trim(strtolower($data['login']));
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = $data['role'];
        $query = "
INSERT 
    INTO `users` 
        (`name`, `email`, `login`, `password`, `role`) 
    VALUES 
        (?, ?, ?, ?, ?)
        ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$name, $email, $login, $password, $role]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
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
            return $user;
        }
        return false;
    }
}
