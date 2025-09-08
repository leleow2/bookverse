<?php
session_start();
include 'dados-livros.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_livro = (int)$_POST['id'];

    // Procura o livro na lista
    $livro_encontrado = null;
    foreach ($livros_disponiveis as $livro) {
        if ($livro['id'] === $id_livro) {
            $livro_encontrado = $livro;
            break;
        }
    }

    if ($livro_encontrado) {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Se já existe no carrinho, só aumenta a quantidade
        if (isset($_SESSION['carrinho'][$id_livro])) {
            $_SESSION['carrinho'][$id_livro]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$id_livro] = [
                'id' => $livro_encontrado['id'],
                'titulo' => $livro_encontrado['titulo'],
                'preco' => $livro_encontrado['preco'],
                'capa_slug' => $livro_encontrado['capa_slug'],
                'quantidade' => 1
            ];
        }

        header('Location: produto.php?id=' . $id_livro);
        exit;
    }
}

header('Location: index.php');
exit;
