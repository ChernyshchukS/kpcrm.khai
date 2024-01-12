<?php

namespace models\todo\categories;

use models\Database;

class CategoryModel
{
    private $db;
    const DEFAULT_USER = 5;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `todo_categories` LIMIT 1');
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $query = "
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for todo_categories
-- ----------------------------
DROP TABLE IF EXISTS `todo_categories`;
CREATE TABLE `todo_categories`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id категории',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'название категории',
  `visible` tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT 'принимает участие?',
  `user_id` int UNSIGNED NOT NULL COMMENT 'id пользователя',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'описание категории',
  PRIMARY KEY (`id`) USING BTREE,
  CONSTRAINT `todo_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of todo_categories
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
        ";
        try {
            $this->db->exec($query);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function readAll()
    {
        $query = "SELECT * FROM `todo_categories`";
        try {
            $stmt = $this->db->query($query);
            $result = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function readAllForUser($user_id)
    {
        $query = "
SELECT
    `id`,
    `title`,
    (SELECT IF(todo_categories.`visible` = 1, 'Yes', 'No')) AS `visible`,
    `description`
    FROM `todo_categories`
    WHERE `user_id` = ?
        ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $result = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function create($data): bool
    {
        $title = $data['title'];
        $user_id = $data['user_id'];
        $description = $data['description'];

        $query = "
INSERT 
    INTO `todo_categories` 
        (`title`, `user_id`, `description`) 
    VALUES 
        (?, ?, ?)
        ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $user_id, $description]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM `todo_categories` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM `todo_categories` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update($data): bool
    {
        //tte($data);
        $id = $data['id'];
        $title = $data['title'];
        $visible = $data['visible'] ? 1 : 0;
        $description = $data['description'];

        $query = "
UPDATE `todo_categories` 
    SET 
        `title` = ?, 
        `visible` = ?,
        `description` = ?
    WHERE id = ?
    ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $visible, $description, $id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
