<?php

namespace app;

use controllers\auth\AuthController;
use controllers\home\HomeController;
use controllers\pages\PagesController;
use controllers\roles\RolesController;
use controllers\users\UsersController;

class Router
{
    // определяем маршруты
    private array $routes = array(
        '/^' . APP_BASE_PATH . '\/?$/' => array('controller' => 'home\\HomeController', 'action' => 'index'),
        '/^' . APP_BASE_PATH . '\/users(\/(?P<action>\w+)(\/(?<id>\w+))?)?$/' => array('controller' => 'users\\UsersController'),
        '/^' . APP_BASE_PATH . '\/roles(\/(?P<action>\w+)(\/(?<id>\w+))?)?$/' => array('controller' => 'roles\\RolesController'),
        '/^' . APP_BASE_PATH . '\/pages(\/(?P<action>\w+)(\/(?<id>\w+))?)?$/' => array('controller' => 'pages\\PagesController'),
        '/^' . APP_BASE_PATH . '\/auth(\/(?P<action>\w+)(\/(?<id>\w+))?)?$/' => array('controller' => 'auth\\AuthController'),
        // '/^' . APP_BASE_PATH . '\/users$/' => array('controller' => 'users\\UsersController'),
    );

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;
        //$uri));
        foreach ($this->routes as $pattern => $route) {
            //tt("pattern ".var_dump($pattern));
            if (preg_match($pattern, $uri, $matches)) {
                //tt("matches ".var_dump($matches));
                //tt("route ".var_dump($route));
                $controller = "controllers\\" . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                break;
            }
        }
        if (!$controller) {
            http_response_code(404);
            echo "Page not found!";
            return;
        }
        $controllerInstance = new $controller();
        if (!method_exists($controllerInstance, $action)) {
            http_response_code(404);
            echo "Page not found!";
            return;
        }
        call_user_func_array([$controllerInstance, $action], [$params]);
    }
}
