<?php 
session_start();
// Inclui os arquivos necessários
include 'includes/header.php';
include 'dados-livros.php';

// Pega o carrinho da sessão
$carrinho_sessao = $_SESSION['carrinho'] ?? [];
$itens_carrinho = [];
$subtotal = 0;

// Percorre o array da sessão para obter os detalhes completos do livro
foreach ($carrinho_sessao as $id_livro => $item_info) {
    // Procura o livro no array de dados
    foreach ($livros_disponiveis as $livro) {
        if ($livro['id'] == $id_livro) {
            // Se encontrar, adiciona a quantidade do carrinho
            $livro['quantidade'] = $item_info['quantidade'];
            $itens_carrinho[] = $livro;
            $subtotal += $livro['preco'] * $livro['quantidade'];
            break;
        }
    }
}

// Lógica de Frete
$frete = (count($itens_carrinho) > 0) ? 10.00 : 0;
$total = $subtotal + $frete;
?>

<main class="cart-page container">
    <h1>Carrinho de Compras</h1>
    <div class="cart-grid">
        <div class="cart-items">
            <?php 
            // Loop para exibir os itens do carrinho
            if (empty($itens_carrinho)): ?>
                <p>Seu carrinho está vazio. Adicione livros para continuar.</p>
            <?php else: ?>
                <?php foreach($itens_carrinho as $item): ?>
                <div class="cart-item">
                    <img src="img/<?= htmlspecialchars($item['capa_slug']) ?>.png" 
                            alt="<?= htmlspecialchars($item['titulo']) ?>">
                    
                    <div class="item-info">
                        <h2><?= htmlspecialchars($item['titulo']) ?></h2>
                        <p>Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                    </div>
                    
                    <div class="item-quantity">
                        <form action="atualizar_carrinho.php" method="post" class="quantity-form">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                            
                            <input type="number" 
                                    name="quantidade" 
                                    value="<?= htmlspecialchars($item['quantidade']) ?>" 
                                    min="1" 
                                    onchange="this.form.submit()">
                        </form>
                    </div>
                    
                    <div class="item-remove">
                        <a href="remover_carrinho.php?id=<?= htmlspecialchars($item['id']) ?>" title="Remover item">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <aside class="cart-summary">
            <h2>Resumo do Pedido</h2>
            <div class="summary-line">
                <span>Subtotal</span>
                <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
            </div>
            <div class="summary-line">
                <span>Frete</span>
                <span>R$ <?= number_format($frete, 2, ',', '.') ?></span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
            </div>
            <?php 
            // Verifica se o carrinho não está vazio
            if (!empty($itens_carrinho)): 
            ?>
                <a href="checkout.php" class="btn btn-primary btn-full">Finalizar Compra</a>
            <?php 
            // Se estiver vazio, mostra um botão para continuar comprando
            else: 
            ?>
                <a href="index.php" class="btn btn-primary btn-full">Continuar Comprando</a>
            <?php endif; ?>
        </aside>
    </div>
</main>

<?php include 'includes/footer.php'; ?>