<?php
session_start();
include('db_connection.php'); // Inclua o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Nome de usuário
    $email = $_POST['email']; // E-mail
    $password = $_POST['password']; // Senha
    $confirm_password = $_POST['confirm-password']; // Confirmar senha

    // Verifica se a senha e a confirmação são iguais
    if ($password !== $confirm_password) {
        echo "As senhas não coincidem.";
        exit(); // Interrompe a execução se as senhas não coincidirem
    }

    // Verifique se o e-mail já está registrado
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Este e-mail já está registrado.";
    } else {
        // Se o e-mail não estiver registrado, insira os dados
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash da senha
        $query = "INSERT INTO usuarios (username, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // Redireciona para a página de login após o registro bem-sucedido
            header("Location: login.php");
            exit(); // Interrompe a execução após o redirecionamento
        } else {
            echo "Erro ao registrar: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close(); // Fecha a conexão com o banco de dados
}
?>
