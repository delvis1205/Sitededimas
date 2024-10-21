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
    $password = $_POST['password'];

    // Usar prepared statements para prevenir SQL Injection
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar a senha
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Login bem-sucedido!";
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
    $stmt->close();
}

$conn->close();
?>
