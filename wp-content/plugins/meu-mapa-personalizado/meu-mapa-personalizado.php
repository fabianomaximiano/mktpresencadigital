<?php
/**
 * Plugin Name: Meu Mapa Personalizado
 * Plugin URI: https://www.fabianomaximiano.com.br/meu-mapa-personalizado
 * Description: Exibe um mapa do Google Maps personalizado com um marcador.
 * Version: 1.0.0
 * Author: Fabiano Maximiano
 * Author URI: https://www.fabianomaximiano.com.br
 * License: GPL2
 */
//error_log('Meu plugin está sendo carregado!');

// Evita acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Inclui o arquivo principal do plugin
require_once plugin_dir_path(__FILE__) . 'includes/class-meu-mapa-personalizado.php';

// Inicializa o plugin
function meu_mapa_personalizado_init() {
    new Meu_Mapa_Personalizado();
}
add_action('plugins_loaded', 'meu_mapa_personalizado_init');