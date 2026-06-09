<?php
/*
Plugin Name: Aviso LGPD Simples
Description: Exibe um aviso de cookies conforme a LGPD no rodapé.
Version: 1.0
Author: Fabiano Maximiano
*/


if (!defined('ABSPATH')) {
    exit; // Sai se acessar diretamente
}

class Aviso_LGPD {

    public function __construct() {
        add_action('admin_menu', [$this, 'adicionar_menu']);
        add_action('admin_init', [$this, 'registrar_configuracoes']);
        add_action('wp_footer', [$this, 'exibir_aviso_lgpd']);
        add_action('wp_enqueue_scripts', [$this, 'carregar_estilos']);
    }

    public function adicionar_menu() {
        add_options_page(
            'Configurações LGPD',
            'LGPD Aviso',
            'manage_options',
            'lgpd-aviso',
            [$this, 'pagina_configuracoes']
        );
    }

    public function registrar_configuracoes() {
        register_setting('lgpd_aviso_opcoes', 'lgpd_mensagem');
    }

    public function pagina_configuracoes() {
        ?>
        <div class="wrap">
            <h1>Configurações do Aviso LGPD</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('lgpd_aviso_opcoes');
                do_settings_sections('lgpd_aviso_opcoes');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Mensagem do aviso:</th>
                        <td><textarea name="lgpd_mensagem" rows="5" cols="50"><?php echo esc_textarea(get_option('lgpd_mensagem', 'Este site utiliza cookies para melhorar sua experiência.')); ?></textarea></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

 
    public function carregar_estilos() {
        wp_enqueue_style('aviso-lgpd-style', plugin_dir_url(__FILE__) . '/assets/css/lgpd-aviso.css');
        wp_enqueue_script('aviso-lgpd-script', plugin_dir_url(__FILE__) . '/assets/js/lgpd-aviso.js', [], false, true);
    }

    public function exibir_aviso_lgpd() {
        $mensagem = get_option('lgpd_mensagem', 'Este site utiliza cookies para melhorar sua experiência.');
        ?>
        <div id="aviso-lgpd" class="aviso-lgpd">
            <p><?php echo wp_kses_post($mensagem); ?> <a href="/politica-de-privacidade" target="_blank">Saiba mais</a>.</p>
            <button id="aceitar-lgpd">Aceitar</button>
        </div>
        <?php
    }

}

   // Incluir as funções de administração
   require_once plugin_dir_path( __FILE__ ) . 'includes/admin-settings.php';

   // Incluir as funções de front-end
   require_once plugin_dir_path( __FILE__ ) . 'includes/public-functions.php';
   

new Aviso_LGPD();

