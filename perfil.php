<?php
session_start();
// Inclui os arquivos necessários
include 'includes/header.php';
include 'includes/db_connection.php';

// Redireciona se o usuário não estiver logado.
// A verificação é agora baseada na variável de sessão que definimos no login.php
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<main class="profile-page container">
    <div class="profile-container">
        <div class="profile-header-card">
            <div class="profile-avatar">
                <span class="avatar-initials"><?= htmlspecialchars(substr($_SESSION['usuario_nome'], 0, 2)) ?></span>
            </div>
            <div class="profile-info">
                <h1 class="profile-name"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></h1>
                <p class="profile-email"><?= htmlspecialchars($_SESSION['usuario_email']) ?></p>
            </div>
        </div>
        <div class="profile-grid">
            <aside class="profile-menu">
                <ul class="menu-list">
                    <li class="menu-item active"><a href="perfil.php"><i class="fas fa-box"></i> Meus Pedidos</a></li>
                    <li class="menu-item"><a href="#"><i class="fas fa-heart"></i> Lista de Desejos</a></li>
                    <li class="menu-item"><a href="#"><i class="fas fa-cog"></i> Configurações</a></li>
                    <li class="menu-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                </ul>
            </aside>
            <div class="profile-content">
                <div class="profile-stats">
                    <div class="stat-card">
                        <span class="stat-number">0</span>
                        <p class="stat-label">Pedidos Realizados</p>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number">0</span>
                        <p class="stat-label">Livros na Lista de Desejos</p>
                    </div>
                </div>
                <div class="profile-section">
                    <h2 class="section-title">Atividade Recente</h2>
                    <div class="empty-state">
                        <p>Nenhuma atividade recente</p>
                        <a href="index.php" class="btn btn-secondary">Começar a Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>