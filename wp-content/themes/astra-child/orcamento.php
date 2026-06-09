<?php
/**
 * Template Name: Orçamento
 */


 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) { ?>

	<?php get_sidebar(); ?>

<?php } ?>

	<div class="fundo" id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>
		<?php astra_content_page_loop(); ?>
		<?php astra_primary_content_bottom(); ?>
		<?php
		
			require_once('template-parts/formulario/formulario-orcamento.php'); 
			
		?>

<?php if ( astra_page_layout() == 'right-sidebar' ) { ?>

	<?php get_sidebar(); ?>

<?php } ?>
<?php get_footer(); ?>
