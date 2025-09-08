<?php 
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
include 'dados-livros.php'; // Inclui a nossa lista central de livros

// IDs dos livros mais vendidos que você escolheu
$livros_mais_vendidos_ids = [28, 14, 1, 16, 2, 7, 10, 20, 25, 30, 5, 8]; 
$livros_mais_vendidos = [];

// Filtra a lista principal para incluir apenas os mais vendidos
foreach ($livros_mais_vendidos_ids as $id) {
    foreach ($livros_disponiveis as $livro) {
        if ($livro['id'] == $id) {
            $livros_mais_vendidos[] = $livro;
            break;
        }
    }
}
?>

<main class="page-catalogo container">
    <header class="catalogo-header">
        <h1>Mais Vendidos</h1>
        <p>Confira os livros que estão fazendo mais sucesso entre nossos leitores.</p>
    </header>

    <div class="book-grid">
        <?php foreach ($livros_mais_vendidos as $livro): ?>
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
</main>

<?php include 'includes/footer.php'; ?>