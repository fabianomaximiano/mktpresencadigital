<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php
	astra_content_after();

	astra_footer_before();

	astra_footer();

	astra_footer_after();
?>
	</div><!-- #page -->
<?php
	astra_body_bottom();
	wp_footer();
?>

<script>
	// document.addEventListener("DOMContentLoaded", function () {
	// 	var header = document.getElementById("ast-desktop-header");
	// 	var alturaInicial = header.offsetTop;

	// 	window.addEventListener("scroll", function () {
	// 	if (window.pageYOffset > alturaInicial) {
	// 		header.classList.add("menu-fixo");
	// 	} else {
	// 		header.classList.remove("menu-fixo");
	// 	}
	// 	});
	// });

document.addEventListener("DOMContentLoaded", function () {
    var header = document.getElementById("ast-desktop-header");

    if (header) {
        console.log("Header 'ast-desktop-header' encontrado.");
    } else {
        console.log("ERRO: Header 'ast-desktop-header' NÃO encontrado. Verifique o ID do elemento.");
        return; 
    }

    var offset = header.offsetTop;
    const logoImage = document.querySelector('.site-branding img');

    if (logoImage) {
        console.log("Imagem do logo encontrada.");
    } else {
        console.log("ERRO: Imagem do logo NÃO encontrada. Verifique o seletor '.site-branding img'.");
    }

    // Defina as URLs e srcset para as duas versões do logo
    const logoOriginal = {
        src: "https://www.mktpresencadigital.com.br/wp-content/uploads/2025/05/logo-p.png",
        srcset: "https://www.mktpresencadigital.com.br/wp-content/uploads/2025/05/logo-p.png 1x, https://www.mktpresencadigital.com.br/wp-content/uploads/2025/04/logo-190-black.png 2x"
    };

    const logoBlack = {
        src: "https://www.mktpresencadigital.com.br/wp-content/uploads/2025/07/logo-p-black.png",
        srcset: "https://www.mktpresencadigital.com.br/wp-content/uploads/2025/07/logo-p-black.png 1x, https://www.mktpresencadigital.com.br/wp-content/uploads/2025/04/logo-190-black.png 2x"
    };

    window.addEventListener("scroll", function () {
        if (window.pageYOffset > offset) {
            header.classList.add("menu-fixo");

            // if (logoImage) {
            //     console.log("Ajustando menu e trocando logo para a versão preta.");
                
            //     // Altera todos os atributos de imagem para garantir que o lazy-loading também mude
            //     logoImage.src = logoBlack.src;
            //     logoImage.srcset = logoBlack.srcset;
                
            //     // Altera os atributos de lazy-loading e otimização
            //     logoImage.dataset.src = logoBlack.src;
            //     logoImage.dataset.srcset = logoBlack.srcset;
            // }
        } else {
            header.classList.remove("menu-fixo");

            // if (logoImage) {
            //     console.log("Ajustando menu e trocando logo para a versão original.");
                
            //     // Altera todos os atributos de imagem para a versão original
            //     logoImage.src = logoOriginal.src;
            //     logoImage.srcset = logoOriginal.srcset;
                
            //     // Altera os atributos de lazy-loading e otimização
            //     logoImage.dataset.src = logoOriginal.src;
            //     logoImage.dataset.srcset = logoOriginal.srcset;
            // }
        }
    });
});
</script>

	</body>

	
</html>
