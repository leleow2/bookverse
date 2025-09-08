<?php
session_start();
// Inclui os arquivos necessários
include 'includes/header.php';
include 'includes/db_connection.php';

$mensagem = '';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Prepara a consulta para evitar injeção de SQL
    $stmt = $conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, inicia a sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email']; // **Adicionado: salva o e-mail na sessão**
            $_SESSION['usuario_logado'] = true; // **Adicionado: define a flag de login**

            // Redireciona para a página de perfil
            header('Location: perfil.php');
            exit;
        } else {
            $mensagem = "E-mail ou senha incorretos.";
        }
    } else {
        $mensagem = "E-mail ou senha incorretos.";
    }
    $stmt->close();
}
?>

<main class="auth-page container">
    <div class="auth-form-box">
        <h1>Entrar</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            <?php if (!empty($mensagem)): ?>
                <p class="message"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>
        </form>
        <p class="mt-3">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>