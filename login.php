<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="form.css" />
    <link rel="shortcut icon" type="imagex/jpg" href="img/Busc.Ai.png">
    <title>Busc.ai</title>
</head>

<body>

    <div class="form-container" style="width: 25%;">
        <div id="imagem-log"><img src="img/Busc.Ai.png" width="80%" alt=""></div>
        <div>
            <h3 style="font-size: 30px;" class="tittle">Busc.ai</h3>
        </div>

        <form action="login.php" method="post">
            <div class="mb-3"><input style="width: 90%;" type="text" name="user" placeholder="Usuário"></div>
            <div class="mb-3"><input style="width: 90%;" type="password" name="pw" placeholder="Senha"></div>

            <?php
            session_start();

            $erro = '';

            if (!isset($_SESSION['login'])) {
                if (isset($_POST['login'])) {
                    include "config.php";

                    $user = $_POST['user'];
                    $senha = $_POST['pw'];

                    if (empty($user) || empty($senha)) {
                        $erro = "Por favor, preencha ambos o nome de usuário e a senha.";
                    } else {
                        $login = $conn->prepare('SELECT id, pw_log FROM `pf_registro` WHERE user_log = ?');
                        $login->bind_param("s", $user);
                        $login->execute();
                        $result = $login->get_result();

                        if ($result->num_rows > 0) {
                            $cons = $result->fetch_assoc();
                            $senha_hash = $cons['pw_log'];
                            echo "Senha hash no banco: " . $senha_hash . "<br>"; // Adicionado para depuração

                            if (password_verify($senha, $senha_hash)) {
                                $id = $cons['id'];
                                $_SESSION['login'] = $id;
                                header("location: index.php");
                                exit();
                            } else {
                                echo "Senha fornecida: " . $senha . "<br>"; // Adicionado para depuração
                                echo "Hash verificado: " . (password_verify($senha, $senha_hash) ? "true" : "false") . "<br>"; // Adicionado para depuração
                                $erro = "Nome de usuário ou senha inválidos!";
                            }
                        } else {
                            $erro = "Nome de usuário ou senha inválidos!";
                        }
                    }
                }
            }
            ?>
            <?php if ($erro != '') : ?>
                <div class="erro"><?php echo $erro; ?></div>
            <?php endif; ?>

            <button type="submit" name="login" value="Login" style="border-radius: .5rem; padding: 1rem; margin: 1rem;" class="btn btn-primary">Entrar</button>
        </form>

        <div id="links">
            <a href="#">
                <p>Esqueci minha senha</p>
            </a>
            <a href="cadastro_pf.php">
                <p>Cadastre como Cliente</p>
            </a>
            <a href="cadastro_pj.php">
                <p>Cadastre como Empresa</p>
            </a>
        </div>
    </div>
</body>
</html>
