<?php 
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
include 'dados-livros.php';

$livro = null;
$id_livro = $_GET['id'] ?? 0;

// Busca o livro pelo ID
foreach ($livros_disponiveis as $l) {
    if ($l['id'] == $id_livro) {
        $livro = $l;
        break;
    }
}

// Se o livro não for encontrado, exibe uma mensagem de erro
if (!$livro) {
    echo '<div class="container" style="padding: 50px 0; text-align: center;">';
    echo '<h1>Livro não encontrado.</h1>';
    echo '<p>Por favor, volte para a <a href="index.php" style="color: var(--accent-orange); text-decoration: none;">página inicial</a>.</p>';
    echo '</div>';
    include 'includes/footer.php';
    exit;
}

// Lógica para "Quem comprou, comprou também"
$livros_relacionados = [];
foreach ($livros_disponiveis as $livro_relacionado) {
    // Se for da mesma categoria E não for o livro atual
    if ($livro_relacionado['categoria'] === $livro['categoria'] && $livro_relacionado['id'] != $livro['id']) {
        $livros_relacionados[] = $livro_relacionado;
    }
}
// Limita a 6 livros relacionados e embaralha para variedade
shuffle($livros_relacionados);
$livros_relacionados = array_slice($livros_relacionados, 0, 6);
?>

<main class="product-page container">
    <div class="product-details-grid">
        <div class="product-image">
            <img src="img/<?= htmlspecialchars($livro['capa_slug']) ?>.png" alt="Capa do livro <?= htmlspecialchars($livro['titulo']) ?>">
        </div>
        <div class="product-info">
            <h1><?= htmlspecialchars($livro['titulo']) ?></h1>
            <p class="author">por <a href="#"><?= htmlspecialchars($livro['autor']) ?></a></p>
            
            <div class="product-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span>4.8 (2.847 avaliações)</span>
            </div>

            <p class="price">R$ <?= number_format($livro['preco'], 2, ',', '.') ?></p>

            <div class="product-actions">
                <form action="adicionar_carrinho.php" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">
                    <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                </form>
                <form action="comprar_agora.php" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">
                    <button type="submit" class="btn btn-secondary">Comprar Agora</button>
                </form>
            </div>

            <div class="product-description">
                <h3>Sinopse</h3>
                <p><?= htmlspecialchars($livro['sinopse']) ?></p>
            </div>

            <div class="product-specs">
                <h3>Detalhes do Livro</h3>
                <ul>
                    <li><strong>Editora:</strong> <?= htmlspecialchars($livro['editora']) ?></li>
                    <li><strong>Número de páginas:</strong> <?= htmlspecialchars($livro['paginas']) ?></li>
                    <li><strong>Formato:</strong> <?= htmlspecialchars($livro['formato']) ?></li>
                    <li><strong>Categoria:</strong> <a href="categoria.php?nome=<?= urlencode($livro['categoria']) ?>" class="category-link"><?= htmlspecialchars($livro['categoria']) ?></a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (isset($livro['autor_bio']) && !empty($livro['autor_bio'])): ?>
    <div class="author-bio-box">
        <h3>Sobre o Autor</h3>
        <p><?= htmlspecialchars($livro['autor_bio']) ?></p>
    </div>
    <?php endif; ?>

</main>

<?php if (!empty($livros_relacionados)): ?>
<section class="book-carousel container">
    <div class="carousel-header">
        <h2>Quem comprou, comprou também</h2>
        <a href="categoria.php?nome=<?= urlencode($livro['categoria']) ?>" class="view-all-link">Ver mais <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="book-grid">
        <?php foreach ($livros_relacionados as $livro_rel): ?>
            <div class="book-card-container">
                <a href="produto.php?id=<?= htmlspecialchars($livro_rel['id']) ?>" class="book-card">
                    <img src="img/<?= htmlspecialchars($livro_rel['capa_slug']) ?>.png" alt="Capa do livro <?= htmlspecialchars($livro_rel['titulo']) ?>">
                </a>
                <div class="book-card-info">
                    <h2 class="book-title"><a href="produto.php?id=<?= htmlspecialchars($livro_rel['id']) ?>"><?= htmlspecialchars($livro_rel['titulo']) ?></a></h2>
                    <p class="book-author"><?= htmlspecialchars($livro_rel['autor']) ?></p>
                    <p class="book-price">R$ <?= number_format($livro_rel['preco'], 2, ',', '.') ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php';?>