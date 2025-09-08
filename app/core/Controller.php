<?php
namespace app\core;

require_once __DIR__ . '/../services/session.php';

use App\services\Session; 

class Controller {
    protected string $basePath = '';
    protected Session  $session;

    public function __construct(Session $session) {
        $this->session = $session;
    }
    
    protected function render(string $view, array $data = []) {
        extract($data);
        $file = __DIR__ . "/../views/$view.php";
        if (!file_exists($file)) {
            die("View não encontrada: $file");
        }
        require $file;
    }

    protected function redirect(string $url) {
        // Se já veio URL absoluta, só redireciona
        if (preg_match('#^https?://#i', $url)) {
            header("Location: $url");
        } else {
            header("Location: {$this->basePath}{$url}");
        }
        exit;
    }
}