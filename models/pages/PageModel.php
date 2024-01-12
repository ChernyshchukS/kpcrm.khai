<?php

namespace models\pages;

use models\Database;

class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `pages` LIMIT 1');
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
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
                          `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id страницы',
                          `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'заголовок',
                          `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'адрес',
                          `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'кто может видеть эту страницу?',
                          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'дата обновления',
                          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата создания страницы',
                          PRIMARY KEY (`id`) USING BTREE,
                          UNIQUE INDEX `idxunic_pages_slug`(`slug` ASC) USING BTREE,
                          INDEX `title`(`title` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT
INTO `pages`
(`title`, `slug`, `role`)
VALUES
    ('Roles All',    'roles',        '1'),
    ('Roles Create', 'roles/create', '1'),
    ('Roles Store',  'roles/store',  '1'),
    ('Roles Edit',   'roles/edit',   '1'),
    ('Roles Update', 'roles/update', '1'),
    ('Roles Delete', 'roles/delete', '1'),

    ('Users All',    'users',        '1,2'),
    ('Users Create', 'users/create', '1,2'),
    ('Users Store',  'users/store',  '1,2'),
    ('Users Edit',   'users/edit',   '1,2'),
    ('Users Update', 'users/update', '1,2'),
    ('Users Delete', 'users/delete', '1,2'),

    ('Pages All',    'pages',        '1,2,3'),
    ('Pages Create', 'pages/create', '1,2,3'),
    ('Pages Store',  'pages/store',  '1,2,3'),
    ('Pages Edit',   'pages/edit',   '1,2,3'),
    ('Pages Update', 'pages/update', '1,2,3'),
    ('Pages Delete', 'pages/delete', '1,2,3'),

    ('Categories All',    'todo/categories',        '1,2,3,4,5'),
    ('Categories Create', 'todo/categories/create', '1,2,3,4,5'),
    ('Categories Store',  'todo/categories/store',  '1,2,3,4,5'),
    ('Categories Edit',   'todo/categories/edit',   '1,2,3,4,5'),
    ('Categories Update', 'todo/categories/update', '1,2,3,4,5'),
    ('Categories Delete', 'todo/categories/delete', '1,2,3,4,5');
    
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
        $query = "
SELECT * FROM `pages`
        ";
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

    public function create($data): bool
    {
        $title = trim($data['title']);
        $slug = trim(strtolower($data['slug']));
        $role = implode(",", $data['role']);
        $query = "
INSERT 
    INTO `pages` 
        (`title`, `slug`, `role`) 
    VALUES 
        (?, ?, ?)
        ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $role]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM `pages` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM `pages` WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function findSlug($slug)
    {
        $query = "SELECT * FROM `pages` WHERE `slug` = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$slug]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update($data): bool
    {
        $id = $data['id'];
        $title = trim($data['title']);
        $slug = trim(strtolower($data['slug']));
        $role = implode(",", $data['role']);

        $query = "
UPDATE `pages` 
    SET `title` = ?, `slug` = ?, `role` = ?
    WHERE id = ?
                ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $role, $id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
