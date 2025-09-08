<?php 
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php'; 
include 'dados-livros.php'; // Inclui a nossa lista central de livros e infos de categoria

// Pega todas as categorias únicas e as ordena alfabeticamente
$categorias_unicas = array_unique(array_column($livros_disponiveis, 'categoria'));
sort($categorias_unicas);

// Função auxiliar para filtrar livros por categoria e pegar uma quantidade limitada
function filtrar_livros($livros, $categorias_para_filtrar, $limite) {
    $filtrados = [];
    foreach ($livros as $livro) {
        if (in_array($livro['categoria'], $categorias_para_filtrar)) {
            $filtrados[] = $livro;
        }
    }
    // Para garantir que sempre temos livros, mesmo se o filtro não encontrar o suficiente,
    // e para evitar erros de índice se o limite for maior que os livros disponíveis.
    // Embaralha para dar uma sensação de "novidade" em cada refresh.
    shuffle($filtrados); 
    return array_slice($filtrados, 0, $limite);
}

// Livros para a seção hero (pegaremos os 4 primeiros, aleatoriamente ou fixos se preferir)
$livros_hero_ids = [28, 14, 1, 16]; // Exemplo: Orgulho e Preconceito, Hábitos Atômicos, 1984, O Hobbit
$livros_hero = [];
foreach ($livros_hero_ids as $id) {
    foreach ($livros_disponiveis as $livro) {
        if ($livro['id'] == $id) {
            $livros_hero[] = $livro;
            break;
        }
    }
}
// Se quiser aleatórios, use: $livros_hero = array_slice(array_shuffle($livros_disponiveis), 0, 4);


// Cria listas de livros para os carrosséis temáticos
$livros_classicos = filtrar_livros($livros_disponiveis, ['Clássico', 'Romance Histórico', 'Poema Épico', 'Teatro'], 6);
$livros_desenvolvimento = filtrar_livros($livros_disponiveis, ['Desenvolvimento Pessoal', 'Finanças', 'Produtividade'], 6);
$livros_fantasia_aventura = filtrar_livros($livros_disponiveis, ['Fantasia', 'Fantasia Juvenil', 'Aventura'], 6);

// Informações das categorias
$categorias_info = [
    'Ficção Distópica' => ['icone' => 'fas fa-book-reader', 'descricao' => 'Mundos futuros e alertas sociais.'],
    'Desenvolvimento Pessoal' => ['icone' => 'fas fa-brain', 'descricao' => 'Transforme sua vida e mente.'],
    'Clássico' => ['icone' => 'fas fa-scroll', 'descricao' => 'Histórias que resistem ao tempo.'],
    'Finanças' => ['icone' => 'fas fa-chart-line', 'descricao' => 'Conselhos para a prosperidade.'],
    'Sátira Política' => ['icone' => 'fas fa-landmark', 'descricao' => 'Críticas sociais com humor afiado.'],
    'Terror' => ['icone' => 'fas fa-ghost', 'descricao' => 'Mergulhe no medo e no suspense.'],
    'Aventura' => ['icone' => 'fas fa-compass', 'descricao' => 'Jornadas épicas e descobertas.'],
    'Poema Épico' => ['icone' => 'fas fa-feather-alt', 'descricao' => 'Grandes narrativas em versos.'],
    'Produtividade' => ['icone' => 'fas fa-lightbulb', 'descricao' => 'Otimize seu tempo e resultados.'],
    'Teatro' => ['icone' => 'fas fa-mask', 'descricao' => 'Dramas e comédias no palco.'],
    'Fantasia' => ['icone' => 'fas fa-hat-wizard', 'descricao' => 'Reinos mágicos e criaturas fantásticas.'],
    'Fantasia Juvenil' => ['icone' => 'fas fa-dragon', 'descricao' => 'Aventuras mágicas para jovens heróis.'],
    'Romance Histórico' => ['icone' => 'fas fa-history', 'descricao' => 'História e paixão em uma só trama.'],
    'Fábula' => ['icone' => 'fas fa-leaf', 'descricao' => 'Lições de vida em contos encantadores.'],
    'Romance' => ['icone' => 'fas fa-heart', 'descricao' => 'Histórias de amor que cativam.'],
];
?>

<main>
    <section id="main-hero" class="hero-section container">
        <div class="hero-content">
            <h1 class="hero-title">Descubra Sua Próxima <span class="highlight">Aventura Literária</span></h1>
            <p class="hero-subtitle">Mergulhe em nossa coleção cuidadosamente selecionada de livros premium. De clássicos atemporais a obras-primas contemporâneas, encontre a história perfeita para te transportar.</p>
            <div class="hero-rating">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                <span>Avaliado 4.9/5 por leitores</span>
            </div>
            <div class="hero-actions">
                <a href="catalogo.php" class="btn btn-primary">Explorar Coleção <i class="fas fa-arrow-right"></i></a>
                <a href="mais_vendidos.php" class="btn btn-secondary">Ver Mais Vendidos</a>
            </div>
        </div>
        <div class="hero-images">
            <?php foreach ($livros_hero as $index => $livro): ?>
                <a href="produto.php?id=<?= htmlspecialchars($livro['id']) ?>" class="hero-image-card img-<?= $index + 1 ?>">
                    <img src="img/<?= htmlspecialchars($livro['capa_slug']) ?>.png" alt="Capa de <?= htmlspecialchars($livro['titulo']) ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="browse-collection" class="book-carousel container">
        <div class="carousel-header">
            <h2>Clássicos da Literatura</h2>
            <a href="catalogo.php" class="view-all-link">Ver todos <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="book-grid">
            <?php foreach ($livros_classicos as $livro): ?>
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
    </section>

    <section class="book-carousel container">
        <div class="carousel-header">
            <h2>Desenvolvimento Pessoal e Finanças</h2>
            <a href="catalogo.php" class="view-all-link">Ver todos <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="book-grid">
            <?php foreach ($livros_desenvolvimento as $livro): ?>
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
    </section>

    <section class="categories-section">
    <div class="container">
        <h2 class="section-title">Explore por Gênero</h2>
        <p class="section-subtitle">Descubra os livros que mais combinam com você</p>
        
        <div class="categories-grid">
            <?php foreach ($categorias_info as $nome_categoria => $info): ?>
                <a href="categoria.php?nome=<?= urlencode($nome_categoria) ?>" class="category-card">
                    <div class="icon">
                        <i class="<?= htmlspecialchars($info['icone']) ?>"></i>
                    </div>
                    <h3><?= htmlspecialchars($nome_categoria) ?></h3>
                    <p><?= htmlspecialchars($info['descricao']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <section class="book-carousel container">
        <div class="carousel-header">
            <h2>Fantasia e Aventura</h2>
            <a href="catalogo.php" class="view-all-link">Ver todos <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="book-grid">
            <?php foreach ($livros_fantasia_aventura as $livro): ?>
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
    </section>

</main>

<?php include 'includes/footer.php'; ?>