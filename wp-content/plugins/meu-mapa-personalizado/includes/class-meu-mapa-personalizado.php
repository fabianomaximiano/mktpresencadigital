<?php

if (!defined('ABSPATH')) {
    exit;
}

class Meu_Mapa_Personalizado {

    private $shortcode_usado = false;

    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('wp_enqueue_scripts', array($this, 'condicional_enqueue_scripts'));
        add_shortcode('mapa_personalizado', array($this, 'exibir_mapa'));
        add_filter('script_loader_tag', array($this, 'adicionar_async_defer'), 10, 3);
    }

    public function add_admin_menu() {
        add_options_page(
            'Configurações do Mapa Personalizado',
            'Mapa Personalizado',
            'manage_options',
            'meu-mapa-personalizado-settings',
            array($this, 'settings_page')
        );
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function register_settings() {
        register_setting('meu_mapa_personalizado_group', 'mm_api_key');
        register_setting('meu_mapa_personalizado_group', 'mm_endereco_empresa');
        register_setting('meu_mapa_personalizado_group', 'mm_zoom_nivel', array(
            'sanitize_callback' => 'absint', 
            'default' => 15
        ));
        register_setting('meu_mapa_personalizado_group', 'mm_icone_url');
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Configurações do Mapa Personalizado</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('meu_mapa_personalizado_group');
                do_settings_sections('meu-mapa-personalizado-settings');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="mm_api_key">Chave da API do Google Maps</label></th>
                        <td><input type="text" id="mm_api_key" name="mm_api_key" value="<?php echo esc_attr(get_option('mm_api_key')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="mm_endereco_empresa">Endereço da Empresa</label></th>
                        <td><input type="text" id="mm_endereco_empresa" name="mm_endereco_empresa" value="<?php echo esc_attr(get_option('mm_endereco_empresa')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="mm_zoom_nivel">Nível de Zoom</label></th>
                        <td><input type="number" id="mm_zoom_nivel" name="mm_zoom_nivel" value="<?php echo esc_attr(get_option('mm_zoom_nivel')); ?>" min="1" max="20" class="small-text" /> (Padrão: 15)</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="mm_icone_url">URL do Ícone Personalizado</label></th>
                        <td><input type="text" id="mm_icone_url" name="mm_icone_url" value="<?php echo esc_url(get_option('mm_icone_url')); ?>" class="regular-text" placeholder="Opcional" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Marca que a shortcode foi usada.
     */
    public function exibir_mapa($atts) {
        $this->shortcode_usado = true;

        if (!get_option('mm_api_key') || !get_option('mm_endereco_empresa')) {
            return '<p>Por favor, configure a Chave da API do Google Maps e o Endereço da Empresa nas <a href="' . admin_url('options-general.php?page=meu-mapa-personalizado-settings') . '">Configurações do Mapa Personalizado</a>.</p>';
        }
        return '<div id="map" style="height: 750px; margin-bottom: 0px"></div>';
    }

    /**
     * Condicionalmente carrega scripts apenas se a shortcode foi usada.
     */
    public function condicional_enqueue_scripts() {
        if (is_singular() && has_shortcode(get_post()->post_content, 'mapa_personalizado')) {
            $this->enqueue_scripts();
        }
    }

    /**
     * Carrega os scripts necessários.
     */
    public function enqueue_scripts() {
        $api_key = get_option('mm_api_key');
        if ($api_key) {
            wp_enqueue_script(
                'google-maps', 
                'https://maps.googleapis.com/maps/api/js?key=' . esc_attr($api_key) . '&callback=initMap', 
                array(), 
                null, 
                true
            );

            wp_enqueue_script(
                'meu-mapa-script', 
                plugin_dir_url(__FILE__) . '../assets/js/mapa.js', 
                array('google-maps'), 
                '1.0.0', 
                true
            );

            wp_localize_script('meu-mapa-script', 'mapa_vars', array(
                'endereco' => get_option('mm_endereco_empresa'),
                'icone_url' => get_option('mm_icone_url'),
                'zoom_nivel' => get_option('mm_zoom_nivel') ? get_option('mm_zoom_nivel') : 15,
            ));
        }
    }

    /**
     * Adiciona async defer ao script do Google Maps.
     */
    public function adicionar_async_defer($tag, $handle, $src) {
        if ('google-maps' === $handle) {
            return '<script src="' . esc_url($src) . '" async defer></script>';
        }
        return $tag;
    }
}
