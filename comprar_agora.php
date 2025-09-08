<?php
session_start();

// O arquivo de dados é necessário para obter os detalhes do livro
include 'dados-livros.php';

// Redireciona para a página de produto se o ID do livro não for fornecido
if (!isset($_POST['id'])) {
    header('Location: index.php');
    exit;
}

$livro_id = intval($_POST['id']);
$livro_encontrado = null;

// Verifica se o livro existe na nossa lista de livros
foreach ($livros_disponiveis as $livro) {
    if ($livro['id'] == $livro_id) {
        $livro_encontrado = $livro;
        break;
    }
}

// Se o livro não for encontrado, redireciona para a página inicial
if (!$livro_encontrado) {
    header('Location: index.php');
    exit;
}

// Inicializa o carrinho caso não exista
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se o item já estiver no carrinho, incrementa a quantidade
if (isset($_SESSION['carrinho'][$livro_id])) {
    $_SESSION['carrinho'][$livro_id]['quantidade']++;
} else {
    // Se não estiver, adiciona com os dados completos do livro
    $_SESSION['carrinho'][$livro_id] = [
        'id' => $livro_encontrado['id'],
        'titulo' => $livro_encontrado['titulo'],
        'preco' => $livro_encontrado['preco'],
        'capa_slug' => $livro_encontrado['capa_slug'],
        'quantidade' => 1
    ];
}

// Redireciona diretamente para a página de finalização da compra
header('Location: carrinho.php');
exit;
