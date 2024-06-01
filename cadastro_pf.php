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
    <title>Cadastro Pessoa Física</title>
</head>

<body>
    <div class="main-container">
        <div class="container" style="width: 25%; margin: 5rem auto;">
            <img src="img/Busc.Ai.png" style="width: 40%;" alt="" class="logo">
            <h1 class="tittle">Busc.ai</h1>
            <form method="post" action="processar_cadastro.php">
                <label for="nome">Nome:</label>
                <input type="text" name="user_log" required placeholder="Nome de usúario">
    
                <label for="email">E-mail:</label>
                <input type="email" name="email" required placeholder="E-mail">

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf_registro" required placeholder="CPF">

                <label for="senha">Senha:</label>
                <input type="password" name="pw_log" required placeholder="Senha">
    
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" required placeholder="Telefone">
    
                <label for="genero">Gênero:</label>
                <select name="genero">
                    <option value="homem">--Gênero--</option>
                    <option value="homem">Homem</option>
                    <option value="mulher">Mulher</option>
                    <option value="nao-informar">Não desejo informar</option>
                </select>
    
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" name="data_nascimento" required>
    
                <input type="submit" value="Cadastrar">
                
            </form>
        </div>
    </div>
</body>

</html>
