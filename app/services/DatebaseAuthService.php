<?php
namespace app\services;

require_once __DIR__. '/../models/User.php';

use app\models\User;
use app\contracts\AuthInterface;

class DatabaseAuthService implements AuthInterface
{
    public function authenticate(string $username, string $password): ?array
    {
        $user = User::findByUsername($username);

        if (!$user) {
            return null;
        }

        if (password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return null;
    }

    public function register(string $username, string $password, string $confirm, string $email = ''): array
    {
        // Validação de campos obrigatórios
        if (!$username  || !$password || !$confirm|| !$email) {
            return ['error' => 'Todos os campos são obrigatórios.'];
        }

        // Verifica se as senhas coincidem
        if ($password !== $confirm) {
            return ['error' => 'As senhas não coincidem.'];
        }

        // Verifica se usuário ou email já existe
        if (User::exists($username, $email)) {
            return ['error' => 'Usuário ou email já existe.'];
        }

        // Cria hash da senha
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Cria usuário no banco
        $created = User::create([
            'username'      => $username,
            'email'         => $email,
            'password_hash' => $passwordHash,
            'provider'      => 'database',
        ]);

        if ($created) {
            return ['success' => 'Usuário criado com sucesso!'];
        }

        return ['error' => 'Erro ao criar usuário, tente novamente.'];
    }

}
