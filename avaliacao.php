<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="imagex/jpg" href="img/Busc.Ai.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Avaliar Empresa</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        h3 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h2>Avaliar Empresa</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$id_pj = isset($_GET['id']) ? $_GET['id'] : null;
$nome_empresa = isset($_GET['nome']) ? urldecode($_GET['nome']) : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pj = $_POST["empresa_id"];
    $avaliacao = $_POST["avaliacao"];
    $comentario = $_POST["comentario"];

    $sql_check = "SELECT * FROM pj_registro WHERE id_pj = '$id_pj'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $sql = "INSERT INTO avaliacoes (id_pj, avaliacao, comentario) VALUES ('$id_pj', '$avaliacao', '$comentario')";

        if ($conn->query($sql) === TRUE) {
            echo "Avaliação enviada com sucesso!";
            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao enviar avaliação: " . $conn->error;
        }
    } else {
        echo "ID da empresa inválido.";
    }
}

if ($nome_empresa) {
    echo "<h3>Você está avaliando: $nome_empresa</h3>";
}

echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id_pj&nome=" . urlencode($nome_empresa) . "'>";
echo "<input type='hidden' name='empresa_id' value='$id_pj'>";
echo "<label for='avaliacao'>Avaliação:</label>";
echo "<select name='avaliacao'>";
echo "<option value='1'>1 estrela</option>";
echo "<option value='2'>2 estrelas</option>";
echo "<option value='3'>3 estrelas</option>";
echo "<option value='4'>4 estrelas</option>";
echo "<option value='5'>5 estrelas</option>";
echo "</select><br><br>";
echo "<label for='comentario'>Comentário:</label><br>";
echo "<textarea name='comentario' rows='4' cols='50'></textarea><br><br>";
echo "<input type='submit' value='Enviar Avaliação'>";
echo "</form>";

$conn->close();
?>
</body>
</html>
