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
                echo "Preencha usuário e senha.";
                return;
            }

            $user = User::verify($username, $password);

            if ($user){
                $_SESSION['user'] = $user['username'];
                $this->redirect('/dashboard'); // Redireciona após login
            } else {
                echo "Usuário ou senha inválidos!";
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
                echo "Preencha todos os campos.";
                return;
            }

            if ($password !== $passwordConfirm) {
                echo "As senhas não coincidem.";
                return;
            }

            if (User::findByUsername($username)) {
                echo "Usuário já existe!";
                return;
            }

            $created = User::create($username, $password);
            echo "Registro realizado com sucesso!";
            if ($created){
                echo "Usuário criado com sucesso!";
            } else{
                echo "Erro ao tentar criar usuário, tente novamente!";
            }

        } else {
            $this->render('auth/register');
        }
    }


    public function logout() {
        session_start();
        session_destroy();        // Finaliza a sessão do usuário
        $this->redirect("/login"); // Redireciona para a tela de login
        exit;
    }

}
