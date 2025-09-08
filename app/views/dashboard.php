<?php
$title = "Dashboard";

ob_start(); ?>
    <div class="card">
        <h1>Bem-vindo à Dashboard</h1>
        <h2>Olá, <?= $_SESSION['user'] ?? 'Usuário' ?>!</h2>
        <p>Você está logado no sistema.</p>
            
    </div>
<?php
$content = ob_get_clean();

include __DIR__ . "/layouts/layout_dashboard.php";