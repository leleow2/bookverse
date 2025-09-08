<?php
$servername = "localhost";
$username = "root"; // O usuário padrão do XAMPP é 'root'
$password = ""; // A senha padrão do XAMPP é vazia
$dbname = "livraria"; // Nome do banco de dados que você criou

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>