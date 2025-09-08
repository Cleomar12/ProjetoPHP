<?php
namespace app\controllers;
require_once __DIR__ . '/../core/Controller.php';

use app\core\Controller;
use app\services\Session;

class DashboardController extends Controller {

    public function __construct(Session $session)
    {
        parent::__construct($session);
    }

    public function index() {

        if ($this->session->has('user') === false) {
            $this->redirect('/login');
        }

        $this->render('dashboard', [
            'user' => $this->session->get('user')
        ]);
    }
}
