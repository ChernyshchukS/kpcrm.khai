<?php

class Router
{
    public function run()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        switch ($page) {
            case '':
            case 'home':
                $controller = new HomeController();
                $controller->index();
                break;
            case 'roles':
                $controller = new RolesController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'create':
                            $controller->create();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                        case 'edit':
                            $controller->edit();
                            break;
                        case 'update':
                            $controller->update();
                            break;
                        case 'delete':
                            $controller->delete();
                            break;
                    }
                } else {
                    $controller->index();
                }
                break;
            case 'users':
                $controller = new UsersController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'create':
                            $controller->create();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                        case 'edit':
                            $controller->edit();
                            break;
                        case 'update':
                            $controller->update();
                            break;
                        case 'delete':
                            $controller->delete();
                            break;
                    }
                } else {
                    $controller->index();
                }
                break;
            case 'auth':
                $controller = new AuthController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'register':
                            $controller->register();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                        case 'authenticate':
                            $controller->authenticate();
                            break;
                        case 'login':
                            $controller->login();
                            break;
                        case 'logout':
                            $controller->logout();
                            break;
                    }
                } else {
                    $controller->login();
                }
                break;
            case 'pages':
                $controller = new PagesController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'create':
                            $controller->create();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                        case 'edit':
                            $controller->edit();
                            break;
                        case 'update':
                            $controller->update();
                            break;
                        case 'delete':
                            $controller->delete();
                            break;
                    }
                } else {
                    $controller->index();
                }
                break;
            default:
                http_response_code(404);
                echo "Page not found!";
                break;
        }
    }
}
