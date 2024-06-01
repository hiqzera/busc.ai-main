<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados (substitua pelos seus próprios dados)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base";

    // Coleta os dados do formulário
    $nome_empresa = $_POST['nome_empresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $horario_funcionamento = $_POST['horario_funcionamento'];

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Prepara a instrução SQL para inserir os dados na tabela pj_registro
    $sql = "INSERT INTO pj_registro (nome_empresa, telefone, endereco, horario_funcionamento) 
            VALUES ('$nome_empresa', '$telefone', '$endereco', '$horario_funcionamento')";

    // Executa a instrução SQL
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
        // Redireciona para alguma página após o cadastro
        header("Location: index.php");
    } else {
        echo "Erro ao cadastrar a empresa: " . $conn->error;
    }
    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se o formulário não foi submetido corretamente, redireciona de volta para a página de origem
    header("Location: index.php");
    exit;
}
?>
