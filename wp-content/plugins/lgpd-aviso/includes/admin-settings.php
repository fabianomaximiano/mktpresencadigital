<?php

// Adiciona o menu de configurações no painel de administração

function lgpd_adicionar_menu() {

    add_menu_page(

        'Configurações LGPD',

        'LGPD',

        'manage_options',

        'lgpd-configuracoes',

        'lgpd_pagina_configuracao',

        'dashicons-privacy',

        24

    );

}



add_action( 'admin_menu', 'lgpd_adicionar_menu' );



// Exibir a página de configurações LGPD

function lgpd_pagina_configuracao() {

    ?>

    <div class="wrap">

        <h1>Configurações LGPD</h1>

        <form method="post" action="options.php" enctype="multipart/form-data">

            <?php

            settings_fields( 'lgpd_opcoes' );

            do_settings_sections( 'lgpd-configuracoes' );

            submit_button();

            ?>

        </form>

    </div>

    <?php

}



// Registra as configurações do plugin

function lgpd_registrar_configuracoes() {

    register_setting( 'lgpd_opcoes', 'lgpd_documentos' );



    add_settings_section( 'lgpd_secao_documentos', 'Documentos LGPD', null, 'lgpd-configuracoes' );



    $tipos_negocio = [

        'pizzaria' => 'Pizzaria',

        'confeitaria' => 'Confeitaria',

        'acougue' => 'Açougue',

        'minimercado' => 'Mini-mercado',

        'saloes_beleza' => 'Salões de Beleza',

        'manicure_pedicure' => 'Manicure / Pedicure',

        'cabeleireiro' => 'Cabeleireiro',

        'barber_shop' => 'Barber Shop'

    ];



    foreach ($tipos_negocio as $slug => $nome) {

        add_settings_field(

            $slug,

            $nome,

            'lgpd_exibir_input_documento',

            'lgpd-configuracoes',

            'lgpd_secao_documentos',

            ['slug' => $slug]

        );

    }

}



add_action( 'admin_init', 'lgpd_registrar_configuracoes' );



// Exibe os campos de upload de documentos

function lgpd_exibir_input_documento($args) {

    $opcoes = get_option('lgpd_documentos');

    $slug = $args['slug'];

    $valor = isset($opcoes[$slug]) ? $opcoes[$slug] : '';

    ?>

    <input type="file" name="lgpd_documentos[<?php echo esc_attr($slug); ?>]" value="<?php echo esc_attr($valor); ?>" />

    <?php

}



// Salva os documentos carregados

function lgpd_salvar_documentos($input) {

    $opcoes = get_option('lgpd_documentos');

    if (!empty($_FILES['lgpd_documentos'])) {

        foreach ($_FILES['lgpd_documentos'] as $slug => $file) {

            if (!empty($file['name'])) {

                $upload = wp_handle_upload($file, ['test_form' => false]);

                if (!isset($upload['error'])) {

                    $opcoes[$slug] = $upload['url'];

                }

            }

        }

    }

    return $opcoes;

}



add_filter('pre_update_option_lgpd_documentos', 'lgpd_salvar_documentos');

