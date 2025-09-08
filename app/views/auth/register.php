<?php
$title = "Registrar";

ob_start(); ?>
    <section class="forms-container">
        <h1>Registrar</h1>
        <form method="POST" action="/post_register">
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="password" name="password_confirm" placeholder="Confirme a senha" required>
            <button type="submit">Cadastrar</button>
        </form>
        <p>Já possui conta? <a href="/login">Login</a></p>
    </section>
<?php
$content = ob_get_clean();

include __DIR__ . "/../layouts/layout.php";

