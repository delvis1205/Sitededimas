<?php
// recover_password.php

$servername = "localhost"; // ou seu servidor MySQL
$username = "seu_usuario"; // seu usuário do banco de dados
$password = "sua_senha"; // sua senha do banco de dados
$dbname = "login_db"; // nome do seu banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar se o e-mail existe na base de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // O e-mail existe, você pode enviar um link de recuperação por e-mail.
        // Aqui, você deve implementar a lógica para enviar o e-mail.

        // Exemplo:
        $to = $email;
        $subject = "Recuperação de Senha";
        $message = "Clique no link para redefinir sua senha: http://seudominio.com/reset-password.php?email=$email";
        $headers = "From: noreply@seudominio.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Um link de recuperação foi enviado para o seu e-mail.";
        } else {
            echo "Falha ao enviar o e-mail.";
        }
    } else {
        echo "Esse e-mail não está registrado.";
    }
}

$conn->close();
?>
