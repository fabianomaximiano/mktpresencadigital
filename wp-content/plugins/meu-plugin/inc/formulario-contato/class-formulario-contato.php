<?php
if (!defined('ABSPATH')) {
    exit;
}

class Formulario_Contato {

    public function __construct() {
        add_shortcode('formulario_contato', array($this, 'renderizar_formulario'));
        add_action('wp_enqueue_scripts', array($this, 'registrar_scripts'));
        add_action('wp_ajax_enviar_formulario_contato', array($this, 'processar_formulario'));
        add_action('wp_ajax_nopriv_enviar_formulario_contato', array($this, 'processar_formulario'));
    }

    public function registrar_scripts() {
        // Registra JS
        wp_register_script('formulario-contato-js', plugin_dir_url(__FILE__) . 'formulario-contato.js', array('jquery'), '1.0', true);

        // Localiza variáveis
        wp_localize_script('formulario-contato-js', 'formularioContatoVars', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('formulario_contato_nonce')
        ));
    }

    public function renderizar_formulario() {
        // Garante que o JS está carregado
        wp_enqueue_script('formulario-contato-js');

        ob_start();
        include plugin_dir_path(__FILE__) . 'formulario-contato.php';
        return ob_get_clean();
    }

    public function processar_formulario() {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'formulario_contato_nonce')) {
            wp_send_json_error(array('message' => 'Acesso não autorizado.'));
        }

        $nome = sanitize_text_field($_POST['nome']);
        $email = sanitize_email($_POST['email']);
        $telefone = sanitize_text_field($_POST['telefone']);
        $assunto = sanitize_text_field($_POST['assunto']);
        $mensagem = sanitize_textarea_field($_POST['mensagem']);

        if (empty($nome) || empty($email) || empty($telefone) || empty($assunto) || empty($mensagem)) {
            wp_send_json_error(array('message' => 'Todos os campos são obrigatórios.'));
        }

        $to = 'mpresencadigital@gmail.com';
        $subject = 'Novo contato via formulário';
        $body = "Nome: $nome\nEmail: $email\nTelefone: $telefone\nAssunto: $assunto\nMensagem:\n$mensagem";
        $headers = array('Content-Type: text/plain; charset=UTF-8', "Reply-To: $nome <$email>");

        $sent = wp_mail($to, $subject, $body, $headers);

        if ($sent) {
            wp_send_json_success(array('message' => 'Mensagem enviada com sucesso!'));
        } else {
            wp_send_json_error(array('message' => 'Erro ao enviar mensagem. Tente novamente.'));
        }
    }
}
