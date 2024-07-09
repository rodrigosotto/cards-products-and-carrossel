
<?php require_once 'assets/includes/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center mb-3">3D PRODUCTS</h2>
    <h5 class="text-center mt-2 mb-4">Version of packaging in English</h5>
        <div class="row">
            
            <?php
            $path = ".";
            $diretorio = dir($path);
           // var_dump($diretorio); exit();

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
            $produtosPorPagina = 11; // 3 linhas com 3 cards cada
            $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $indiceInicial = ($paginaAtual - 1) * $produtosPorPagina;
            $arquivosPagina = array_slice($arquivosPHP, $indiceInicial, $produtosPorPagina);

            foreach ($arquivosPagina as $arquivo) {
                $ext = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                if (!in_array($ext, $types)) continue;

                // Determina o nome do subdiretório e da imagem correspondente
                $produtoNome = pathinfo($arquivo, PATHINFO_FILENAME);
                $produtoNomeFormatado = strtolower(str_replace(' ', '_', $produtoNome));
                $caminhoImagem = "assets/produtos3d/{$produtoNomeFormatado}/{$produtoNomeFormatado}_1.png";
                $produtoNomeSemUnderscore = str_replace('_', ' ', $produtoNome);

                // Verificação se a imagem realmente existe no caminho
                if (file_exists($caminhoImagem)) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<a href='" . $arquivo . "'><img src='" . $caminhoImagem . "' class='card-img-top' alt='" . $produtoNomeSemUnderscore . "'></a>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'><a href='" . $arquivo . "'>" . strtoupper($produtoNomeSemUnderscore) . "</a></h5>";
                    echo "<div class='flags'>";
                    echo "<a href='.'><img src='./assets/images/united-states.png' alt='USA'></a>";
                    echo "<a href='./productos_espanhol/?pagina=1'><img src='./assets/images/spain.png' alt='Spain'></a>";                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>Imagem não encontrada para o arquivo: " . $arquivo . "</h5>";
                    echo "<div class='flags'>";
                    echo "<img src='./assets/images/united-states.png' alt='USA'>";
                    echo "<img src='./assets/images/spain.png' alt='Spain'>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
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
     <?php require_once 'assets/includes/footer.php'; ?>