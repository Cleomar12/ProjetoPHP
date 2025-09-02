<?php
namespace app\controllers;

// Carrega manualmente o Controller
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

use app\core\Controller;
use app\models\User;

class AuthController extends Controller {
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            
            if (!$username || !$password){
                $this->session->flash('error', 'Preencha usuário e senha!');
                $this->redirect('/login');
                return;
            }

            $user = User::verify($username, $password);

            if ($user){
                $this->session->set('user', $user['username']);
                $this->session->flash('success', 'Login realizado com sucesso!');
                $this->redirect('/dashboard'); // Redireciona após login
            } else {
                $this->session->flash('error', 'Usuário ou senha inválidos!');
                $this->redirect('/login');
            }
        } else {
            // Se for GET, apenas mostra a view
            $this->render('auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $passwordConfirm = $_POST['password_confirm'] ?? null;

            if (!$username || !$password || !$passwordConfirm) {
                $this->session->flash('error', 'Preencha todos os campos.');
                $this->redirect('/register');
                return;
            }

            if ($password !== $passwordConfirm) {
                $this->session->flash('error', 'As senhas não coincidem.');
                $this->redirect('/register');
                return;
            }

            if (User::findByUsername($username)) {
                $this->session->flash('error', 'Usuário já existe!');
                $this->redirect('/register');
                return;
            }

            $created = User::create($username, $password);
           
            if ($created){
                $this->session->flash('success', 'Usuário criado com sucesso!');
                $this->redirect('/login');
            } else{
                $this->session->flash('error', 'Erro ao tentar criar usuário, tente novamente!');
                $this->redirect('/register');
            }

        } else {
            $this->render('auth/sregister');
        }
    }


    public function logout() {
        $this->session->destroy();// Finaliza a sessão do usuário
        $this->redirect("/"); // Redireciona para a home
        exit;
    }

}
