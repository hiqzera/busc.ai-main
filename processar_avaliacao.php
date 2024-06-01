<?php
// Conexão com o banco de dados (substitua pelos seus detalhes de conexão)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $avaliacao = $_POST["avaliacao"];
    $comentario = $_POST["comentario"];

    // Insere a avaliação no banco de dados
    $sql = "INSERT INTO avaliacoes (avaliacao, comentario) VALUES ($avaliacao, '$comentario')";
    if ($conn->query($sql) === TRUE) {
        echo "Avaliação enviada com sucesso!";
    } else {
        echo "Erro ao enviar avaliação: " . $conn->error;
    }
}

$conn->close();
?>
