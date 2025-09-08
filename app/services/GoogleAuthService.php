<?php
namespace app\services;

require_once __DIR__. '/../models/User.php';

use app\models\User;
use app\contracts\AuthInterface;

class GoogleAuthService implements AuthInterface
{
    public function authenticate(string $googleId, string $email): ?array
    {
        // Tenta achar usuário pelo provider_id
        $user = User::findByProvider('google', $googleId);

        if ($user) {
            return $user;
        }

        // Se não existir, cria automaticamente
        $user = User::create([
            'username'     => explode('@', $email)[0], // pega prefixo do email como username
            'email'        => $email,
            'password_hash'=> null, // OAuth não usa senha
            'provider'     => 'google',
            'provider_id'  => $googleId,
        ]);

        return $user ?: null;
    }

    public function register(string $username, string $password, string $confirm, string $email = ''): array
    {
        // Normalmente OAuth não precisa de register, mas pode deixar vazio ou lançar exception
        return ['error' => 'Registro via Google não é permitido. Use login com sua conta Google.'];
    }

    public function logout(): void
    {
        session_destroy();
    }
}
