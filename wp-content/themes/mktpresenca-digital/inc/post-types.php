<?php
/**
 * Custom Post Types do tema MKT Presença Digital.
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_register_project_post_type() {
    $labels = array(
        'name'                  => 'Projetos',
        'singular_name'         => 'Projeto',
        'menu_name'             => 'Projetos',
        'name_admin_bar'        => 'Projeto',
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar novo projeto',
        'new_item'              => 'Novo projeto',
        'edit_item'             => 'Editar projeto',
        'view_item'             => 'Ver projeto',
        'all_items'             => 'Todos os projetos',
        'search_items'          => 'Buscar projetos',
        'not_found'             => 'Nenhum projeto encontrado',
        'not_found_in_trash'    => 'Nenhum projeto encontrado na lixeira',
        'featured_image'        => 'Imagem do projeto',
        'set_featured_image'    => 'Definir imagem do projeto',
        'remove_featured_image' => 'Remover imagem do projeto',
        'use_featured_image'    => 'Usar como imagem do projeto',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Projetos e cases de presença digital.',
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'projetos'),
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
    );

    register_post_type('projetos', $args);
}
add_action('init', 'mktpd_register_project_post_type');

function mktpd_register_project_taxonomy() {
    $labels = array(
        'name'              => 'Segmentos',
        'singular_name'     => 'Segmento',
        'search_items'      => 'Buscar segmentos',
        'all_items'         => 'Todos os segmentos',
        'edit_item'         => 'Editar segmento',
        'update_item'       => 'Atualizar segmento',
        'add_new_item'      => 'Adicionar novo segmento',
        'new_item_name'     => 'Novo segmento',
        'menu_name'         => 'Segmentos',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'segmento'),
    );

    register_taxonomy('segmento_projeto', array('projetos'), $args);
}
add_action('init', 'mktpd_register_project_taxonomy');

function mktpd_add_project_metaboxes() {
    add_meta_box(
        'mktpd_project_details',
        'Detalhes do Projeto',
        'mktpd_render_project_details_metabox',
        'projetos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mktpd_add_project_metaboxes');

function mktpd_render_project_details_metabox($post) {
    wp_nonce_field('mktpd_save_project_details', 'mktpd_project_details_nonce');

    $fields = array(
        'mktpd_project_client'       => 'Cliente',
        'mktpd_project_website'      => 'Website do projeto',
        'mktpd_project_challenge'    => 'Desafio',
        'mktpd_project_solution'     => 'Solução aplicada',
        'mktpd_project_differential' => 'Diferenciais',
        'mktpd_project_services'     => 'Serviços aplicados',
    );

    foreach ($fields as $field_id => $label) {
        $value = get_post_meta($post->ID, $field_id, true);

        echo '<p>';
        echo '<label for="' . esc_attr($field_id) . '"><strong>' . esc_html($label) . '</strong></label><br>';

        if (in_array($field_id, array('mktpd_project_challenge', 'mktpd_project_solution', 'mktpd_project_differential', 'mktpd_project_services'), true)) {
            echo '<textarea id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" rows="4" style="width:100%;">' . esc_textarea($value) . '</textarea>';
        } else {
            echo '<input type="text" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($value) . '" style="width:100%;">';
        }

        echo '</p>';
    }

    $featured = get_post_meta($post->ID, 'mktpd_project_featured', true);

    echo '<p>';
    echo '<label>';
    echo '<input type="checkbox" name="mktpd_project_featured" value="1" ' . checked($featured, '1', false) . '> ';
    echo 'Exibir na Home';
    echo '</label>';
    echo '</p>';
}

function mktpd_save_project_details($post_id) {
    if (!isset($_POST['mktpd_project_details_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mktpd_project_details_nonce'])), 'mktpd_save_project_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $text_fields = array(
        'mktpd_project_client',
        'mktpd_project_website',
    );

    foreach ($text_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_text_field(wp_unslash($_POST[$field_id])));
        }
    }

    $textarea_fields = array(
        'mktpd_project_challenge',
        'mktpd_project_solution',
        'mktpd_project_differential',
        'mktpd_project_services',
    );

    foreach ($textarea_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_textarea_field(wp_unslash($_POST[$field_id])));
        }
    }

    $featured = isset($_POST['mktpd_project_featured']) ? '1' : '0';
    update_post_meta($post_id, 'mktpd_project_featured', $featured);
}
add_action('save_post_projetos', 'mktpd_save_project_details');

/**
 * CPT Quem Somos.
 */
function mktpd_register_qsomos_post_type() {
    $labels = array(
        'name'                  => 'Quem Somos',
        'singular_name'         => 'Quem Somos',
        'menu_name'             => 'Quem Somos',
        'name_admin_bar'        => 'Quem Somos',
        'add_new'               => 'Adicionar novo',
        'add_new_item'          => 'Adicionar conteúdo Quem Somos',
        'new_item'              => 'Novo conteúdo Quem Somos',
        'edit_item'             => 'Editar Quem Somos',
        'view_item'             => 'Ver Quem Somos',
        'all_items'             => 'Todos os conteúdos',
        'search_items'          => 'Buscar conteúdo',
        'not_found'             => 'Nenhum conteúdo encontrado',
        'not_found_in_trash'    => 'Nenhum conteúdo encontrado na lixeira',
        'featured_image'        => 'Imagem da seção Quem Somos',
        'set_featured_image'    => 'Definir imagem da seção',
        'remove_featured_image' => 'Remover imagem da seção',
        'use_featured_image'    => 'Usar como imagem da seção',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Conteúdo administrável da página Quem Somos.',
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-id-alt',
        'show_in_rest'       => true,
        'has_archive'        => false,
        'rewrite'            => array('slug' => 'quem-somos-conteudo'),
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
    );

    register_post_type('qsomos', $args);
}
add_action('init', 'mktpd_register_qsomos_post_type');

function mktpd_add_qsomos_metaboxes() {
    add_meta_box(
        'mktpd_qsomos_details',
        'Conteúdo da página Quem Somos',
        'mktpd_render_qsomos_details_metabox',
        'qsomos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mktpd_add_qsomos_metaboxes');

function mktpd_qsomos_text_fields() {
    return array(
        'mktpd_qsomos_hero_eyebrow'       => 'Hero - chamada superior',
        'mktpd_qsomos_hero_title'         => 'Hero - título',
        'mktpd_qsomos_about_eyebrow'      => 'Sobre - chamada superior',
        'mktpd_qsomos_about_title'        => 'Sobre - título',
        'mktpd_qsomos_feature_1_label'    => 'Destaque 1 - texto',
        'mktpd_qsomos_feature_1_url'      => 'Destaque 1 - URL',
        'mktpd_qsomos_feature_2_label'    => 'Destaque 2 - texto',
        'mktpd_qsomos_feature_2_url'      => 'Destaque 2 - URL',
        'mktpd_qsomos_feature_3_label'    => 'Destaque 3 - texto',
        'mktpd_qsomos_feature_3_url'      => 'Destaque 3 - URL',
        'mktpd_qsomos_feature_4_label'    => 'Destaque 4 - texto',
        'mktpd_qsomos_feature_4_url'      => 'Destaque 4 - URL',
        'mktpd_qsomos_method_eyebrow'     => 'Metodologia - chamada superior',
        'mktpd_qsomos_method_title'       => 'Metodologia - título',
        'mktpd_qsomos_method_1_title'     => 'Método 1 - título',
        'mktpd_qsomos_method_2_title'     => 'Método 2 - título',
        'mktpd_qsomos_method_3_title'     => 'Método 3 - título',
        'mktpd_qsomos_method_4_title'     => 'Método 4 - título',
        'mktpd_qsomos_stat_1_value'       => 'Indicador 1 - valor',
        'mktpd_qsomos_stat_1_label'       => 'Indicador 1 - legenda',
        'mktpd_qsomos_stat_2_value'       => 'Indicador 2 - valor',
        'mktpd_qsomos_stat_2_label'       => 'Indicador 2 - legenda',
        'mktpd_qsomos_stat_3_value'       => 'Indicador 3 - valor',
        'mktpd_qsomos_stat_3_label'       => 'Indicador 3 - legenda',
        'mktpd_qsomos_stat_4_value'       => 'Indicador 4 - valor',
        'mktpd_qsomos_stat_4_label'       => 'Indicador 4 - legenda',
        'mktpd_qsomos_values_eyebrow'     => 'Posicionamento - chamada superior',
        'mktpd_qsomos_values_title'       => 'Posicionamento - título',
        'mktpd_qsomos_value_1_title'      => 'Valor 1 - título',
        'mktpd_qsomos_value_2_title'      => 'Valor 2 - título',
        'mktpd_qsomos_value_3_title'      => 'Valor 3 - título',
        'mktpd_qsomos_cta_eyebrow'        => 'CTA - chamada superior',
        'mktpd_qsomos_cta_title'          => 'CTA - título',
        'mktpd_qsomos_cta_button_label'   => 'CTA - texto do botão',
        'mktpd_qsomos_cta_button_url'     => 'CTA - URL do botão',
    );
}

function mktpd_qsomos_textarea_fields() {
    return array(
        'mktpd_qsomos_hero_description'   => 'Hero - descrição',
        'mktpd_qsomos_about_text_1'       => 'Sobre - texto 1',
        'mktpd_qsomos_about_text_2'       => 'Sobre - texto 2',
        'mktpd_qsomos_method_description' => 'Metodologia - descrição',
        'mktpd_qsomos_method_1_text'      => 'Método 1 - texto',
        'mktpd_qsomos_method_2_text'      => 'Método 2 - texto',
        'mktpd_qsomos_method_3_text'      => 'Método 3 - texto',
        'mktpd_qsomos_method_4_text'      => 'Método 4 - texto',
        'mktpd_qsomos_values_text'        => 'Posicionamento - texto',
        'mktpd_qsomos_value_1_text'       => 'Valor 1 - texto',
        'mktpd_qsomos_value_2_text'       => 'Valor 2 - texto',
        'mktpd_qsomos_value_3_text'       => 'Valor 3 - texto',
        'mktpd_qsomos_cta_text'           => 'CTA - texto',
    );
}

function mktpd_render_qsomos_details_metabox($post) {
    wp_nonce_field('mktpd_save_qsomos_details', 'mktpd_qsomos_details_nonce');

    echo '<p><strong>Imagem principal:</strong> use a imagem destacada deste conteúdo.</p>';
    echo '<p><label><input type="checkbox" name="mktpd_qsomos_cta_enabled" value="1" ' . checked(get_post_meta($post->ID, 'mktpd_qsomos_cta_enabled', true), '1', false) . '> Exibir CTA final</label></p>';

    foreach (mktpd_qsomos_text_fields() as $field_id => $label) {
        $value = get_post_meta($post->ID, $field_id, true);

        echo '<p>';
        echo '<label for="' . esc_attr($field_id) . '"><strong>' . esc_html($label) . '</strong></label><br>';
        echo '<input type="text" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($value) . '" style="width:100%;">';
        echo '</p>';
    }

    foreach (mktpd_qsomos_textarea_fields() as $field_id => $label) {
        $value = get_post_meta($post->ID, $field_id, true);

        echo '<p>';
        echo '<label for="' . esc_attr($field_id) . '"><strong>' . esc_html($label) . '</strong></label><br>';
        echo '<textarea id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" rows="4" style="width:100%;">' . esc_textarea($value) . '</textarea>';
        echo '</p>';
    }
}

function mktpd_save_qsomos_details($post_id) {
    if (!isset($_POST['mktpd_qsomos_details_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mktpd_qsomos_details_nonce'])), 'mktpd_save_qsomos_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    foreach (mktpd_qsomos_text_fields() as $field_id => $label) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_text_field(wp_unslash($_POST[$field_id])));
        }
    }

    foreach (mktpd_qsomos_textarea_fields() as $field_id => $label) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_textarea_field(wp_unslash($_POST[$field_id])));
        }
    }

    $cta_enabled = isset($_POST['mktpd_qsomos_cta_enabled']) ? '1' : '0';
    update_post_meta($post_id, 'mktpd_qsomos_cta_enabled', $cta_enabled);
}
add_action('save_post_qsomos', 'mktpd_save_qsomos_details');

