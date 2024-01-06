<?php
class Database
{
    private static $instance = null;
    private $con;
    private function __construct()
    {
        $config = require_once __DIR__.'/../../config.php';
        $db_host = $config['db_host'];
        $db_name = $config['db_name'];
        $db_user = $config['db_user'];
        $db_pass = $config['db_pass'];
        try{
            $dsn = "mysql:host=$db_host;dbname=$db_name";
            $this->con = new PDO($dsn, $db_user, $db_pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Connect filed: " . $e->getMessage();
        }
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->con;
    }
}