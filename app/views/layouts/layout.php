<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Projeto PHP' ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/flash.css">
</head>
<body>
    <header>
        <nav>
            <a href="/">Início</a>
            <a href="/login">Entrar</a>
            <a href="/register">Registrar</a>
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
