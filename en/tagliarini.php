<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Tagliarini - Misslaura</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./assets/css/produto3d.css" />
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

<!-- Body -->
<body>

<!-- Cabeçalho -->
<header>
<a href="https://www.misslaura.com.br/misslaura" 
target="_blank">
<img src="./assets/images/misslaura-logotipo.png" alt="MissLaura Logo" class="logo">
</a>

</header>
<h1 class="title-swiper">Tagliarini</h1>

  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php
      // Diretório da pasta específica
      $pastaEspecifica = './assets/images/produtos-ingles/tagliarini/';
   

      // Lista de imagens na pasta específica
      $imagens = scandir($pastaEspecifica);

      // Remover os diretórios '.' e '..'
      $imagens = array_diff($imagens, array('..', '.'));

      // Iterar sobre as imagens
      foreach ($imagens as $index => $imagem) {
        // Imprimir o código do swiper para cada imagem
        echo '<div class="swiper-slide">';
        echo '<div class="swiper-zoom-container">';
        echo '<img class="main-image" src="' . $pastaEspecifica . $imagem . '" alt="Tagliarini" />';
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
      echo '<img class="swiper-thumb ' . $activeClass . '" src="' . $pastaEspecifica . $imagem . '" alt="Vegan Mushroom Pastry" data-index="' . $index . '" />';
    }
    ?>
  </div>

<!-- Botão voltar -->
<div class="row d-flex justify-content-center align-items-center mb-5">
    <a href="./?pagina=1" class="btn-voltar" >Ver Todos os Produtos</a>
  </div>
    <!-- Rodapé fixo -->
    <?php require_once 'assets/includes/footer.php'; ?>