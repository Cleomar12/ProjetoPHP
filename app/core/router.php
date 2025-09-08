<?php
namespace app\core;

require_once __DIR__. '/../services/session.php';

use app\services\Session;

class Router {
    private $routes;
    private $basepath = ''; // Define o caminho base do projeto no XAMPP
    private Session $session; 

    public function __construct() {
        
        $this->routes = require __DIR__ . '/routes.php';
        $this->session = new Session(); //Cria um objeto Session e inicia uma sessão
    }

    public function run() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if ($url === '/' || $url == '' ){
            $url = '/';
        }

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
                    $obj = new $controllerClass($this->session); // Cria uma instancia do controller e injeta um objeto Session

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
