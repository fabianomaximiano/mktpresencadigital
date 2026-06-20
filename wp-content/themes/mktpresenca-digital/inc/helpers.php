<?php
/**
 * Funções auxiliares do tema.
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_get_active_menu_class($path) {
    $current_path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    $target_path  = trim($path, '/');

    if ($target_path === '' && is_front_page()) {
        return ' class="current-menu-item current_page_item"';
    }

    if ($target_path !== '' && $current_path === $target_path) {
        return ' class="current-menu-item current_page_item"';
    }

    return '';
}

function mktpd_primary_menu_fallback() {
    echo '<ul class="menu-list">';
    echo '<li' . mktpd_get_active_menu_class('/') . '><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li' . mktpd_get_active_menu_class('/quem-somos/') . '><a href="' . esc_url(home_url('/quem-somos/')) . '">Quem Somos</a></li>';
    echo '<li' . mktpd_get_active_menu_class('/servicos/') . '><a href="' . esc_url(home_url('/servicos/')) . '">Serviços</a></li>';
    echo '<li' . mktpd_get_active_menu_class('/contato/') . '><a href="' . esc_url(home_url('/contato/')) . '">Contato</a></li>';
    echo '<li' . mktpd_get_active_menu_class('/blog/') . '><a href="' . esc_url(home_url('/blog/')) . '">Blog</a></li>';
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