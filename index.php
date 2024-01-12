<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
require_once 'autoload.php';
require_once 'functions.php';


$router = new app\Router();
$router->run();