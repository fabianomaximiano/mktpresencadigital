<?php
/**
 * Configurações básicas do tema.
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');

    register_nav_menus(array(
        'primary' => 'Menu Principal',
        'footer'  => 'Menu Rodapé',
    ));
}
add_action('after_setup_theme', 'mktpd_theme_setup');
