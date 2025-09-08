<?php
namespace app\services;

require_once __DIR__. '/../models/User.php';

use app\models\User;
use app\contracts\AuthInterface;

class FacebookAuthService implements AuthInterface
{
    public function authenticate(string $facebookId, string $email): ?array
    {
        // Tenta achar usuário pelo provider_id
        $user = User::findByProvider('facebook', $facebookId);

        if ($user) {
            return $user;
        }

        // Se não existir, cria automaticamente
        $user = User::create([
            'username'     => explode('@', $email)[0],
            'email'        => $email,
            'password_hash'=> null,
            'provider'     => 'facebook',
            'provider_id'  => $facebookId,
        ]);

        return $user ?: null;
    }

    public function register(string $username, string $password, string $confirm, string $email = ''): array
    {
        return ['error' => 'Registro via Facebook não é permitido. Use login com sua conta Facebook.'];
    }

    public function logout(): void
    {
        session_destroy();
    }
}
