<?php
namespace App\Models;

class User {
    private $conn;

    // O construtor recebe a conexão com o banco de dados
    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    // Método para encontrar um usuário pelo e-mail
    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Método para criar um novo usuário
    public function create($nome, $email, $senha) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha_hash);
        return $stmt->execute();
    }

    // Método para verificar se a senha está correta
    public function verifyPassword($password, $hashed_password) {
        return password_verify($password, $hashed_password);
    }
}