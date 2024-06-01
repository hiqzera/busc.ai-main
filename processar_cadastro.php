<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Prepara e vincula
$stmt = $conn->prepare("INSERT INTO pf_registro (user_log, email, cpf_registro, pw_log, telefone, genero, data_nascimento) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $user_log, $email, $cpf_registro, $pw_log, $telefone, $genero, $data_nascimento);

// Define parâmetros e executa
$user_log = $_POST['user_log'];
$email = $_POST['email'];
$cpf_registro = $_POST['cpf_registro'];
$pw_log = password_hash($_POST['pw_log'], PASSWORD_BCRYPT); // Hash da senha
$telefone = $_POST['telefone'];
$genero = $_POST['genero'];
$data_nascimento = $_POST['data_nascimento'];

if ($stmt->execute()) {
    echo "Novo registro criado com sucesso";
    header("Location: login.php");
    exit();
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
