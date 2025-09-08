<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conta a quantidade de itens únicos no carrinho
// Se a sessão do carrinho não existir, a contagem é 0.
$quantidade_carrinho = 0;
if (isset($_SESSION['carrinho'])) {
    $quantidade_carrinho = count($_SESSION['carrinho']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <a href="index.php" class="logo">BookHaven</a>
        <form action="busca.php" method="GET" class="search-bar">
             <input type="text" name="termo" placeholder="Buscar por título, autor ou gênero..." required>
             <button type="submit"><i class="fas fa-search"></i></button>
        </form>
            <nav class="main-nav">
                <a href="carrinho.php" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">
                        <?= htmlspecialchars($quantidade_carrinho) ?>
                    </span>
                </a>
                <?php if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true): ?>
                    <a href="perfil.php" class="nav-icon" title="Meu Perfil">
                        <i class="fas fa-user"></i>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="nav-icon" title="Entrar">
                        <i class="fas fa-user"></i>
                    </a>
                <?php endif; ?>
    </header>
