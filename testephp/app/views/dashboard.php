<!-- app/views/dashboard.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2c3e50;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        nav {
            background: #34495e;
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        main {
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            margin: 10px auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,.1);
            max-width: 600px;
        }
        .logout {
            background: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
        }
        .logout:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bem-vindo à Dashboard</h1>
    </header>
    <nav>
        <a href="#">Início</a>
        <a href="#">Perfil</a>
        <a href="#">Configurações</a>
        <a class="logout" href="/logout">Sair</a>
    </nav>
    <main>
        <div class="card">
            <h2>Olá, <?= $_SESSION['user']['name'] ?? 'Usuário' ?>!</h2>
            <p>Você está logado no sistema.</p>
        </div>
    </main>
</body>
</html>
