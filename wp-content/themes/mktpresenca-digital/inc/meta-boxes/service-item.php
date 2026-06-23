<?php
/**
 * Meta boxes do CPT Serviços.
 *
 * @package MKT_Presenca_Digital
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('mktpd_service_item_get_meta')) {
    function mktpd_service_item_get_meta($post_id, $key, $default = '') {
        $value = get_post_meta($post_id, $key, true);

        return $value !== '' ? $value : $default;
    }
}

function mktpd_service_item_add_meta_boxes() {
    add_meta_box(
        'mktpd_service_item_content',
        'Conteúdo do Serviço',
        'mktpd_service_item_render_meta_box',
        'servicos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mktpd_service_item_add_meta_boxes');

function mktpd_service_item_render_text_field($post_id, $key, $label, $default = '', $description = '') {
    $value = mktpd_service_item_get_meta($post_id, $key, $default);
    ?>
    <p>
        <label for="<?php echo esc_attr($key); ?>"><strong><?php echo esc_html($label); ?></strong></label><br>
        <?php if ($description) : ?>
            <small><?php echo esc_html($description); ?></small><br>
        <?php endif; ?>
        <input type="text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>" class="widefat">
    </p>
    <?php
}

function mktpd_service_item_render_url_field($post_id, $key, $label, $default = '', $description = '') {
    $value = mktpd_service_item_get_meta($post_id, $key, $default);
    ?>
    <p>
        <label for="<?php echo esc_attr($key); ?>"><strong><?php echo esc_html($label); ?></strong></label><br>
        <?php if ($description) : ?>
            <small><?php echo esc_html($description); ?></small><br>
        <?php endif; ?>
        <input type="url" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>" class="widefat">
    </p>
    <?php
}

function mktpd_service_item_render_textarea_field($post_id, $key, $label, $default = '', $rows = 4, $description = '') {
    $value = mktpd_service_item_get_meta($post_id, $key, $default);
    ?>
    <p>
        <label for="<?php echo esc_attr($key); ?>"><strong><?php echo esc_html($label); ?></strong></label><br>
        <?php if ($description) : ?>
            <small><?php echo esc_html($description); ?></small><br>
        <?php endif; ?>
        <textarea id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" rows="<?php echo esc_attr($rows); ?>" class="widefat"><?php echo esc_textarea($value); ?></textarea>
    </p>
    <?php
}

function mktpd_service_item_render_image_field($post_id, $key, $label, $description = '') {
    $image_id  = absint(mktpd_service_item_get_meta($post_id, $key, 0));
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
    ?>
    <div class="mktpd-service-image-field" style="margin: 0 0 22px;">
        <label><strong><?php echo esc_html($label); ?></strong></label><br>

        <?php if ($key === 'mktpd_service_hero_image_id') : ?>
            <div style="background:#f7f8fa;border-left:4px solid #f5a623;padding:14px 18px;margin:12px 0 16px;border-radius:6px;">
                <strong>Imagem de fundo da Hero</strong><br>
                Utilize uma imagem horizontal com boa área livre para o texto.

                <ul style="margin:10px 0 0 18px;list-style:disc;">
                    <li><strong>Dimensão recomendada:</strong> 1920 x 900 px</li>
                    <li><strong>Formato:</strong> WebP</li>
                    <li><strong>Peso ideal:</strong> até 250 KB</li>
                    <li><strong>Dica:</strong> evite imagens muito poluídas, pois a hero usa overlay escuro e texto sobreposto.</li>
                </ul>
            </div>
        <?php elseif ($description) : ?>
            <small><?php echo esc_html($description); ?></small><br>
        <?php endif; ?>

        <input type="hidden" class="mktpd-service-image-id" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($image_id); ?>">

        <div class="mktpd-service-image-preview" style="margin: 10px 0;">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width: 240px; height: auto; border-radius: 8px;">
            <?php endif; ?>
        </div>

        <button type="button" class="button mktpd-service-select-image">Selecionar imagem</button>
        <button type="button" class="button mktpd-service-remove-image">Remover imagem</button>
    </div>
    <?php
}

function mktpd_service_item_render_meta_box($post) {
    wp_nonce_field('mktpd_service_item_save', 'mktpd_service_item_nonce');
    ?>

    <p>
        Preencha os campos abaixo para montar a página interna do serviço. O título do post será usado como nome principal e a imagem destacada pode ser usada nos cards da Home e da página Serviços.
    </p>

    <hr>

    <h2>Card do Serviço</h2>

    <?php
    mktpd_service_item_render_textarea_field(
        $post->ID,
        'mktpd_service_card_summary',
        'Resumo curto para cards',
        'Sites profissionais, rápidos e preparados para transformar visitantes em contatos e oportunidades.',
        3,
        'Usado nos cards da Home e da página Serviços.'
    );

    mktpd_service_item_render_text_field(
        $post->ID,
        'mktpd_service_card_badge',
        'Destaque visual do card',
        'Web',
        'Exemplos: 99, SP, Web, Check, SEO.'
    );

    mktpd_service_item_render_text_field(
        $post->ID,
        'mktpd_service_card_label',
        'Categoria pequena do card',
        'Criação de Sites'
    );

    mktpd_service_item_render_text_field(
        $post->ID,
        'mktpd_service_card_button',
        'Texto do botão',
        'Saiba mais'
    );
    ?>

    <p>
        <label>
            <input type="checkbox" name="mktpd_service_show_home" value="1" <?php checked(mktpd_service_item_get_meta($post->ID, 'mktpd_service_show_home', '1'), '1'); ?>>
            Exibir na Home
        </label>
    </p>

    <p>
        <label>
            <input type="checkbox" name="mktpd_service_show_services_page" value="1" <?php checked(mktpd_service_item_get_meta($post->ID, 'mktpd_service_show_services_page', '1'), '1'); ?>>
            Exibir na página Serviços
        </label>
    </p>

    <hr>

    <h2>Hero da Página Interna</h2>

    <?php
    mktpd_service_item_render_text_field(
        $post->ID,
        'mktpd_service_hero_eyebrow',
        'Chamada superior',
        'Serviços'
    );

    mktpd_service_item_render_textarea_field(
        $post->ID,
        'mktpd_service_hero_title',
        'Título da Hero',
        'Criação de Sites para empresas que precisam vender melhor.',
        3
    );

    mktpd_service_item_render_textarea_field(
        $post->ID,
        'mktpd_service_hero_text',
        'Descrição da Hero',
        'Desenvolvemos sites profissionais, rápidos e preparados para transformar visitantes em contatos, orçamentos e oportunidades reais de negócio.',
        4
    );

    mktpd_service_item_render_image_field(
        $post->ID,
        'mktpd_service_hero_image_id',
        'Imagem de fundo da Hero',
        'Imagem usada como background da hero da página interna do serviço.'
    );
    ?>

    <hr>

    <h2>Introdução / Sobre o Serviço</h2>

    <?php
    mktpd_service_item_render_text_field(
        $post->ID,
        'mktpd_service_intro_eyebrow',
        'Chamada superior',
        'Mais que uma página bonita'
    );

    mktpd_service_item_render_textarea_field(
        $post->ID,
        'mktpd_service_intro_title',
        'Título',
        'Seu site precisa apresentar, convencer e facilitar o atendimento.',
        3
    );

    mktpd_service_item_render_textarea_field(
        $post->ID,
        'mktpd_service_intro_text_1',
        'Texto 1',
        'Um site profissional não deve ser apenas um cartão de visitas online. Ele precisa carregar rápido, funcionar bem no celular, transmitir confiança e conduzir o visitante para uma ação.',
        5
    );

    mktpd_service_item_render_textarea_field(
        $post->ID,
        'mktpd_service_intro_text_2',
        'Texto 2',
        'Por isso, criamos estruturas digitais pensadas para pequenos negócios que precisam aparecer melhor, explicar seus serviços e transformar acessos em oportunidades.',
        5
    );
    ?>

    <hr>

    <h2>O que está incluso</h2>

    <?php
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_included_eyebrow', 'Chamada superior', 'O que está incluso');
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_included_title', 'Título da seção', 'Da estrutura ao lançamento, cuidamos dos pontos essenciais.', 3);

    for ($i = 1; $i <= 6; $i++) :
        mktpd_service_item_render_text_field($post->ID, "mktpd_service_included_{$i}_title", "Item {$i} - título");
        mktpd_service_item_render_textarea_field($post->ID, "mktpd_service_included_{$i}_text", "Item {$i} - texto", '', 3);
    endfor;
    ?>

    <hr>

    <h2>Diferencial técnico</h2>

    <?php
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_performance_eyebrow', 'Chamada superior', 'Diferencial técnico');
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_performance_title', 'Título', 'Site rápido, leve e preparado para crescer.', 3);
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_performance_text', 'Texto', 'Performance, estrutura limpa e conteúdo bem organizado ajudam sua empresa a transmitir mais confiança e melhorar sua presença digital.', 4);

    for ($i = 1; $i <= 4; $i++) :
        mktpd_service_item_render_text_field($post->ID, "mktpd_service_metric_{$i}_number", "Indicador {$i} - número/sigla");
        mktpd_service_item_render_text_field($post->ID, "mktpd_service_metric_{$i}_label", "Indicador {$i} - legenda");
    endfor;
    ?>

    <hr>

    <h2>Metodologia</h2>

    <?php
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_process_eyebrow', 'Chamada superior', 'Metodologia');
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_process_title', 'Título da seção', 'Como funciona o desenvolvimento do site.', 3);

    for ($i = 1; $i <= 4; $i++) :
        mktpd_service_item_render_text_field($post->ID, "mktpd_service_process_{$i}_title", "Etapa {$i} - título");
        mktpd_service_item_render_textarea_field($post->ID, "mktpd_service_process_{$i}_text", "Etapa {$i} - texto", '', 3);
    endfor;
    ?>

    <hr>

    <h2>Benefícios</h2>

    <?php
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_benefits_eyebrow', 'Chamada superior', 'Benefícios');
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_benefits_title', 'Título da seção', 'O site passa a trabalhar como parte da sua estratégia comercial.', 3);

    for ($i = 1; $i <= 4; $i++) :
        mktpd_service_item_render_text_field($post->ID, "mktpd_service_benefit_{$i}", "Benefício {$i}");
    endfor;
    ?>

    <hr>

    <h2>FAQ do Serviço</h2>

    <?php
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_faq_eyebrow', 'Chamada superior', 'Dúvidas frequentes');
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_faq_title', 'Título da seção', 'Perguntas comuns sobre criação de sites.', 3);

    for ($i = 1; $i <= 5; $i++) :
        mktpd_service_item_render_text_field($post->ID, "mktpd_service_faq_{$i}_question", "Pergunta {$i}");
        mktpd_service_item_render_textarea_field($post->ID, "mktpd_service_faq_{$i}_answer", "Resposta {$i}", '', 3);
    endfor;
    ?>

    <hr>

    <h2>CTA Final</h2>

    <?php
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_cta_eyebrow', 'Chamada superior', 'MKT Presença Digital');
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_cta_title', 'Título', 'Vamos criar um site que ajude sua empresa a vender melhor?', 3);
    mktpd_service_item_render_textarea_field($post->ID, 'mktpd_service_cta_text', 'Texto', 'Conte sua necessidade e vamos entender qual estrutura faz mais sentido para o seu negócio.', 4);
    mktpd_service_item_render_text_field($post->ID, 'mktpd_service_cta_button', 'Texto do botão', 'Solicitar orçamento');
    mktpd_service_item_render_url_field($post->ID, 'mktpd_service_cta_url', 'URL do botão', home_url('/orcamento/'));
    ?>

    <script>
        jQuery(document).ready(function ($) {
            $('.mktpd-service-select-image').on('click', function (event) {
                event.preventDefault();

                const field = $(this).closest('.mktpd-service-image-field');
                const input = field.find('.mktpd-service-image-id');
                const preview = field.find('.mktpd-service-image-preview');

                const frame = wp.media({
                    title: 'Selecionar imagem',
                    button: { text: 'Usar esta imagem' },
                    multiple: false
                });

                frame.on('select', function () {
                    const attachment = frame.state().get('selection').first().toJSON();
                    input.val(attachment.id);
                    preview.html('<img src="' + attachment.url + '" style="max-width: 240px; height: auto; border-radius: 8px;">');
                });

                frame.open();
            });

            $('.mktpd-service-remove-image').on('click', function (event) {
                event.preventDefault();

                const field = $(this).closest('.mktpd-service-image-field');
                field.find('.mktpd-service-image-id').val('');
                field.find('.mktpd-service-image-preview').html('');
            });
        });
    </script>

    <?php
}

function mktpd_service_item_save_meta_box($post_id) {
    if (!isset($_POST['mktpd_service_item_nonce'])) {
        return;
    }

    if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mktpd_service_item_nonce'])), 'mktpd_service_item_save')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $textarea_fields = array(
        'mktpd_service_card_summary',
        'mktpd_service_hero_title',
        'mktpd_service_hero_text',
        'mktpd_service_intro_title',
        'mktpd_service_intro_text_1',
        'mktpd_service_intro_text_2',
        'mktpd_service_included_title',
        'mktpd_service_performance_title',
        'mktpd_service_performance_text',
        'mktpd_service_process_title',
        'mktpd_service_benefits_title',
        'mktpd_service_faq_title',
        'mktpd_service_cta_title',
        'mktpd_service_cta_text',
    );

    for ($i = 1; $i <= 6; $i++) {
        $textarea_fields[] = "mktpd_service_included_{$i}_text";
    }

    for ($i = 1; $i <= 4; $i++) {
        $textarea_fields[] = "mktpd_service_process_{$i}_text";
    }

    for ($i = 1; $i <= 5; $i++) {
        $textarea_fields[] = "mktpd_service_faq_{$i}_answer";
    }

    $image_fields = array(
        'mktpd_service_hero_image_id',
    );

    $url_fields = array(
        'mktpd_service_cta_url',
    );

    $checkbox_fields = array(
        'mktpd_service_show_home',
        'mktpd_service_show_services_page',
    );

    $text_fields = array(
        'mktpd_service_card_badge',
        'mktpd_service_card_label',
        'mktpd_service_card_button',
        'mktpd_service_hero_eyebrow',
        'mktpd_service_intro_eyebrow',
        'mktpd_service_included_eyebrow',
        'mktpd_service_performance_eyebrow',
        'mktpd_service_process_eyebrow',
        'mktpd_service_benefits_eyebrow',
        'mktpd_service_faq_eyebrow',
        'mktpd_service_cta_eyebrow',
        'mktpd_service_cta_button',
    );

    for ($i = 1; $i <= 6; $i++) {
        $text_fields[] = "mktpd_service_included_{$i}_title";
    }

    for ($i = 1; $i <= 4; $i++) {
        $text_fields[] = "mktpd_service_metric_{$i}_number";
        $text_fields[] = "mktpd_service_metric_{$i}_label";
        $text_fields[] = "mktpd_service_process_{$i}_title";
        $text_fields[] = "mktpd_service_benefit_{$i}";
    }

    for ($i = 1; $i <= 5; $i++) {
        $text_fields[] = "mktpd_service_faq_{$i}_question";
    }

    foreach ($textarea_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_textarea_field(wp_unslash($_POST[$field_id])));
        }
    }

    foreach ($text_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_text_field(wp_unslash($_POST[$field_id])));
        }
    }

    foreach ($image_fields as $field_id) {
        $value = isset($_POST[$field_id]) ? absint($_POST[$field_id]) : 0;

        if ($value) {
            update_post_meta($post_id, $field_id, $value);
        } else {
            delete_post_meta($post_id, $field_id);
        }
    }

    foreach ($url_fields as $field_id) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, esc_url_raw(wp_unslash($_POST[$field_id])));
        }
    }

    foreach ($checkbox_fields as $field_id) {
        update_post_meta($post_id, $field_id, isset($_POST[$field_id]) ? '1' : '0');
    }
}
add_action('save_post_servicos', 'mktpd_service_item_save_meta_box');

function mktpd_service_item_admin_assets($hook) {
    if (!in_array($hook, array('post.php', 'post-new.php'), true)) {
        return;
    }

    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'servicos') {
        return;
    }

    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'mktpd_service_item_admin_assets');
