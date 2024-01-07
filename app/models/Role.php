<?php

class Role
{
    private $db;
    const DEFAULT_USER = 5;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query('SELECT * FROM `roles` LIMIT 1');
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
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id роли',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'название роли',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'описание роли',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idxunic_roles_name`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrator', 'Администратор (Administrator): полный доступ ко всем функциям сайта, включая управление пользователями, плагинами а также создание и публикация статей.');
INSERT INTO `roles` VALUES (2, 'Editor', 'Редактор (Editor): доступ к управлению и публикации статей, страниц и других контентных материалов на сайте. Редактор также может управлять комментариями и разрешать или запрещать их публикацию.');
INSERT INTO `roles` VALUES (3, 'Author', 'Автор (Author): может создавать и публиковать собственные статьи, но не имеет возможности управлять контентом других пользователей.');
INSERT INTO `roles` VALUES (4, 'Contributor', 'Пользователь (Contributor): может создавать свои собственные статьи, но они не могут быть опубликованы до одобрения администратором или редактором.');
INSERT INTO `roles` VALUES (5, 'Subscriber', 'Абонент (Subscriber): может только читать статьи и оставлять комментарии, но не имеет права создавать свой контент или управлять сайтом.');

SET FOREIGN_KEY_CHECKS = 1;
        ";
        try {
            $this->db->exec($roleTableQuery);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function readAll()
    {
        $query = "SELECT * FROM `roles`";
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
        $description = $data['description'];

        $query = "
INSERT 
    INTO `roles` 
        (`name`, `description`) 
    VALUES 
        (?, ?)
        ";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$name, $description]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM `roles` WHERE id = ?";
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
        $query = "SELECT * FROM `roles` WHERE id = ?";
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
        $description = $data['description'];

        $query = "UPDATE `roles` SET `name` = ?, `description` = ?
                WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$name, $description, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
