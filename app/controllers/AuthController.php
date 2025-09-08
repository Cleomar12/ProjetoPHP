<?php
namespace app\controllers;

// Carrega manualmente o Controller
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../services/AuthFactory.php';

use app\core\Controller;
use app\services\AuthFactory;
use app\services\Session; 

class AuthController extends Controller {
    private AuthFactory $authFactory;

    public function __construct(Session $session)
    {
        parent::__construct($session);
        $this->authFactory = new AuthFactory();
    }
    /**
     * Método único de login que decide qual provedor usar com base no campo auth type
     */
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->render('auth/login');
            return;
        } 
        
        // Recebe tipo de autenticação do formulário
        $authType = $_POST['auth_type'] ??'database';
        // Cria a autenticação correta
        $authService = $this->authFactory->make($authType);

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';



        $user = $authService->authenticate($username, $password);

            if ($user){
                $this->session->set('user', $user['username']);
                $this->session->flash('success', 'Login realizado com sucesso!');
                $this->redirect('/dashboard');
                return;
            } else {
                $this->session->flash('error', 'Usuário ou senhar inválidos!');
                $this->redirect('/login');

            }


    }

    /**
     * método de registro usando apenas login local
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->render('auth/sregister');
            return;

        } 

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirm'] ?? '';

        // Para registro, usamos sempre o DatabaseAuthService
        $authService = $this->authFactory->make('database');
        $result = $authService->register($username, $password, $confirm,$email);

        if (isset($result['success'])) {
            $this->session->flash('success', $result['success']);
            $this->redirect('/login');
        } else {
            $this->session->flash('error', $result['error']);
            $this->redirect('/register');
        }


    }


    public function logout() {
        $this->session->destroy();// Finaliza a sessão do usuário
        $this->redirect("/"); // Redireciona para a home
        exit;
    }

}
