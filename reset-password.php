<?php
// Conectar ao banco de dados
$servername = "localhost"; // Geralmente é localhost
$username = "seu_usuario"; // Seu usuário do MySQL
$password = "sua_senha"; // Sua senha do MySQL
$dbname = "login_db"; // Nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o token e o e-mail foram passados pela URL
if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Verificar se o token é válido
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND reset_token = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibir formulário de redefinição de senha
        ?>
        <!DOCTYPE html>
        <html lang="pt">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redefinir Senha - FF Dimas Angola</title>
        </head>
        <body>
            <h1>Redefinir Senha</h1>
            <form method="POST" action="update_password.php">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <label for="new_password">Nova Senha</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">Redefinir Senha</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Token inválido ou expirado.";
    }
} else {
    echo "Acesso negado.";
}

$conn->close();
?>
