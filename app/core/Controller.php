<?php
namespace app\core;

class Controller {
    protected string $basePath = '';
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