<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lista de Produtos em Espanhol</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Estilo personalizado para o header e rodapé */
        header {
            background-color: #f6799b;
            padding: 10px 0;
            text-align: center;
        }
        footer {
            
            background-color: #f6799b; /* Cinza claro */
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

        footer span.text-muted {
            color: white !important;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .flags img {
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }


        .card-body h5 a {
        color: #444 !important;
        font-family: 'Roboto', sans-serif;
        font-size: 1.1rem;
        text-decoration: none;
        font-weight: 600;
        }

    </style>
</head>
<body>
<header>
<a href="https://www.misslaura.com.br/misslaura" 
target="_blank">
<img src="../../assets/images/misslaura-logotipo.png" alt="MissLaura Logo" class="logo">
</a>

</header>

<div class="container mt-5">
<h2 class="text-center mb-3">PRODUCTOS EN 3D</h2>
<h5 class="text-center mt-2 mb-4">Versión del embalaje en español</h5>
    <div class="row">
        <?php
        $path = "../productos_espanhol";
        $diretorio = dir($path);

        $types = array('php');

        // Função para listar os arquivos em um diretório específico
        function listarArquivos($diretorio) {
            $arquivos = array();
            while ($arquivo = $diretorio->read()) {
                if ($arquivo == '.' || $arquivo == '..' || $arquivo == 'index.php') continue;
                $arquivos[] = $arquivo;
            }
            return $arquivos;
        }

        // Lê os arquivos do diretório atual
        $arquivosPHP = listarArquivos($diretorio);
        $diretorio->close();

        // Configurações para paginação
        $produtosPorPagina = 17; // 3 linhas com 3 cards cada
        $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 2;
        $indiceInicial = ($paginaAtual - 1) * $produtosPorPagina;
        $arquivosPagina = array_slice($arquivosPHP, $indiceInicial, $produtosPorPagina);

        $count = 0;
        foreach ($arquivosPagina as $arquivo) {
            $ext = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
            if (!in_array($ext, $types)) continue;

            // Determina o nome do subdiretório e da imagem correspondente
            $produtoNome = pathinfo($arquivo, PATHINFO_FILENAME);
            $produtoNomeFormatado = strtolower(str_replace(' ', '_', $produtoNome));
            $caminhoImagem = "{$path}/{$produtoNomeFormatado}/{$produtoNomeFormatado}_1.png";
            $produtoNomeSemUnderscore = str_replace('_', ' ', $produtoNome);

            // Verificação se a imagem realmente existe no caminho
            if (file_exists($caminhoImagem)) {
                if ($count % 3 == 0 && $count != 0) {
                    echo "</div><div class='row'>";
                }
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<a href='" . $arquivo . "'><img src='" . $caminhoImagem . "' class='card-img-top' alt='" . $produtoNomeSemUnderscore . "'></a>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'><a href='" . $arquivo . "'>" . strtoupper($produtoNomeSemUnderscore) . "</a></h5>";
                echo "<div class='flags'>";
                echo "<a href='./p3d/?lang=en'><img src='../assets/images/united-states.png' alt='USA'></a>";
                echo "<a href='/p3d/?lang=en'><img src='../assets/images/spain.png' alt='Spain'></a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $count++;
            } else {
                if ($count % 3 == 0 && $count != 0) {
                    echo "</div><div class='row'>";
                }
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Imagem não encontrada para o arquivo: " . $arquivo . "</h5>";
                echo "<div class='flags'>";
                echo "<img src='../assets/images/united-states.png' alt='USA'>";
                echo "<img src='../assets/images/spain.png' alt='Spain'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $count++;
            }
        }
        ?>
    </div>
</div>

<!-- Paginação -->
<nav class="container mt-4">
    <ul class="pagination justify-content-center">
        <?php
        // Calcula o número total de páginas
        $totalPaginas = ceil(count($arquivosPHP) / $produtosPorPagina);

        // Links para páginas anteriores e próximas
        if ($paginaAtual > 1) {
            echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaAtual - 1) . "'>&laquo; Anterior</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>&laquo; Anterior</span></li>";
        }

        // Links para páginas individuais
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?pagina=" . $i . "'>" . $i . "</a></li>";
            }
        }

        // Próxima página
        if ($paginaAtual < $totalPaginas) {
            echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaAtual + 1) . "'>Próximo &raquo;</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>Próximo &raquo;</span></li>";
        }
        ?>
    </ul>
</nav>

<!-- Rodapé fixo -->
<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> MissLaura. Todos os direitos reservados.</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
