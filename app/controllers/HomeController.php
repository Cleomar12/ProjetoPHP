<?php
namespace app\controllers;

require_once __DIR__ . '/../core/Controller.php';

use app\core\Controller;
use app\services\Session;

class HomeController extends Controller {

        public function __construct(Session $session)
    {
        parent::__construct($session);
    }

    public function index() {
        $this->render('home'); 
    }

    public function login(){
        if (!empty($this->session->get('user'))){
            $this->redirect('/dashboard'); //direcionamento para rotas /dashboard
        }
        $this->render('auth/login');
    }

    public function register(){
        $this->render('auth/register');
    }
}
