<?php
/**
 * Header principal do tema MKT Presença Digital.
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <?php if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <span class="logo-main">MKT Presença</span>
                <span class="logo-sub">Digital</span>
            </a>
        <?php endif; ?>

        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Abrir menu" aria-controls="mainNav" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" id="mainNav" aria-label="Menu principal">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'menu-list',
                'fallback_cb'    => 'mktpd_primary_menu_fallback',
                'depth'          => 1,
            ));
            ?>

            <a class="btn-header" href="<?php echo esc_url(home_url('/orcamento/')); ?>">
                Solicitar orçamento
            </a>
        </nav>
    </div>
</header>