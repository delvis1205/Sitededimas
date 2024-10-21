<?php
session_start(); // Iniciar a sessão

// Incluir o arquivo de conexão
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografar a senha

    // Inserir o usuário no banco de dados
    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro bem-sucedido!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
