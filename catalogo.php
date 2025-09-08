<?php 
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
include 'dados-livros.php'; 
?>

<main class="category-page container">
    <h1>Nosso Catálogo Completo</h1>
    <p class="category-main-subtitle" style="text-align: center; margin-top: -10px; margin-bottom: 40px;">Explore todas as obras disponíveis em nossa livraria.</p>
    
    <div class="book-grid category-book-grid">
        <?php foreach ($livros_disponiveis as $livro): ?>
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