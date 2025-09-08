<?php
session_start();
// Inclui os arquivos necessários na estrutura antiga
include 'includes/header.php';
include 'includes/db_connection.php'; // Inclui o arquivo de conexão

$mensagem = '';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Valida os dados de entrada
    if (empty($nome) || empty($email) || empty($senha)) {
        $mensagem = "Por favor, preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "Formato de e-mail inválido.";
    } else {
        // Verifica se o e-mail já existe
        $stmt_check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            $mensagem = "Este e-mail já está cadastrado.";
        } else {
            // Hash da senha para segurança
            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

            // Insere o novo usuário no banco de dados
            $stmt_insert = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $nome, $email, $senha_hashed);

            if ($stmt_insert->execute()) {
                $mensagem = "Cadastro realizado com sucesso! Você já pode <a href='login.php'>entrar</a>.";
            } else {
                $mensagem = "Erro ao cadastrar. Tente novamente.";
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    }
}
?>

<main class="auth-page container">
    <div class="auth-form-box">
        <h1>Cadastre-se</h1>
        <form action="cadastro.php" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <?php if (!empty($mensagem)): ?>
                <p class="message"><?= $mensagem ?></p>
            <?php endif; ?>
        </form>
        <p class="mt-3">Já tem uma conta? <a href="login.php">Entrar</a></p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>