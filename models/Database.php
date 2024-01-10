<?php

namespace models;
class Database
{
    private static ?Database $instance = null;
    private \PDO $con;

    private function __construct()
    {
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
        try {
            $dsn = "mysql:host=$db_host;dbname=$db_name";
            $this->con = new \PDO($dsn, $db_user, $db_pass);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Connect filed: " . $e->getMessage();
        }
    }

    public static function getInstance(): ?Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->con;
    }
}