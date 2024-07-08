<?php require_once 'assets/includes/header.php'; ?>

<?php
// Determina o idioma selecionado com base na URL ou usa 'en' como padrão
$idiomaSelecionado = isset($_GET['lang']) ? $_GET['lang'] : 'en';
?>

<div class="container mt-5">
    <h2 class="text-center mb-3">3D PRODUCTS</h2>
    <h5 class="text-center mt-2 mb-4"><?php echo ($idiomaSelecionado == 'en' ? 'Version of packaging in' : 'Versión del embalaje en') ?>
        <select class="form-select form-select-lg mb-3" id="languageSelect" onchange="changeLanguage(this.value)">
            <option value="" disabled <?php echo ($idiomaSelecionado != 'en' && $idiomaSelecionado != 'es') ? 'selected' : ''; ?>><?php echo ($idiomaSelecionado == 'en' ? 'Choose a Language' : 'Elija un idioma') ?></option>
            <option value="en" <?php echo ($idiomaSelecionado == 'en') ? 'selected' : ''; ?>>English</option>
            <option value="es" <?php echo ($idiomaSelecionado == 'es') ? 'selected' : ''; ?>>Español</option>
        </select>
    </h5>
    <div class="row">
        <?php
        // Determina o diretório com base na seleção do idioma
        $diretorioImagens = "./" . $idiomaSelecionado . "/";

        // Função para listar arquivos apenas com a extensão .php e que possuem imagem correspondente
        function listarArquivosPHP($diretorio, $idiomaSelecionado)
        {
            $arquivos = array();
            while ($arquivo = $diretorio->read()) {
                $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                if ($extensao == 'php') {
                    // Verifica se há uma imagem correspondente
                    $produtoNome = pathinfo($arquivo, PATHINFO_FILENAME);
                    $produtoNomeFormatado = strtolower(str_replace(' ', '_', $produtoNome));
                    $caminhoImagem = "./{$idiomaSelecionado}/{$produtoNomeFormatado}/{$produtoNomeFormatado}_1.png";
                    if (file_exists($caminhoImagem)) {
                        $arquivos[] = $arquivo;
                    }
                }
            }
            // Ordena os arquivos alfabeticamente
            sort($arquivos);
            return $arquivos;
        }

        // Lê os arquivos do diretório atual
        $diretorio = dir($diretorioImagens);
        $arquivosPHP = listarArquivosPHP($diretorio, $idiomaSelecionado);
        $diretorio->close();

        // Configurações para paginação
        $produtosPorPagina = 9; // 3 linhas com 3 cards cada
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $indiceInicial = ($paginaAtual - 1) * $produtosPorPagina;
        $arquivosPagina = array_slice($arquivosPHP, $indiceInicial, $produtosPorPagina);

        foreach ($arquivosPagina as $arquivo) {
            // Determina o nome do subdiretório e da imagem correspondente
            $produtoNome = pathinfo($arquivo, PATHINFO_FILENAME);
            $produtoNomeFormatado = strtolower(str_replace(' ', '_', $produtoNome));
            $caminhoImagem = "./{$idiomaSelecionado}/{$produtoNomeFormatado}/{$produtoNomeFormatado}_1.png";
            $produtoNomeSemUnderscore = str_replace('_', ' ', $produtoNome);

            // Verificação se a imagem realmente existe no caminho
            if (file_exists($caminhoImagem)) {
                $produtoUrl = "{$idiomaSelecionado}/{$arquivo}";
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<a href='{$produtoUrl}'><img src='{$caminhoImagem}' class='card-img-top' alt='{$produtoNomeSemUnderscore}'></a>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'><a href='{$produtoUrl}'>" . strtoupper($produtoNomeSemUnderscore) . "</a></h5>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            } else {
                // Caso não tenha imagem correspondente, não exibe o card
                continue;
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
            echo "<li class='page-item'><a class='page-link' href='?lang={$idiomaSelecionado}&pagina=" . ($paginaAtual - 1) . "'>&laquo; Anterior</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>&laquo; Anterior</span></li>";
        }

        // Links para páginas individuais
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?lang={$idiomaSelecionado}&pagina=" . $i . "'>" . $i . "</a></li>";
            }
        }

        // Próxima página
        if ($paginaAtual < $totalPaginas) {
            echo "<li class='page-item'><a class='page-link' href='?lang={$idiomaSelecionado}&pagina=" . ($paginaAtual + 1) . "'>Próximo &raquo;</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>Próximo &raquo;</span></li>";
        }
        ?>
    </ul>
</nav>

<!-- Rodapé fixo -->
<?php require_once 'assets/includes/footer.php'; ?>

<script>
    // Função para mudar o idioma selecionado
    function changeLanguage(lang) {
        const urlParams = new URLSearchParams(window.location.search);
        if (lang) {
            urlParams.set('lang', lang);
            window.location.search = urlParams.toString();
        }
    }
</script>
