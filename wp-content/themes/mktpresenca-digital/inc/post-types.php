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
        'add_new'               => 'Adicionar conteúdo',
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
        'labels'              => $labels,
        'description'         => 'Conteúdo dinâmico da página Quem Somos.',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-id-alt',
        'show_in_rest'        => false,
        'has_archive'         => false,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'rewrite'             => array('slug' => 'quem-somos-conteudo'),
        'supports'            => array('thumbnail', 'page-attributes', 'revisions'),
    );

    register_post_type('qsomos', $args);
}
add_action('init', 'mktpd_register_qsomos_post_type');

/**
 * Campos administráveis do Quem Somos.
 */
function mktpd_qsomos_field_groups() {
    return array(
        'hero' => array(
            'title'       => 'Hero',
            'description' => 'Conteúdo exibido no topo da página.',
            'fields'      => array(
                'mktpd_qsomos_hero_eyebrow'     => array('label' => 'Hero - chamada superior', 'type' => 'text'),
                'mktpd_qsomos_hero_title'       => array('label' => 'Hero - título', 'type' => 'text'),
                'mktpd_qsomos_hero_image_id'    => array('label' => 'Hero - imagem de fundo', 'type' => 'image', 'description' => 'Recomendado: 1920x1080 px (16:9) • WebP • até 250 KB.'),
                'mktpd_qsomos_hero_description' => array('label' => 'Hero - descrição', 'type' => 'textarea', 'rows' => 4),
            ),
        ),
        'about' => array(
            'title'       => 'Seção Sobre',
            'description' => 'Imagem principal pela coluna lateral: use a imagem destacada do post.',
            'fields'      => array(
                'mktpd_qsomos_about_eyebrow' => array('label' => 'Sobre - chamada superior', 'type' => 'text'),
                'mktpd_qsomos_about_title'   => array('label' => 'Sobre - título', 'type' => 'text'),
                'mktpd_qsomos_about_text_1'  => array('label' => 'Sobre - texto 1', 'type' => 'textarea', 'rows' => 4),
                'mktpd_qsomos_about_text_2'  => array('label' => 'Sobre - texto 2', 'type' => 'textarea', 'rows' => 4),
            ),
        ),
        'features' => array(
            'title'       => 'Destaques',
            'description' => 'Os destaques aparecem em formato de botões/cards abaixo do texto da seção Sobre.',
            'fields'      => array(
                'mktpd_qsomos_feature_1_label' => array('label' => 'Destaque 1 - texto', 'type' => 'text'),
                'mktpd_qsomos_feature_1_url'   => array('label' => 'Destaque 1 - URL', 'type' => 'url'),
                'mktpd_qsomos_feature_2_label' => array('label' => 'Destaque 2 - texto', 'type' => 'text'),
                'mktpd_qsomos_feature_2_url'   => array('label' => 'Destaque 2 - URL', 'type' => 'url'),
                'mktpd_qsomos_feature_3_label' => array('label' => 'Destaque 3 - texto', 'type' => 'text'),
                'mktpd_qsomos_feature_3_url'   => array('label' => 'Destaque 3 - URL', 'type' => 'url'),
                'mktpd_qsomos_feature_4_label' => array('label' => 'Destaque 4 - texto', 'type' => 'text'),
                'mktpd_qsomos_feature_4_url'   => array('label' => 'Destaque 4 - URL', 'type' => 'url'),
            ),
        ),
        'method' => array(
            'title'       => 'Metodologia',
            'description' => 'Processo de trabalho apresentado em quatro etapas.',
            'fields'      => array(
                'mktpd_qsomos_method_eyebrow'     => array('label' => 'Metodologia - chamada superior', 'type' => 'text'),
                'mktpd_qsomos_method_title'       => array('label' => 'Metodologia - título', 'type' => 'text'),
                'mktpd_qsomos_method_description' => array('label' => 'Metodologia - descrição', 'type' => 'textarea', 'rows' => 4),
                'mktpd_qsomos_method_1_title'     => array('label' => 'Método 1 - título', 'type' => 'text'),
                'mktpd_qsomos_method_1_text'      => array('label' => 'Método 1 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_method_2_title'     => array('label' => 'Método 2 - título', 'type' => 'text'),
                'mktpd_qsomos_method_2_text'      => array('label' => 'Método 2 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_method_3_title'     => array('label' => 'Método 3 - título', 'type' => 'text'),
                'mktpd_qsomos_method_3_text'      => array('label' => 'Método 3 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_method_4_title'     => array('label' => 'Método 4 - título', 'type' => 'text'),
                'mktpd_qsomos_method_4_text'      => array('label' => 'Método 4 - texto', 'type' => 'textarea', 'rows' => 3),
            ),
        ),
        'stats' => array(
            'title'       => 'Indicadores',
            'description' => 'Números exibidos na faixa escura da página.',
            'fields'      => array(
                'mktpd_qsomos_stat_1_value' => array('label' => 'Indicador 1 - valor', 'type' => 'text'),
                'mktpd_qsomos_stat_1_label' => array('label' => 'Indicador 1 - legenda', 'type' => 'text'),
                'mktpd_qsomos_stat_2_value' => array('label' => 'Indicador 2 - valor', 'type' => 'text'),
                'mktpd_qsomos_stat_2_label' => array('label' => 'Indicador 2 - legenda', 'type' => 'text'),
                'mktpd_qsomos_stat_3_value' => array('label' => 'Indicador 3 - valor', 'type' => 'text'),
                'mktpd_qsomos_stat_3_label' => array('label' => 'Indicador 3 - legenda', 'type' => 'text'),
                'mktpd_qsomos_stat_4_value' => array('label' => 'Indicador 4 - valor', 'type' => 'text'),
                'mktpd_qsomos_stat_4_label' => array('label' => 'Indicador 4 - legenda', 'type' => 'text'),
            ),
        ),
        'values' => array(
            'title'       => 'Posicionamento e Valores',
            'description' => 'Bloco de posicionamento institucional e três valores principais.',
            'fields'      => array(
                'mktpd_qsomos_values_eyebrow' => array('label' => 'Posicionamento - chamada superior', 'type' => 'text'),
                'mktpd_qsomos_values_title'   => array('label' => 'Posicionamento - título', 'type' => 'text'),
                'mktpd_qsomos_values_text'    => array('label' => 'Posicionamento - texto', 'type' => 'textarea', 'rows' => 4),
                'mktpd_qsomos_value_1_title'  => array('label' => 'Valor 1 - título', 'type' => 'text'),
                'mktpd_qsomos_value_1_text'   => array('label' => 'Valor 1 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_value_2_title'  => array('label' => 'Valor 2 - título', 'type' => 'text'),
                'mktpd_qsomos_value_2_text'   => array('label' => 'Valor 2 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_value_3_title'  => array('label' => 'Valor 3 - título', 'type' => 'text'),
                'mktpd_qsomos_value_3_text'   => array('label' => 'Valor 3 - texto', 'type' => 'textarea', 'rows' => 3),
            ),
        ),
        'why' => array(
            'title'       => 'Por que a MKT Presença Digital?',
            'description' => 'Bloco com três motivos para reforçar confiança e conversão.',
            'fields'      => array(
                'mktpd_qsomos_why_eyebrow' => array('label' => 'Por que - chamada superior', 'type' => 'text'),
                'mktpd_qsomos_why_title'   => array('label' => 'Por que - título', 'type' => 'text'),
                'mktpd_qsomos_why_1_title' => array('label' => 'Motivo 1 - título', 'type' => 'text'),
                'mktpd_qsomos_why_1_text'  => array('label' => 'Motivo 1 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_why_2_title' => array('label' => 'Motivo 2 - título', 'type' => 'text'),
                'mktpd_qsomos_why_2_text'  => array('label' => 'Motivo 2 - texto', 'type' => 'textarea', 'rows' => 3),
                'mktpd_qsomos_why_3_title' => array('label' => 'Motivo 3 - título', 'type' => 'text'),
                'mktpd_qsomos_why_3_text'  => array('label' => 'Motivo 3 - texto', 'type' => 'textarea', 'rows' => 3),
            ),
        ),
        'cta' => array(
            'title'       => 'CTA Final',
            'description' => 'Chamada comercial exibida antes do rodapé.',
            'fields'      => array(
                'mktpd_qsomos_cta_enabled'      => array('label' => 'Exibir CTA final', 'type' => 'checkbox'),
                'mktpd_qsomos_cta_eyebrow'      => array('label' => 'CTA - chamada superior', 'type' => 'text'),
                'mktpd_qsomos_cta_title'        => array('label' => 'CTA - título', 'type' => 'text'),
                'mktpd_qsomos_cta_text'         => array('label' => 'CTA - texto', 'type' => 'textarea', 'rows' => 4),
                'mktpd_qsomos_cta_button_label' => array('label' => 'CTA - texto do botão', 'type' => 'text'),
                'mktpd_qsomos_cta_button_url'   => array('label' => 'CTA - URL do botão', 'type' => 'url'),
            ),
        ),
    );
}


function mktpd_qsomos_admin_enqueue_media($hook) {
    if (!in_array($hook, array('post.php', 'post-new.php'), true)) {
        return;
    }

    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'qsomos') {
        return;
    }

    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'mktpd_qsomos_admin_enqueue_media');

function mktpd_add_qsomos_metaboxes() {
    add_meta_box(
        'mktpd_qsomos_content',
        'Conteúdo da página Quem Somos',
        'mktpd_render_qsomos_content_metabox',
        'qsomos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mktpd_add_qsomos_metaboxes');

function mktpd_render_qsomos_content_metabox($post) {
    wp_nonce_field('mktpd_save_qsomos_content', 'mktpd_qsomos_content_nonce');

    echo '<p>Preencha os blocos abaixo na mesma ordem em que eles aparecem na página. A imagem principal deve ser definida na caixa <strong>Imagem da seção Quem Somos</strong>, na lateral direita.</p>';

    foreach (mktpd_qsomos_field_groups() as $group) {
        echo '<hr>';
        echo '<h2>' . esc_html($group['title']) . '</h2>';

        if (!empty($group['description'])) {
            echo '<p class="description">' . esc_html($group['description']) . '</p>';
        }

        foreach ($group['fields'] as $field_id => $field) {
            $value = get_post_meta($post->ID, $field_id, true);

            echo '<p>';
            echo '<label for="' . esc_attr($field_id) . '"><strong>' . esc_html($field['label']) . '</strong></label><br>';

            if ($field['type'] === 'textarea') {
                $rows = !empty($field['rows']) ? absint($field['rows']) : 4;

                echo '<textarea class="large-text" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" rows="' . esc_attr($rows) . '">' . esc_textarea($value) . '</textarea>';
            } elseif ($field['type'] === 'checkbox') {
                echo '<label>';
                echo '<input type="checkbox" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="1" ' . checked($value, '1', false) . '> ';
                echo 'Ativo';
                echo '</label>';
            } elseif ($field['type'] === 'image') {
                $image_id  = absint($value);
                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
                $preview_style = $image_url ? '' : 'display:none;';

                if (!empty($field['description'])) {
                    echo '<span class="description">' . esc_html($field['description']) . '</span><br>';
                }

                echo '<input type="hidden" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($image_id) . '">';
                echo '<div class="mktpd-media-preview" data-preview-for="' . esc_attr($field_id) . '" style="margin:10px 0;' . esc_attr($preview_style) . '">';
                echo '<img src="' . esc_url($image_url) . '" alt="" style="max-width:280px;height:auto;border-radius:6px;border:1px solid #ccd0d4;">';
                echo '</div>';
                echo '<button type="button" class="button mktpd-media-select" data-target="' . esc_attr($field_id) . '">Selecionar imagem</button> ';
                echo '<button type="button" class="button mktpd-media-remove" data-target="' . esc_attr($field_id) . '">Remover imagem</button>';
            } else {
                $input_type = $field['type'] === 'url' ? 'url' : 'text';

                echo '<input class="large-text" type="' . esc_attr($input_type) . '" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($value) . '">';
            }

            echo '</p>';
        }
    }
}


function mktpd_qsomos_media_selector_script() {
    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'qsomos') {
        return;
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let frame;

            document.querySelectorAll('.mktpd-media-select').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    const targetId = button.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const preview = document.querySelector('[data-preview-for="' + targetId + '"]');
                    const previewImage = preview ? preview.querySelector('img') : null;

                    frame = wp.media({
                        title: 'Selecionar imagem',
                        button: {
                            text: 'Usar esta imagem'
                        },
                        multiple: false
                    });

                    frame.on('select', function () {
                        const attachment = frame.state().get('selection').first().toJSON();
                        const imageUrl = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;

                        input.value = attachment.id;

                        if (preview && previewImage) {
                            previewImage.src = imageUrl;
                            preview.style.display = 'block';
                        }
                    });

                    frame.open();
                });
            });

            document.querySelectorAll('.mktpd-media-remove').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    const targetId = button.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const preview = document.querySelector('[data-preview-for="' + targetId + '"]');
                    const previewImage = preview ? preview.querySelector('img') : null;

                    input.value = '';

                    if (preview && previewImage) {
                        previewImage.src = '';
                        preview.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <?php
}
add_action('admin_footer-post.php', 'mktpd_qsomos_media_selector_script');
add_action('admin_footer-post-new.php', 'mktpd_qsomos_media_selector_script');

function mktpd_save_qsomos_content($post_id) {
    if (!isset($_POST['mktpd_qsomos_content_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mktpd_qsomos_content_nonce'])), 'mktpd_save_qsomos_content')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $post = get_post($post_id);

    if ($post && $post->post_type === 'qsomos' && trim($post->post_title) === '') {
        remove_action('save_post_qsomos', 'mktpd_save_qsomos_content');

        wp_update_post(array(
            'ID'         => $post_id,
            'post_title' => 'Conteúdo Quem Somos',
            'post_name'  => 'conteudo-quem-somos',
        ));

        add_action('save_post_qsomos', 'mktpd_save_qsomos_content');
    }

    $checkbox_fields = array();
    $url_fields      = array();
    $image_fields    = array();
    $textarea_fields = array();
    $text_fields     = array();

    foreach (mktpd_qsomos_field_groups() as $group) {
        foreach ($group['fields'] as $field_id => $field) {
            if ($field['type'] === 'checkbox') {
                $checkbox_fields[] = $field_id;
            } elseif ($field['type'] === 'url') {
                $url_fields[] = $field_id;
            } elseif ($field['type'] === 'image') {
                $image_fields[] = $field_id;
            } elseif ($field['type'] === 'textarea') {
                $textarea_fields[] = $field_id;
            } else {
                $text_fields[] = $field_id;
            }
        }
    }

    foreach ($text_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_text_field(wp_unslash($_POST[$field_id])));
        }
    }

    foreach ($textarea_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_textarea_field(wp_unslash($_POST[$field_id])));
        }
    }

    foreach ($url_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, esc_url_raw(wp_unslash($_POST[$field_id])));
        }
    }

    foreach ($image_fields as $field_id) {
        $value = isset($_POST[$field_id]) ? absint(wp_unslash($_POST[$field_id])) : 0;

        if ($value > 0) {
            update_post_meta($post_id, $field_id, $value);
        } else {
            delete_post_meta($post_id, $field_id);
        }
    }

    foreach ($checkbox_fields as $field_id) {
        $value = isset($_POST[$field_id]) ? '1' : '0';
        update_post_meta($post_id, $field_id, $value);
    }
}
add_action('save_post_qsomos', 'mktpd_save_qsomos_content');
