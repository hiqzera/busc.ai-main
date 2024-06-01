<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados (substitua pelos seus próprios dados)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base";

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Coleta os dados do formulário
    $nome_empresa = $_POST['nome_empresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $horario_funcionamento = $_POST['horario_funcionamento'];
    $link_google_maps = $_POST['link_google_maps'];

    // Prepara a instrução SQL para inserir os dados na tabela pj_registro
    $sql = "INSERT INTO pj_registro (nome_empresa, telefone, endereco, horario_funcionamento, link_google_maps) 
    VALUES ('$nome_empresa', '$telefone', '$endereco', '$horario_funcionamento', '$link_google_maps')";

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
}
?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="shortcut icon" type="imagex/jpg" href="img/Busc.Ai.png">
    <title>Cadastro Pessoa Jurídica</title>
</head>
<body>
    <div class="main-container">
        <div class="container" style="margin: 5rem auto; width: 25%;">
            <img src="img/Busc.Ai.png" style="width: 45%;" alt="" class="logo">
            <h1 class="tittle">Busc.ai</h1>
            <form method="post" enctype="multipart/form-data" action="">
                <label for="nome_empresa">Nome da Empresa:</label>
                <input type="text" name="nome_empresa" required placeholder="Nome da Empresa">
    
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" required placeholder="Telefone">
    
                <label for="endereco">Endereço:</label> <!-- Adicione um campo para o endereço -->
                <input type="text" name="endereco" required placeholder="Endereço">
    
                <label for="horario_funcionamento">Horário de Funcionamento:</label> <!-- Adicione um campo para o horário de funcionamento -->
                <input type="text" name="horario_funcionamento" required placeholder="Horário de Funcionamento">
    
                <label for="link_google_maps">Link do Google Maps:</label>
                <input type="text" name="link_google_maps" required placeholder="Link do Google Maps">

                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </div>
</body>
</html>
