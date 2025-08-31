<h1>Registrar</h1>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST" action="/post_register">
    <input type="text" name="username" placeholder="Usuário" required>
    <input type="password" name="password" placeholder="Senha" required>
    <input type="password" name="password_confirm" placeholder="Confirme a senha" required>
    <button type="submit">Cadastrar</button>
</form>
<a href="login">Login</a>
