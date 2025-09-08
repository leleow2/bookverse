<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['quantidade'])) {
    $id_livro = (int)$_POST['id'];
    $nova_quantidade = (int)$_POST['quantidade'];

    if ($nova_quantidade < 1) {
        $nova_quantidade = 1;
    }

    if (isset($_SESSION['carrinho'][$id_livro])) {
        $_SESSION['carrinho'][$id_livro]['quantidade'] = $nova_quantidade;
    }
}

header('Location: carrinho.php');
exit;
