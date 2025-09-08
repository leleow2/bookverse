<?php 
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
include 'dados-livros.php'; // Inclui a nossa lista central de livros

$categoria_selecionada = $_GET['nome'] ?? '';
$livros_filtro = [];

// Filtra os livros pela categoria selecionada
foreach ($livros_disponiveis as $livro) {
    if ($livro['categoria'] === $categoria_selecionada) {
        $livros_filtro[] = $livro;
    }
}
?>

<main class="category-page container">
    <h1>Categoria: <?= htmlspecialchars($categoria_selecionada) ?></h1>
    <p class="category-main-subtitle">Livros de <?= htmlspecialchars($categoria_selecionada) ?> em nossa livraria.</p>

    <?php if (empty($livros_filtro)): ?>
        <div class="carrinho-vazio-mensagem">
            <p>Nenhum livro encontrado para esta categoria.</p>
            <a href="catalogo.php" class="btn btn-primary">Ver Todos os Livros</a>
        </div>
    <?php else: ?>
        <div class="book-grid category-book-grid">
            <?php foreach ($livros_filtro as $livro): ?>
                <div class="book-card-container">
                    <a href="produto.php?id=<?= htmlspecialchars($livro['id']) ?>" class="book-card">
                        <img src="img/<?= htmlspecialchars($livro['capa_slug']) ?>.png" alt="Capa do livro <?= htmlspecialchars($livro['titulo']) ?>">
                    </a>
                    <div class="book-card-info">
                        <h2 class="book-title"><a href="produto.php?id=<?= htmlspecialchars($livro['id']) ?>"><?= htmlspecialchars($livro['titulo']) ?></a></h2>
                        <p class="book-author"><?= htmlspecialchars($livro['autor']) ?></p>
                        <p class="book-price">R$ <?= number_format($livro['preco'], 2, ',', '.') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>