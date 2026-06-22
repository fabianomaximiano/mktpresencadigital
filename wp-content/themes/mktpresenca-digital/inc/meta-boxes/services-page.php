<?php

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_services_get_field($data, $key, $default = '')
{
    return isset($data[$key]) ? $data[$key] : $default;
}

function mktpd_add_services_meta_box()
{
    add_meta_box(
        'mktpd_services_page',
        'Configurações da Página Serviços',
        'mktpd_render_services_meta_box',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'mktpd_add_services_meta_box');

function mktpd_render_services_image_field($data, $key, $label)
{
    $image_id = absint(mktpd_services_get_field($data, $key, 0));
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
    ?>
    <p>
        <label><strong><?php echo esc_html($label); ?></strong></label><br>
        <input type="hidden" class="mktpd-services-image-id" name="mktpd_services[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($image_id); ?>">
        <button type="button" class="button mktpd-services-select-image">Selecionar imagem</button>
        <button type="button" class="button mktpd-services-remove-image">Remover</button>
    </p>

    <div class="mktpd-services-image-preview" style="margin-bottom:20px;">
        <?php if ($image_url) : ?>
            <img src="<?php echo esc_url($image_url); ?>" style="max-width:220px;height:auto;border-radius:8px;">
        <?php endif; ?>
    </div>
    <?php
}

function mktpd_render_services_meta_box($post)
{
    if (get_page_template_slug($post->ID) !== 'servicos.php') {
        echo '<p>Selecione o template "Serviços" para editar estes campos.</p>';
        return;
    }

    wp_nonce_field('mktpd_services_nonce', 'mktpd_services_nonce_field');

    $data = get_post_meta($post->ID, '_mktpd_services_page', true);
    $data = is_array($data) ? $data : array();

    $default_faqs = array(
        array(
            'question' => 'Meu Instagram já vende. Preciso mesmo de um site?',
            'answer'   => 'O Instagram ajuda, mas não substitui um site. Redes sociais mudam regras e alcance. O site é seu espaço próprio, fortalece autoridade e ajuda sua empresa a ser encontrada no Google.',
        ),
        array(
            'question' => 'Facebook morreu?',
            'answer'   => 'Não. O Facebook ainda faz parte do ecossistema digital, principalmente em campanhas, presença local e relacionamento. O ponto é usar cada canal com estratégia.',
        ),
        array(
            'question' => 'A inteligência artificial cria sites em minutos. Por que contratar uma empresa?',
            'answer'   => 'A IA pode ajudar, mas não substitui estratégia, performance, SEO, experiência, segurança e visão comercial. Um site não deve apenas existir; ele precisa gerar confiança e oportunidades.',
        ),
        array(
            'question' => 'Um site sozinho vende?',
            'answer'   => 'Não. O site é uma peça da estratégia. Ele precisa trabalhar junto com SEO, Google Meu Negócio, conteúdo, avaliações e canais de relacionamento.',
        ),
        array(
            'question' => 'Vale mais investir em anúncios?',
            'answer'   => 'Anúncios podem gerar resultado rápido, mas presença digital constrói autoridade no longo prazo. O ideal é combinar estratégia orgânica com ações pagas quando fizer sentido.',
        ),
    );
    ?>

    <p>
        Preencha os blocos abaixo na mesma ordem em que aparecem na página.
        Os campos vazios usam o conteúdo padrão do template.
    </p>

    <hr>

    <h2>Hero</h2>

    <p>
        <label><strong>Eyebrow</strong></label><br>
        <input type="text" name="mktpd_services[hero_eyebrow]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'hero_eyebrow', 'Serviços')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Título</strong></label><br>
        <textarea name="mktpd_services[hero_title]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'hero_title', 'Soluções digitais para fortalecer sua presença e gerar resultados.')); ?></textarea>
    </p>

    <p>
        <label><strong>Texto</strong></label><br>
        <textarea name="mktpd_services[hero_text]" rows="4" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'hero_text', 'Estratégias, sites, SEO, Google Meu Negócio e performance para ajudar pequenas empresas a serem encontradas, lembradas e escolhidas.')); ?></textarea>
    </p>

    <p>
        <label><strong>Texto do botão 1</strong></label><br>
        <input type="text" name="mktpd_services[hero_button_1]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'hero_button_1', 'Conhecer serviços')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Texto do botão 2</strong></label><br>
        <input type="text" name="mktpd_services[hero_button_2]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'hero_button_2', 'Solicitar diagnóstico')); ?>" class="widefat">
    </p>

    <?php mktpd_render_services_image_field($data, 'hero_image_id', 'Imagem de fundo da Hero'); ?>

    <hr>

    <h2>Introdução</h2>

    <p>
        <label><strong>Chamada superior</strong></label><br>
        <input type="text" name="mktpd_services[intro_eyebrow]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'intro_eyebrow', 'Presença digital na prática')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Título da Introdução</strong></label><br>
        <textarea name="mktpd_services[intro_title]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'intro_title', 'Mais do que ter um site. É ser encontrado, lembrado e escolhido.')); ?></textarea>
    </p>

    <p>
        <label><strong>Texto 1</strong></label><br>
        <textarea name="mktpd_services[intro_text_1]" rows="4" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'intro_text_1', 'Presença digital é o conjunto de canais, estratégias e experiências que fazem sua empresa aparecer da maneira certa para as pessoas certas.')); ?></textarea>
    </p>

    <p>
        <label><strong>Texto 2</strong></label><br>
        <textarea name="mktpd_services[intro_text_2]" rows="4" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'intro_text_2', 'Site, Google, avaliações, SEO, redes sociais, velocidade e conteúdo precisam trabalhar juntos para gerar confiança e oportunidades reais.')); ?></textarea>
    </p>

    <h3>Itens da presença digital</h3>

    <?php
    $presence_defaults = array(
        'Site profissional',
        'SEO local',
        'Google Meu Negócio',
        'Performance',
        'Conteúdo',
        'Conversão',
    );

    for ($i = 1; $i <= 6; $i++) :
        $default_item = isset($presence_defaults[$i - 1]) ? $presence_defaults[$i - 1] : '';
        ?>
        <p>
            <label><strong>Item <?php echo esc_html($i); ?></strong></label><br>
            <input type="text" name="mktpd_services[presence_item_<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr(mktpd_services_get_field($data, "presence_item_{$i}", $default_item)); ?>" class="widefat">
        </p>
    <?php endfor; ?>

    <hr>

    <h2>Cards dos Serviços</h2>

    <?php for ($i = 1; $i <= 5; $i++) : ?>
        <h3>Serviço <?php echo esc_html($i); ?></h3>

        <p>
            <label><strong>Destaque visual</strong></label><br>
            <input type="text" name="mktpd_services[service_<?php echo esc_attr($i); ?>_badge]" value="<?php echo esc_attr(mktpd_services_get_field($data, "service_{$i}_badge")); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Categoria pequena</strong></label><br>
            <input type="text" name="mktpd_services[service_<?php echo esc_attr($i); ?>_label]" value="<?php echo esc_attr(mktpd_services_get_field($data, "service_{$i}_label")); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Título</strong></label><br>
            <input type="text" name="mktpd_services[service_<?php echo esc_attr($i); ?>_title]" value="<?php echo esc_attr(mktpd_services_get_field($data, "service_{$i}_title")); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Texto</strong></label><br>
            <textarea name="mktpd_services[service_<?php echo esc_attr($i); ?>_text]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, "service_{$i}_text")); ?></textarea>
        </p>

        <?php mktpd_render_services_image_field($data, "service_{$i}_image_id", 'Imagem do card'); ?>

        <hr>
    <?php endfor; ?>

    <h2>Indicadores</h2>

    <p>
        <label><strong>Chamada superior</strong></label><br>
        <input type="text" name="mktpd_services[metrics_eyebrow]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'metrics_eyebrow', 'O que poucas empresas mostram')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Título</strong></label><br>
        <textarea name="mktpd_services[metrics_title]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'metrics_title', 'Performance também é parte da presença digital.')); ?></textarea>
    </p>

    <?php for ($i = 1; $i <= 4; $i++) : ?>
        <h3>Indicador <?php echo esc_html($i); ?></h3>

        <p>
            <label><strong>Número / Sigla</strong></label><br>
            <input type="text" name="mktpd_services[metric_<?php echo esc_attr($i); ?>_number]" value="<?php echo esc_attr(mktpd_services_get_field($data, "metric_{$i}_number")); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Descrição</strong></label><br>
            <input type="text" name="mktpd_services[metric_<?php echo esc_attr($i); ?>_label]" value="<?php echo esc_attr(mktpd_services_get_field($data, "metric_{$i}_label")); ?>" class="widefat">
        </p>
    <?php endfor; ?>

    <p>
        <label><strong>Frase / citação</strong></label><br>
        <textarea name="mktpd_services[metrics_quote]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'metrics_quote', 'Performance sem conteúdo é invisibilidade. Conteúdo sem performance é desperdício.')); ?></textarea>
    </p>

    <hr>

    <h2>Metodologia</h2>

    <p>
        <label><strong>Chamada superior</strong></label><br>
        <input type="text" name="mktpd_services[process_eyebrow]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'process_eyebrow', 'Metodologia')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Título</strong></label><br>
        <textarea name="mktpd_services[process_title]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'process_title', 'Como transformamos presença digital em resultados.')); ?></textarea>
    </p>

    <?php for ($i = 1; $i <= 3; $i++) : ?>
        <h3>Etapa <?php echo esc_html($i); ?></h3>

        <p>
            <label><strong>Número</strong></label><br>
            <input type="text" name="mktpd_services[process_<?php echo esc_attr($i); ?>_number]" value="<?php echo esc_attr(mktpd_services_get_field($data, "process_{$i}_number")); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Título</strong></label><br>
            <input type="text" name="mktpd_services[process_<?php echo esc_attr($i); ?>_title]" value="<?php echo esc_attr(mktpd_services_get_field($data, "process_{$i}_title")); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Texto</strong></label><br>
            <textarea name="mktpd_services[process_<?php echo esc_attr($i); ?>_text]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, "process_{$i}_text")); ?></textarea>
        </p>
    <?php endfor; ?>

    <hr>

    <h2>FAQ</h2>

    <p>
        <label><strong>Chamada superior</strong></label><br>
        <input type="text" name="mktpd_services[faq_eyebrow]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'faq_eyebrow', 'Dúvidas frequentes')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Título</strong></label><br>
        <textarea name="mktpd_services[faq_title]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'faq_title', 'Perguntas que muitos empresários fazem antes de investir.')); ?></textarea>
    </p>

    <p>Cadastre até 10 perguntas e respostas. Campos vazios não aparecem no front-end.</p>

    <?php for ($i = 1; $i <= 10; $i++) : ?>
        <?php
        $default_question = isset($default_faqs[$i - 1]) ? $default_faqs[$i - 1]['question'] : '';
        $default_answer = isset($default_faqs[$i - 1]) ? $default_faqs[$i - 1]['answer'] : '';
        ?>

        <h3>Pergunta <?php echo esc_html($i); ?></h3>

        <p>
            <label><strong>Pergunta</strong></label><br>
            <input type="text" name="mktpd_services[faq_<?php echo esc_attr($i); ?>_question]" value="<?php echo esc_attr(mktpd_services_get_field($data, "faq_{$i}_question", $default_question)); ?>" class="widefat">
        </p>

        <p>
            <label><strong>Resposta</strong></label><br>
            <textarea name="mktpd_services[faq_<?php echo esc_attr($i); ?>_answer]" rows="4" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, "faq_{$i}_answer", $default_answer)); ?></textarea>
        </p>
    <?php endfor; ?>

    <hr>

    <h2>CTA Final</h2>

    <p>
        <label><strong>Chamada superior</strong></label><br>
        <input type="text" name="mktpd_services[cta_eyebrow]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'cta_eyebrow', 'MKT Presença Digital')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>Título</strong></label><br>
        <textarea name="mktpd_services[cta_title]" rows="3" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'cta_title', 'Vamos analisar a presença digital da sua empresa?')); ?></textarea>
    </p>

    <p>
        <label><strong>Texto</strong></label><br>
        <textarea name="mktpd_services[cta_text]" rows="4" class="widefat"><?php echo esc_textarea(mktpd_services_get_field($data, 'cta_text', 'Entenda onde sua empresa está hoje e quais melhorias podem gerar mais visibilidade, confiança e oportunidades.')); ?></textarea>
    </p>

    <p>
        <label><strong>Texto do botão</strong></label><br>
        <input type="text" name="mktpd_services[cta_button]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'cta_button', 'Solicitar diagnóstico')); ?>" class="widefat">
    </p>

    <p>
        <label><strong>URL do botão</strong></label><br>
        <input type="url" name="mktpd_services[cta_url]" value="<?php echo esc_attr(mktpd_services_get_field($data, 'cta_url', home_url('/orcamento/'))); ?>" class="widefat">
    </p>

    <script>
        jQuery(document).ready(function ($) {
            $('.mktpd-services-select-image').on('click', function (e) {
                e.preventDefault();

                const button = $(this);
                const wrapper = button.closest('p');
                const input = wrapper.find('.mktpd-services-image-id');
                const preview = wrapper.next('.mktpd-services-image-preview');

                const frame = wp.media({
                    title: 'Selecionar imagem',
                    button: { text: 'Usar esta imagem' },
                    multiple: false
                });

                frame.on('select', function () {
                    const attachment = frame.state().get('selection').first().toJSON();
                    input.val(attachment.id);
                    preview.html('<img src="' + attachment.url + '" style="max-width:220px;height:auto;border-radius:8px;">');
                });

                frame.open();
            });

            $('.mktpd-services-remove-image').on('click', function (e) {
                e.preventDefault();

                const wrapper = $(this).closest('p');
                wrapper.find('.mktpd-services-image-id').val('');
                wrapper.next('.mktpd-services-image-preview').html('');
            });
        });
    </script>

    <?php
}

function mktpd_save_services_meta_box($post_id)
{
    if (!isset($_POST['mktpd_services_nonce_field'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['mktpd_services_nonce_field'], 'mktpd_services_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['mktpd_services']) || !is_array($_POST['mktpd_services'])) {
        return;
    }

    $clean = array();

    foreach ($_POST['mktpd_services'] as $key => $value) {
        if (str_ends_with($key, '_image_id')) {
            $clean[$key] = absint($value);
            continue;
        }

        if (str_contains($key, '_url')) {
            $clean[$key] = esc_url_raw($value);
            continue;
        }

        if (
            str_contains($key, '_text') ||
            str_contains($key, '_title') ||
            str_contains($key, '_answer') ||
            str_contains($key, '_quote')
        ) {
            $clean[$key] = sanitize_textarea_field($value);
            continue;
        }

        $clean[$key] = sanitize_text_field($value);
    }

    update_post_meta($post_id, '_mktpd_services_page', $clean);
}
add_action('save_post', 'mktpd_save_services_meta_box');

function mktpd_services_admin_media()
{
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'mktpd_services_admin_media');

function mktpd_hide_services_default_fields()
{
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;

    if (!$post_id) {
        return;
    }

    if (get_page_template_slug($post_id) !== 'servicos.php') {
        return;
    }

    remove_post_type_support('page', 'editor');
}
add_action('admin_head-post.php', 'mktpd_hide_services_default_fields');
