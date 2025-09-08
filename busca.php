<?php 
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
include 'dados-livros.php';

// Pega o termo de busca da URL e limpa espaços extras
$termo_busca = isset($_GET['termo']) ? trim($_GET['termo']) : '';
$resultados = [];

// Só faz a busca se o termo não estiver vazio
if (!empty($termo_busca)) {
    foreach ($livros_disponiveis as $livro) {
        // strpos é case-sensitive, stripos é case-insensitive (melhor para busca)
        $encontrou_titulo = stripos($livro['titulo'], $termo_busca) !== false;
        $encontrou_autor = stripos($livro['autor'], $termo_busca) !== false;
        $encontrou_genero = stripos($livro['categoria'], $termo_busca) !== false;

        if ($encontrou_titulo || $encontrou_autor || $encontrou_genero) {
            $resultados[] = $livro;
        }
    }
}
?>

<main class="category-page container">
    <?php if (!empty($termo_busca)): ?>
        <h1>Resultados para: "<?= htmlspecialchars($termo_busca) ?>"</h1>
        <p class="category-main-subtitle" style="text-align: center; margin-top: -10px; margin-bottom: 40px;">
            <?= count($resultados) ?> livro(s) encontrado(s).
        </p>
    <?php else: ?>
        <h1>Busca</h1>
        <p class="category-main-subtitle" style="text-align: center; margin-top: -10px; margin-bottom: 40px;">
            Por favor, digite um termo na barra de pesquisa.
        </p>
    <?php endif; ?>
    
    <div class="book-grid category-book-grid">
        <?php if (!empty($resultados)): ?>
            <?php foreach ($resultados as $livro): ?>
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
        <?php elseif (!empty($termo_busca)): ?>
            <p style="grid-column: 1 / -1; text-align: center;">Nenhum livro encontrado com o termo informado.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>