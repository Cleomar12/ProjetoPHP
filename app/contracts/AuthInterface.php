<?php
namespace app\contracts;

/**
 * Interface que define o contrato para todos os serviços de autenticação.
 */
interface AuthInterface
{
    /**
     * Autentica um usuário.
     *
     * @param string $username
     * @param string $password
     * @return array|null Retorna os dados do usuário ou null se não autenticado
     */
    public function authenticate(string $username, string $password): ?array;

    /**
     * Registra um usuário.
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $confirm
     * @return array Retorna ['success' => '...'] ou ['error' => '...']
     */
    public function register(string $username,string $email ,string $password, string $confirm): array;

}
