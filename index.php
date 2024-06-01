<?php
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

// Consulta SQL para buscar as empresas e suas imagens
$sql = "SELECT id_pj, nome_empresa, endereco, telefone, horario_funcionamento, link_google_maps FROM pj_registro";
$result = $conn->query($sql);

// Array para armazenar os dados das empresas
$empresas = array();

// Verifica se existem resultados da consulta
if ($result->num_rows > 0) {
    // Loop através dos resultados e armazena os dados no array
    while ($row = $result->fetch_assoc()) {
        $empresa = array(
            'id' => $row['id_pj'],
            'nome' => $row['nome_empresa'],
            'endereco' => $row['endereco'],
            'telefone' => $row['telefone'],
            'horario' => $row['horario_funcionamento'],
            'link_google_maps' => $row['link_google_maps']
        );
        array_push($empresas, $empresa);
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

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
    <title>Busc.ai</title>
</head>
<body>
   <header>
      <div class="container-fluid">
         <div class="row">
            <div class="cabecalho-logado bg-secondary text-white">
               <a href="apresentacao.html" class="btn-home" style="margin-left: 1rem; margin-top: 1rem;">Busc.ai</a>
               <div>
                   <a class="botao-sair btn btn-secondary" style="float: right; position: absolute; margin: .65% -3rem 0rem" href="logout.php">Sair</a>
                   <a class="botao-head btn btn-secondary" style="width: 7rem; float: right; margin: 1rem;" href="login.php">Cadastre-se</a>
               </div>
            </div>
         </div>
      </div>
   </header>
   <br>
   <div id="buscador" class="search-box pesquisa-bar">
         <input id="searchInput" class="search-txt" type="text" name="" placeholder="Faça sua pesquisa">
         <i class="fas fa-search"></i>
   </div>
   <div id="resultados" style="display: none; margin-top: auto; margin-left: 10%;">
        <?php foreach ($empresas as $empresa): ?>
            <div class="empresa">
                <h3><?= $empresa['nome'] ?></h3>
                <p><i class="fas fa-map-marker-alt"></i> Endereço: <?= $empresa['endereco'] ?></p>
                <p><i class="fas fa-phone"></i> Telefone: <?= $empresa['telefone'] ?></p>
                <p><i class="far fa-clock"></i> Horário de Funcionamento: <?= $empresa['horario'] ?></p>
                <p><i class="fas fa-map-marker-alt"></i> <a href="<?= $empresa['link_google_maps'] ?>" target="_blank">Ver no Google Maps</a></p>
                <button class="btn-avaliar" onclick="avaliarEmpresa(<?= $empresa['id'] ?>, '<?= addslashes($empresa['nome']) ?>')">Avaliar</button>
            </div>
        <?php endforeach; ?>
    </div>

   <footer>
      <div id="localSelecionado" style="box-shadow: #a7a7a7 0px 0px 15px; margin-left: 5%; border-radius: 1rem; display: none; width: 90%; background-color: #f2f2f2; padding: 10px; margin-bottom: 5rem;">
          <h3 style="margin-left: 1rem;"><span id="nome"></span></h3>
          <p style="margin-left: 1rem;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i></p>
          <p style="margin-left: 1rem;"><i class="fas fa-map-marker-alt"></i> Endereço: <span id="endereco"></span></p>
          <p style="margin-left: 1rem;"><i class="fas fa-phone"></i> Telefone: <span id="telefone"></span></p>
          <p style="margin-left: 1rem;"><i class="far fa-clock"></i> Horário de Funcionamento: <span id="horario"></span></p>
          <p style="margin-left: 1rem;"><i class="fas fa-map-marker-alt"></i> <a id="link_google_maps" style="text-decoration: none; font-weight: 700; color: #000000;" href="" target="_blank">Ver no Google Maps</a></p>
          <iframe id="googleMapsIframe" width="300" height="200" style="box-shadow: #aaaaaa 0px 0px 15px; border-radius: 1rem; border:0; margin-left: 1rem;" allowfullscreen="" loading="lazy"></iframe>
      </div>
   </footer>   
   <script>
        document.addEventListener("DOMContentLoaded", function() {
    const empresas = <?php echo json_encode($empresas); ?>;

    const searchInput = document.getElementById("searchInput");
    const resultadosContainer = document.getElementById("resultados");
    const nome = document.getElementById("nome");
    const endereco = document.getElementById("endereco");
    const telefone = document.getElementById("telefone");
    const horario = document.getElementById("horario");
    const linkGoogleMaps = document.getElementById("link_google_maps");
    const googleMapsIframe = document.getElementById("googleMapsIframe");
    const localSelecionado = document.getElementById("localSelecionado");

    searchInput.addEventListener("input", function() {
        const termoPesquisa = this.value.toLowerCase();

        if (termoPesquisa === "") {
            localSelecionado.style.display = "none";
            resultadosContainer.style.display = "block";
        } else {
            const resultadosFiltrados = empresas.filter(function(empresa) {
                return empresa.nome.toLowerCase().includes(termoPesquisa) ||
                    empresa.endereco.toLowerCase().includes(termoPesquisa) ||
                    empresa.telefone.includes(termoPesquisa) ||
                    empresa.horario.includes(termoPesquisa);
            });

            mostrarResultados(resultadosFiltrados);
        }
    });

    function mostrarResultados(resultados) {
        resultadosContainer.innerHTML = "";

        if (resultados.length > 0) {
            resultados.forEach(function(empresa) {
                const elementoEmpresa = document.createElement("div");
                elementoEmpresa.innerHTML = `
                    <h3>${empresa.nome}</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Endereço: ${empresa.endereco}</p>
                    <p><i class="fas fa-phone"></i> Telefone: ${empresa.telefone}</p>
                    <p><i class="far fa-clock"></i> Horário de Funcionamento: ${empresa.horario}</p>
                    <p><i class="fas fa-map-marker-alt"></i> <a href="${empresa.link_google_maps}" style="text-decoration: none; color: #000000; font-weight: 700;" target="_blank">Ver no Google Maps</a></p>
                    <button class="btn-avaliar" onclick="avaliarEmpresa(<?= $empresa['id'] ?>, '<?= addslashes($empresa['nome']) ?>')">Avaliar</button>
                    <hr>
                `;

                elementoEmpresa.addEventListener("click", function() {
                    nome.textContent = empresa.nome;
                    endereco.textContent = empresa.endereco;
                    telefone.textContent = empresa.telefone;
                    horario.textContent = empresa.horario;
                    linkGoogleMaps.href = empresa.link_google_maps;
                    googleMapsIframe.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyA0RMDUP0oZWqnS7UbICf9zCx-B0YXB9q4&q=${encodeURIComponent(empresa.endereco)}`;
                    localSelecionado.style.display = "block";
                    resultadosContainer.style.display = "none"; // Ocultar resultados
                });

                resultadosContainer.appendChild(elementoEmpresa);
            });
            resultadosContainer.style.display = "block"; // Mostrar resultados
        } else {
            resultadosContainer.style.display = "none"; // Ocultar resultados
        }
    }
});

function avaliarEmpresa(idEmpresa, nomeEmpresa) {
    window.location.href = "avaliacao.php?id=" + idEmpresa + "&nome=" + encodeURIComponent(nomeEmpresa);
}
</script>
</body>
</html>
