<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'app/models/Database.php';
require_once 'app/models/roles/RoleModel.php';
require_once 'app/models/users/UserModel.php';
require_once 'app/models/auth/AuthModel.php';
require_once 'app/models/pages/PageModel.php';

require_once 'app/controllers/roles/RolesController.php';
require_once 'app/controllers/auth/AuthController.php';
require_once 'app/controllers/users/UsersController.php';
require_once 'app/controllers/pages/PagesController.php';

require_once 'app/controllers/HomeController.php';
require_once 'app/router.php';
$router = new Router();
$router->run();