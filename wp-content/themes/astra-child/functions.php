<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function meu_tema_astra_enqueue_styles() {

    // Enfileira o estilo do tema pai
    wp_enqueue_style( 'astra-style', get_stylesheet_directory_uri(). '/style.css' );

    // Enfileira o novo CSS do Bootstrap (se necessário)
    wp_enqueue_style( 'bootstrap-novo-css', get_stylesheet_directory_uri().'/bootstrap/css/bootstrap.min.css' );

    // Enfileira seu CSS personalizado
    wp_enqueue_style( 'meu-estilo-personalizado', get_stylesheet_directory_uri(). '/style.css', array('astra-style', 'bootstrap-novo-css'), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'meu_tema_astra_enqueue_styles' );

// Função para criar a tabela de assinaturas de newsletter
function criar_tabela_assinatura_news() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'assinatura_news'; // Use UNDERSCORE (_) não hífen (-)
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
        nome varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        data_assinatura datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('init', 'criar_tabela_assinatura_news');

function script_formulario_news() {
    wp_enqueue_script(
        'formulario-news', // Um nome único para o seu script
        get_stylesheet_directory_uri() . '/assets/js/formulario-news.js',
        array( 'jquery' ),
        null,
        true
    );

    // Passando dados do PHP para o JS
	wp_localize_script('formulario-news', 'meu_formulario', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('meu_formulario_nonce')
	));
	
}
add_action( 'wp_enqueue_scripts', 'script_formulario_news' );


function processar_meu_formulario_news() {
    // 1. Verificar o nonce (se estiver usando)
    if ( ! isset( $_POST['meu_nonce'] ) || ! wp_verify_nonce( $_POST['meu_nonce'], 'meu_formulario_nonce' ) ) {
        wp_send_json_error( 'Erro de segurança.' );
        wp_die();
    }

	$nome = isset($_POST['nome']) ? trim(sanitize_text_field($_POST['nome'])) : '';
	$email = isset($_POST['email']) ? trim(sanitize_email($_POST['email'])) : '';

	if ( $nome === '' ) {
		wp_send_json_error( 'Por favor, preencha o nome.' );
		wp_die();
	}

	if ( $email === '' || ! is_email( $email ) ) {
		wp_send_json_error( 'Por favor, insira um email válido.' );
		wp_die();
	}


    // 3. Inserir os dados no banco de dados
    global $wpdb;
    $table_name = $wpdb->prefix . 'assinatura_news'; // Exemplo de nome de tabela
	
    $data = array(
        'nome' => $nome,
        'email' => $email,
        'data_assinatura' => current_time( 'mysql' ),
    );


    $format = array( '%s', '%s', '%s' );

	$existe = $wpdb->get_var( $wpdb->prepare(
		"SELECT COUNT(*) FROM $table_name WHERE nome = %s AND email = %s",
		$nome,
		$email
	) );
	
	if ( $existe > 0 ) {
		wp_send_json_error( 'Este Nome ou e-mail já está cadastrado.' );
		wp_die();
	}

    $wpdb->insert( $table_name, $data, $format );

    //var_dump($wpdb);


    if ( $wpdb->insert_id ) {
        wp_send_json_success( 'Assinatura realizada com sucesso!' );
    } else {
        wp_send_json_error( 'Ocorreu um erro ao salvar sua assinatura.');
    }

    wp_die();
}

// 4. Hook a função à ação AJAX
add_action( 'wp_ajax_processar_meu_formulario', 'processar_meu_formulario_news' );
add_action( 'wp_ajax_nopriv_processar_meu_formulario', 'processar_meu_formulario_news' );


/** FORMULARIO DE ORÇAMENTOS **/

function processar_orcamento() {
    // 1. Verificar o nonce
    if ( ! isset( $_POST['orcamento_nonce_field'] ) || ! wp_verify_nonce( $_POST['orcamento_nonce_field'], 'orcamento_nonce' ) ) {
        wp_send_json_error( 'Erro de segurança.' );
        wp_die();
    }

    // 2. Sanear e validar os dados
    $nome = sanitize_text_field( $_POST['nome'] );
    $email = sanitize_email( $_POST['email'] );
    $telefone = sanitize_text_field( $_POST['telefone'] );
    $servicos = isset( $_POST['servicos'] ) ? array_map( 'sanitize_text_field', $_POST['servicos'] ) : array();
    $detalhes = sanitize_textarea_field( $_POST['detalhes'] );

    $errors = array();

    if ( empty( $nome ) ) {
        $errors[] = 'O campo Nome Completo é obrigatório.';
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        $errors[] = 'O campo Email é obrigatório e deve ser válido.';
    }

    if ( empty( $servicos ) ) {
        $errors[] = 'Selecione ao menos um serviço de interesse.';
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( implode( ' ', $errors ) );
        wp_die();
    }

    // 3. Salvar os dados do orçamento (opcional, mas recomendado)
    global $wpdb;
    $table_name_orcamentos = $wpdb->prefix . 'orcamentos';
    $servicos_str = implode( ', ', $servicos );

    $wpdb->insert(
        $table_name_orcamentos,
        array(
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'servicos' => $servicos_str,
            'detalhes' => $detalhes,
            'data_solicitacao' => current_time( 'mysql' ),
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s' )
    );

    $orcamento_id = $wpdb->insert_id;

    if ( $orcamento_id ) {
        // 4. Automatizar a criação do contrato
        $contrato_conteudo = gerar_contrato($nome, $email, $servicos, $detalhes);

        // 5. Salvar o contrato (exemplo: como um post personalizado)
        $post_id = wp_insert_post(array(
            'post_title'    => 'Contrato - ' . $nome . ' - ' . date('Y-m-d H:i:s'),
            'post_content'  => $contrato_conteudo,
            'post_status'   => 'draft', // Ou 'publish' se quiser publicar imediatamente
            'post_type'     => 'contrato', // Registre um tipo de post personalizado 'contrato'
        ));

        if ($post_id) {
            wp_send_json_success( 'Orçamento enviado com sucesso! Em breve entraremos em contato e o contrato foi gerado.' );
        } else {
            wp_send_json_error( 'Orçamento enviado com sucesso, mas houve um erro ao gerar o contrato.' );
        }

    } else {
        wp_send_json_error( 'Erro ao salvar a solicitação de orçamento.' );
    }

    wp_die();
}
add_action( 'wp_ajax_processar_orcamento', 'processar_orcamento' );
add_action( 'wp_ajax_nopriv_processar_orcamento', 'processar_orcamento' );

function gerar_contrato($nome, $email, $servicos, $detalhes) {
    $data_atual = date('d/m/Y');
    $servicos_formatados = implode(', ', array_map('traduzir_servico', $servicos));

    $contrato = "<h2>Contrato de Prestação de Serviços</h2>\n\n";
    $contrato .= "<p>Data: {$data_atual}</p>\n";
    $contrato .= "<p><b>Cliente:</b> {$nome}</p>\n";
    $contrato .= "<p><b>Email:</b> {$email}</p>\n";
    $contrato .= "<p><b>Serviços Contratados:</b> {$servicos_formatados}</p>\n";
    $contrato .= "<p><b>Detalhes Adicionais:</b> " . esc_html($detalhes) . "</p>\n\n";
    $contrato .= "<h3>Cláusulas:</h3>\n";
    $contrato .= "<p>Este contrato formaliza a prestação dos serviços listados acima, conforme os detalhes fornecidos pelo cliente. Os termos e condições específicos de cada serviço serão definidos em comunicação posterior.</p>\n";
    $contrato .= "<p>...</p>\n\n";
    $contrato .= "<p><b>Assinatura do Cliente:</b> _________________________</p>\n";
    $contrato .= "<p><b>Assinatura da Empresa:</b> _________________________</p>\n";

    return $contrato;
}

function traduzir_servico($servico_slug) {
    $servicos_traducao = array(
        'criacao_sites' => 'Criação de Sites e Landing Pages',
        'seo' => 'SEO',
        'redes_sociais' => 'Redes Sociais',
        'email_marketing' => 'Email Marketing',
        'analise_dados' => 'Análise de Dados e Métricas',
        'automacao_crm' => 'Automação e CRM',
    );
    return $servicos_traducao[$servico_slug] ?? $servico_slug;
}

// Função para enfileirar o script do formulário de orçamento
function script_formulario_orcamento() {
    wp_enqueue_script(
        'formulario-orcamento-script',
        get_stylesheet_directory_uri() . '/assets/js/formulario-orcamento.js', // Crie este arquivo JS
        array( 'jquery' ),
        null,
        true
    );

    wp_localize_script(
        'formulario-orcamento-script',
        'ajaxurl',
        admin_url( 'admin-ajax.php' )
    );
}
add_action( 'wp_enqueue_scripts', 'script_formulario_orcamento' );

// Registrar o tipo de post personalizado 'contrato' (opcional, mas recomendado)
function registrar_tipo_post_contrato() {
    register_post_type( 'contrato', array(
        'labels' => array(
            'name' => 'Contratos',
            'singular_name' => 'Contrato',
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array( 'title', 'editor' ),
    ));
}
add_action( 'init', 'registrar_tipo_post_contrato' );




function carregar_arquivo_por_url() {
    // Obtém a URL completa atual
    $current_url = $_SERVER['REQUEST_URI'];

    // Define as URLs que você quer verificar
    $url_localhost = 'mktpresencadigital/orcamento'; // Ajuste o protocolo se necessário
    $url_producao = 'https://www.mktpresencadigital.com.br/orcamento';

    // Obtém o caminho do arquivo a ser carregado
    $arquivo_para_carregar = get_stylesheet_directory() . '/template-parts/formulario/formulario-orcamento.php';

    // Verifica se a URL atual corresponde a uma das URLs definidas
    if ( $current_url === $url_localhost || $current_url === $url_producao ) {
        if ( file_exists( $arquivo_para_carregar ) ) {
            include_once $arquivo_para_carregar;
        } else {
            error_log( 'Arquivo não encontrado: ' . $arquivo_para_carregar );
        }
    }
}
add_action( 'wp', 'carregar_arquivo_por_url' );



//Criar a tabela de orçamentos no banco de dados (execute esta função uma vez)
function criar_tabela_orcamentos() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'orcamentos';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
        nome varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        telefone varchar(20) DEFAULT '',
        servicos text NOT NULL,
        detalhes text DEFAULT '',
        data_solicitacao datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
add_action( 'init', 'criar_tabela_orcamentos' );


// Add scripts to astra_header_before()
add_action( 'astra_entry_after', 'add_script_before_header' );
function add_script_before_header() {
    $current_url = $_SERVER['REQUEST_URI'];
    $arquivo_para_carregar = get_stylesheet_directory() . '/template-parts/formulario/formulario-orcamento.php';

    if($current_url == '/mktpresencadigital/orcamento/'){
        include_once $arquivo_para_carregar;
    }else{
        echo "<div class='wp-block-uagb-container uagb-block-b997312a alignfull uagb-is-root-container'></div>";
    }

}


// Processar envio do formulário de contato via Ajax
add_action('wp_ajax_processar_contato', 'processar_formulario_contato');
add_action('wp_ajax_nopriv_processar_contato', 'processar_formulario_contato');

function processar_formulario_contato() {
    // Verificar nonce para segurança
    if (!isset($_POST['contato_nonce_field']) || !wp_verify_nonce($_POST['contato_nonce_field'], 'contato_nonce')) {
        wp_send_json_error(['message' => 'Falha na verificação de segurança.']);
        wp_die();
    }

    // Captura e sanitiza os dados
    $nome = sanitize_text_field($_POST['nome'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $telefone = sanitize_text_field($_POST['telefone'] ?? '');
    $assunto = sanitize_text_field($_POST['assunto'] ?? '');
    $mensagem = sanitize_textarea_field($_POST['mensagem'] ?? '');

    // Validação dos campos
    if (empty($nome) || empty($email) || empty($telefone) || empty($assunto) || empty($mensagem)) {
        wp_send_json_error(['message' => 'Todos os campos são obrigatórios.']);
        wp_die();
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'O email informado é inválido.']);
        wp_die();
    }

    // Construir o conteúdo do email
    $para = 'mpresencadigital@gmail.com';
    $titulo = 'Novo Contato via Site - ' . get_bloginfo('name');

    $conteudo = "
        <strong>Nome:</strong> {$nome}<br>
        <strong>Email:</strong> {$email}<br>
        <strong>Telefone:</strong> {$telefone}<br>
        <strong>Assunto:</strong> {$assunto}<br>
        <strong>Mensagem:</strong><br>{$mensagem}
    ";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <no-reply@' . str_replace(['http://', 'https://', 'www.'], '', get_bloginfo('url')) . '>'
    ];

    // Enviar o email
    $enviado = wp_mail($para, $titulo, $conteudo, $headers);

    if ($enviado) {
        wp_send_json_success(['message' => 'Sua mensagem foi enviada com sucesso!']);
    } else {
        wp_send_json_error(['message' => 'Erro ao enviar sua mensagem. Tente novamente mais tarde.']);
    }

    wp_die();
}

// function remover_scripts_home() {
//     if (is_front_page()) {
//         wp_dequeue_script('formulario-orcamento.js', 'formulario-news.js');
//     }
// }
// add_action('wp_print_scripts', 'remover_scripts_home', 1);

function remover_formulario() {
    if (is_page('orcamento')) { // Substitua 'contato' pelo slug, ID ou título da sua página de contato
        wp_dequeue_script('formulario-news.js'); // Tente um nome genérico primeiro
        wp_deregister_script('formulario-news.js'); // Tente um nome genérico primeiro
    }
}
add_action('wp_enqueue_scripts', 'remover_formulario', 10);

// function remover_formulario_orcamento_na_home() {
//     if (is_page(1488)) { // Substitua 123 pelo ID da sua página de contato
//         wp_dequeue_script('formulario-orcamento-script-js');
//         wp_deregister_script('formulario-orcamento-script-js');
//     }
// }
// add_action('wp_enqueue_scripts', 'remover_formulario_orcamento_na_home', 10);


function remover_formulario_orcamento_na_contato() {
    error_log('A função remover_formulario_orcamento_na_contato() foi executada.');
    if (is_page('home')) { // Substitua 123 pelo ID ou slug correto
        //echo 'A condição ' . is_page("home") . ' é verdadeira.<br>';
        wp_dequeue_script('formulario-orcamento-script-js');
        wp_deregister_script('formulario-orcamento-script-js');
        //echo 'Scripts formulario-orcamento removidos.';
    }
}
add_action('wp_enqueue_scripts', 'remover_formulario_orcamento_na_contato', 100);
