<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Ñoquis de Papa - Misslaura</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />-->
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./../assets/css/produto3d.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
        /* Estilo personalizado para o header e rodapé */
        header {
            background-color: #f6799b;
            padding: 10px 0;
            text-align: center;
        }

    </style>
</head>

<body>

<header>
<a href="https://www.misslaura.com.br/misslaura" 
target="_blank">
<img src="./../assets/images/misslaura-logotipo.png" alt="MissLaura Logo" class="logo">
</a>

</header>
<h1 class="title-swiper">Ñoquis de Papa</h1>

  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php
      // Diretório da pasta específica
      $pastaEspecifica = './../assets/images/img-es/noquis_de_batata/';

      // Lista de imagens na pasta específica
      $imagens = scandir($pastaEspecifica);

      // Remover os diretórios '.' e '..'
      $imagens = array_diff($imagens, array('..', '.'));

      // Iterar sobre as imagens
      foreach ($imagens as $index => $imagem) {
        // Imprimir o código do swiper para cada imagem
        echo '<div class="swiper-slide">';
        echo '<div class="swiper-zoom-container">';
        echo '<img class="main-image" src="' . $pastaEspecifica . $imagem . '" alt="Ñoquis de Papa" />';
        echo '</div>';
        echo '</div>';
      }
      ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Thumbnails -->
    <div class="swiper-thumbs" style="margin-top: 50px; margin-bottom: 50px; display: flex; justify-content: center; align-items: center;">
    <?php
    // Iterar sobre as imagens novamente para criar os thumbs
    foreach ($imagens as $index => $imagem) {
      // Determinar a classe para o thumb ativo
      $activeClass = ($index === 0) ? 'active' : '';

      // Imprimir o código do thumb
      echo '<img class="swiper-thumb ' . $activeClass . '" src="' . $pastaEspecifica . $imagem . '" alt="Noquis de Papa" data-index="' . $index . '" />';
    }
    ?>
  </div>

  <!-- Botão voltar -->
  <div class="row d-flex justify-content-center align-items-center">
    <?php
    // Função para obter o valor de um parâmetro da URL
    function getQueryParam($param)
    {
      return isset($_GET[$param]) ? $_GET[$param] : null;
    }

    // Obtendo o valor do parâmetro 'lang' da URL
    $idiomaSelecionado = getQueryParam('lang');

    // Determinando a string com base no idioma selecionado
    $textoBotao = ($idiomaSelecionado == 'en') ? 'See all Products' : 'Ver todos los Productos';

    // Definindo o valor da página atual (exemplo)
    $paginaAtual = 1; // Altere conforme necessário
    ?>

    <a href="<?php echo '/p3d/?lang=es&pagina=' . $paginaAtual; ?>" class="btn-voltar"><?php echo $textoBotao; ?></a>

  </div>

<!-- Rodapé fixo -->
<footer class="footer mt-5">
    <div class="container">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> MissLaura. Todos os direitos reservados.</span>
    </div>
</footer>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./../assets/js/produto3d.js"></script>
</body>
</html>
