<?php
namespace app\core;

class FlashMessage {
    /**
     * Exibe uma mensagem estilizada e opcionalmente redireciona.
     *
     * @param string $message Mensagem a exibir
     * @param string $type Tipo: 'success' ou 'error'
     * @param string|null $redirectUrl URL para redirecionar
     * @param int $delay Tempo em milissegundos antes do redirecionamento
     */
    public static function show(string $message, string $type = 'success', ?string $redirectUrl = null, int $delay = 0) {
        $color = $type === 'success' ? '#4CAF50' : '#f44336'; // verde ou vermelho
        echo "<div style='
                padding: 20px; 
                background-color: $color; 
                color: white; 
                margin-bottom: 15px; 
                font-family: Arial, sans-serif;
                text-align: center;
                border-radius: 5px;
              '>$message</div>";

        if ($redirectUrl) {
            echo "<script>
                    setTimeout(function() {
                        window.location.href = '$redirectUrl';
                    }, $delay);
                  </script>";
        }
    }
}
