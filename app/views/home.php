<?php
$title = "Home";

ob_start(); ?>
    <h1>Bem-Vindo</h1>
    <p>Escolha uma das opções acima para continuar.</p>
<?php
$content = ob_get_clean();

include __DIR__ . "/layouts/layout.php";
