<?php
$title = "Login";

ob_start(); ?>
    <section class="forms-container">
        <h1>Login</h1>

        <!-- Login tradicional -->
        <form method="POST" action="/post_login">
            <input type="hidden" name="auth_type" value="database">
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>

        <hr>

        <!-- Login com Google -->
        <form method="POST" action="/post_login">
            <input type="hidden" name="auth_type" value="google">
            <button type="submit" class="google-btn">
                <i class="fab fa-google"></i> Entrar com conta Google
            </button>
        </form>

        <!-- Login com Facebook -->
        <form method="POST" action="/post_login">
            <input type="hidden" name="auth_type" value="facebook">
            <button type="submit" class="facebook-btn">
                <i class="fab fa-facebook-f"></i> Entrar com Facebook
            </button>
        </form>

        <p>Não possui conta? <a href="/register">Registrar</a></p>
</section>

<?php
$content = ob_get_clean();

include __DIR__ . "/../layouts/layout.php";
