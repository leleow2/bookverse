<?php
session_start();
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
// Inclui o arquivo de conexão para poder buscar o email do usuário logado
include 'includes/db_connection.php';

// Redireciona se não houver itens no carrinho ou se o usuário não estiver logado
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit;
}

// Opcional: Se o usuário estiver logado, você pode exibir uma mensagem personalizada
$nome_usuario = $_SESSION['usuario_nome'] ?? '';

// Opcional: Esvazia o carrinho após a "compra" para simular a conclusão
if (isset($_SESSION['carrinho'])) {
    unset($_SESSION['carrinho']);
}
?>

<main class="checkout-page container">
    <div class="checkout-box">
        <i class="fas fa-check-circle success-icon"></i>
        <h1>Compra Finalizada com Sucesso!</h1>
        <?php if (!empty($nome_usuario)): ?>
            <p>Olá, <?= htmlspecialchars($nome_usuario) ?>! Agradecemos por sua compra.</p>
        <?php endif; ?>
        <p>Seus livros estão a caminho. Você receberá um e-mail de confirmação em breve.</p>
        <a href="index.php" class="btn btn-primary mt-4">Continuar Comprando</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>