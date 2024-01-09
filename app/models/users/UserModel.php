<?php
require_once 'app/models/roles/RoleModel.php';
class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `users` LIMIT 1');
        } catch (PDOException $e) {
            $role = new RoleModel();
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
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
  UNIQUE INDEX `idxunic_users_email`(`email` ASC) USING BTREE,
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
            $password = password_hash('password', PASSWORD_DEFAULT);
            $stmt = $this->db->prepare($userTableQuery);
            $stmt->execute([$password, $password, $password]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function readAll()
    {
        $query = "
SELECT `id`,
       `name`,
       `email`,
       (SELECT IF(users.email_verification = 1, 'Yes', 'No')) AS `email_verification`,
       `login`,
       (SELECT IF(users.is_admin = 1, 'Yes', 'No')) AS `is_admin`,
       (SELECT IF(users.is_active = 1, 'Yes', 'No')) AS `is_active`,
       (SELECT `name` FROM `roles` WHERE `roles`.`id` = `users`.role) AS `role`,
       `last_login`,
       `created_at`
FROM `users`
        ";
        try {
            $stmt = $this->db->query($query);
            $result = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function create($data): bool
    {
        $name = $data['name'];
        $email = trim(strtolower($data['email']));
        $login = trim(strtolower($data['login']));
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = RoleModel::DEFAULT_USER; //назначаем роль по умолчанию
        //$role = $data['role'];
        //$password = $data['password'];
        //$create_at = date('Y-m-d H:i:s');

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

    public function delete($id): bool
    {
        $query = "DELETE FROM `users` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM `users` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data): bool
    {
        $id = $data['id'];
        $name = $data['name'];
        $email = trim(strtolower($data['email']));
        $login = trim(strtolower($data['login']));
        $role = $data['role'];

        $query = "UPDATE `users` SET `name` = ?, `email` = ?, `login` = ?, `role` = ?
                WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$name, $email, $login, $role, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
