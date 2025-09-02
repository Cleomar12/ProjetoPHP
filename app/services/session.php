<?php
namespace app\services;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Define valor na sessão
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    // Recupera valor
    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    // Remove valor
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    // Checa se existe
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Exibe uma mensagem estilizada e opcionalmente redireciona.
     * @param string $key : 'success' ou 'error'
     * @param string $message : 'messagem a exibir!'
     */
    public function flash(string $key, $message = null)
    {
        if ($message !== null) {
            $_SESSION['flashmessage'][$key] = $message;
        } else {
            if (isset($_SESSION['flashmessage'][$key])) {
                $msg = $_SESSION['flashmessage'][$key];
                unset($_SESSION['flashmessage'][$key]);
                return $msg;
            }
            return null;
        }
    }

    // Destroi sessão inteira
    public function destroy(): void
    {
        session_destroy();
    }
}
