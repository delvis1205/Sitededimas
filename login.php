<?php
session_start(); // Iniciar a sessão

// Incluir o arquivo de conexão
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar o banco de dados
    $sql = "SELECT * FROM usuarios WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar a senha
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Armazenar nome de usuário na sessão
            echo "Login bem-sucedido!";
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}

$conn->close();
?>
