<?php
/*
Plugin Name: Meu Plugin de Formulário de Contato
Description: Plugin para formulário de contato com shortcode.
Version: 1.0
Author: Fabiano Maximiano
*/

if (!defined('ABSPATH')) {
    exit;
}

// Carrega a classe
require_once plugin_dir_path(__FILE__) . 'inc/formulario-contato/class-formulario-contato.php';

// Instancia a classe
new Formulario_Contato();
