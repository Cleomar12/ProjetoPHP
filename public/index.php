<?php
require_once __DIR__ . '/../app/core/Router.php';

use app\core\Router;

$router = new Router();
$router->run();
// para rodar a aplicação em ambiente local: http://testephp.local/