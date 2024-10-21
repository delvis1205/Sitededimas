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

    // Verificar se o e-mail está cadastrado
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // E-mail encontrado, enviar link de recuperação
        $token = bin2hex(random_bytes(50)); // Gerar um token seguro
        $link = "https://ffdimasangola.netlify.app/reset-password.php?token=$token&email=$email";

        // Aqui você deve salvar o token no banco de dados associado ao e-mail
        $sql = "UPDATE usuarios SET reset_token='$token' WHERE email='$email'";
        $conn->query($sql);

        // Envio do e-mail
        $to = $email;
        $subject = "Recuperação de Senha";
        $message = "Clique no link a seguir para redefinir sua senha: $link";
        $headers = "From: ffdimasangola@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Um link de recuperação foi enviado para o seu e-mail. Por favor, verifique sua caixa de entrada.";
        } else {
            echo "Erro ao enviar o e-mail.";
        }
    } else {
        echo "E-mail não encontrado.";
    }
}

$conn->close();
?>
