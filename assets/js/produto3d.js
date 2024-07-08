document.addEventListener("DOMContentLoaded", function() {
  var mainSwiper = new Swiper(".mySwiper", {
    effect: "fade",
    loop: true,
    grabCursor: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    zoom: {
      maxRatio: 5, // Define o zoom máximo permitido
       touchEndPreventDefault: false,
    },
  });

  var thumbs = document.querySelectorAll(".swiper-thumb");
  thumbs.forEach(function(thumb, index) {
    thumb.addEventListener("click", function() {
      mainSwiper.slideToLoop(index); // Slide para a imagem correspondente ao thumb clicado
      updateThumbs(index); // Atualiza a classe 'active' nos thumbs
    });
  });

  function updateThumbs(activeIndex) {
    thumbs.forEach(function(thumb, index) {
      if (index === activeIndex) {
        thumb.classList.add("active");
      } else {
        thumb.classList.remove("active");
      }
    });
  }

  
});


//SAFARI TESTE
document.addEventListener("DOMContentLoaded", function() {
  var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
  
  var mainSwiper = new Swiper(".mySwiper", {
    effect: "fade",
    loop: true,
    grabCursor: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    zoom: {
      maxRatio: 5, // Define o zoom máximo permitido
    },
    touchEndPreventDefault: !isSafari, // Evita o comportamento padrão de toque para Safari
  });

  var thumbs = document.querySelectorAll(".swiper-thumb");
  thumbs.forEach(function(thumb, index) {
    thumb.addEventListener("click", function() {
      mainSwiper.slideToLoop(index);
      updateThumbs(index);
    });
  });

  function updateThumbs(activeIndex) {
    thumbs.forEach(function(thumb, index) {
      if (index === activeIndex) {
        thumb.classList.add("active");
      } else {
        thumb.classList.remove("active");
      }
    });
  }
  
});
