<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Projeto PHP' ?></title>
    <link rel="stylesheet" href="/css/dashboard_styles.css">
    <link rel="stylesheet" href="/css/flash.css">
</head>
<body>
    <header>
        <nav>
            <a href="/dashboard">Início</a>
            <a href="#">Perfil</a>
            <a href="#">Configurações</a>
            <a class="logout" href="/logout">Sair</a>
        </nav>
    </header>
    <?php include __DIR__ . '/../components/flash.php'; ?>
    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> - Todos os direitos reservados</p>
    </footer>
</body>
</html>