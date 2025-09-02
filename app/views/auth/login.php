<?php
$title = "Login";

ob_start(); ?>
    <h1>Login</h1>
    <form method="POST" action="/post_login">
        <input type="text" name="username" placeholder="Usuário" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p>Não possui conta? <a href="/register">Registrar</a></p>
<?php
$content = ob_get_clean();

include __DIR__ . "/../layouts/layout.php";
