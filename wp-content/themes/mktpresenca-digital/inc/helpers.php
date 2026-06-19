<?php
/**
 * Funções auxiliares do tema.
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_primary_menu_fallback() {
    echo '<ul class="menu-list">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/quem-somos/')) . '">Quem Somos</a></li>';
    echo '<li><a href="' . esc_url(home_url('/servicos/')) . '">Serviços</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contato/')) . '">Contato</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">Blog</a></li>';
    echo '</ul>';
}

function mktpd_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/quem-somos/')) . '">Quem Somos</a></li>';
    echo '<li><a href="' . esc_url(home_url('/servicos/')) . '">Serviços</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contato/')) . '">Contato</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">Blog</a></li>';
    echo '</ul>';
}
