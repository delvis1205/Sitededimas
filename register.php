<?php
session_start(); // Iniciar a sessão

// Incluir o arquivo de conexão
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se os campos estão preenchidos
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografar a senha

    // Verificar se o nome de usuário já existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Nome de usuário já existe!";
    } else {
        // Usar prepared statements para prevenir SQL Injection
        $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "Registro bem-sucedido!";
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>
