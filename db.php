<?php
$host = 'localhost'; // Geralmente é localhost
$db = 'login_db'; // Nome do seu banco de dados
$user = 'root'; // Usuário do MySQL
$pass = ''; // Senha do MySQL (geralmente em XAMPP é vazio)

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $pass, $db);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
