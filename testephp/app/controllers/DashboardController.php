<?php
namespace app\controllers;
require_once __DIR__ . '/../core/Controller.php';

use app\core\Controller;

class DashboardController extends Controller {
    public function index() {
        session_start();
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        $this->render('dashboard', [
            'user' => $_SESSION['user']
        ]);
    }
}
