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
