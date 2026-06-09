<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) { ?>

	<?php get_sidebar(); ?>

<?php } ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>
		<?php astra_content_page_loop(); ?>
		<?php astra_primary_content_bottom(); ?>
		<?php 
			$current_url = $_SERVER['REQUEST_URI'];
			$arquivo_para_carregar = get_stylesheet_directory() . '/template-parts/formulario/formulario-news.php'; 
			if($current_url == '/mktpresencadigital/orcamento/'){
				echo '<div></div>';
			}else{
				include_once $arquivo_para_carregar;
			}

		// $page_id = 123; // Substitua por o ID da página
		// $slug = get_post_field('post_name', get_post($page_id));
		// echo "Slug da página: " . $slug;
		?>

<?php if ( astra_page_layout() == 'right-sidebar' ) { ?>

	<?php get_sidebar(); ?>

<?php } ?>
<?php get_footer(); ?>
