<?php
session_start();
include('db_connection.php'); // Inclua o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Hash da senha

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
        $query = "INSERT INTO usuarios (email, senha) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $senha);

        if ($stmt->execute()) {
            // Redireciona para a página de login após o registro bem-sucedido
            header("Location: login.php");
            exit(); // Certifique-se de usar exit após o redirecionamento
        } else {
            echo "Erro ao registrar: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close(); // Fecha a conexão com o banco de dados
}
?>
