
  document.addEventListener("DOMContentLoaded", function () {
    var header = document.getElementById("ast-desktop-header");
    var alturaInicial = header.offsetTop;

    window.addEventListener("scroll", function () {
      if (window.pageYOffset > alturaInicial) {
        header.classList.add("menu-fixo");
      } else {
        header.classList.remove("menu-fixo");
      }
    });
  });

