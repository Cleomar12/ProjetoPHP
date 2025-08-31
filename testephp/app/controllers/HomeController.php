<?php
namespace app\controllers;

require_once __DIR__ . '/../core/Controller.php';

use app\core\Controller;

class HomeController extends Controller {
    public function index() {
        $this->render('home'); 
    }

    public function login(){
        if (!empty($_SESSION['user'])){
            $this->redirect('/dashboard'); //direcionamento para rotas /dashboard
        }
        $this->render('auth/login');
    }

    public function register(){
        $this->render('auth/register');
    }
}
