<?php
class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `pages` LIMIT 1');
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
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id страницы',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'заголовок',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'адрес',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'дата обновления',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата создания страницы',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idxunic_pages_slug`(`slug` ASC) USING BTREE,
  INDEX `title`(`title` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT 
INTO `pages`
    (`id`, `title`, `slug`, `updated_at`, `created_at`)
VALUES 
    (1, 'home', 'home', '2024-01-05 13:22:23', '2024-01-05 13:22:23'),
    (2, 'role', 'role', '2024-01-05 13:23:26', '2024-01-05 13:23:28'),
    (3, 'user', 'user', '2024-01-05 13:24:26', '2024-01-05 13:24:28');

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
SELECT * FROM `pages`
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
        $title = trim($data['title']);
        $slug = trim(strtolower($data['slug']));

        $query = "
INSERT 
    INTO `pages` 
        (`title`, `slug`) 
    VALUES 
        (?, ?)
        ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug]);
            return true;
        } catch (PDOException $e) {
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
        } catch (PDOException $e) {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM `pages` WHERE id = ?";
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
        $title = trim($data['title']);
        $slug = trim(strtolower($data['slug']));

        $query = "UPDATE `pages` SET `title` = ?, `slug` = ?
                WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
