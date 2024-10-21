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

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Criptografar a nova senha

    // Atualizar a senha no banco de dados
    $sql = "UPDATE usuarios SET senha='$new_password', reset_token=NULL WHERE email='$email' AND reset_token='$token'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Senha redefinida com sucesso.";
    } else {
        echo "Erro ao redefinir a senha.";
    }
}

$conn->close();
?>
