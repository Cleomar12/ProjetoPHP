<?php
namespace app\core;

class Router {
    private $routes;
    private $basepath = '';// Define o caminho base do projeto no XAMPP

    public function __construct() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->routes = require __DIR__ . '/routes.php';
        session_start();
    }

    public function run() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if ($url === '/' || $url == '' ){
            $url = '/';
        }
        echo $url;
        if (array_key_exists($url, $this->routes)) {
            $route = $this->routes[$url];

            if (is_array($route) && isset($route[0])) {
                [$controller, $action] = $route;
                $authRequired = false;
            } else {
                $controller = $route['controller'];
                $action = $route['action'];
                $authRequired = $route['auth'] ?? false;
            }

            // Proteção de rota
            if ($authRequired && empty($_SESSION['user'])) {
                $this->redirect('/login');
            }

            $controllerPath = __DIR__ . "/../controllers/$controller.php";
            if (file_exists($controllerPath)) {
                require_once $controllerPath;

                $controllerClass = "app\\controllers\\$controller"; 
                if (class_exists($controllerClass)){
                    $obj = new $controllerClass();

                    if (method_exists($obj, $action)) {
                        call_user_func([$obj, $action]);
                    } else {
                        echo "Método $action não encontrado!";
                    }
                    
                } else {
                    die("A classe $controllerClass não foi encontrada!");
                }
            } else {
                die("Controller $controllerPath não encontrado");
            }
        }

    }
    private function redirect($url){
        header("Location: {$this->basepath}{$url}");
        exit;
    }
}
