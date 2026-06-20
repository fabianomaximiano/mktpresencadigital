<?php
/**
 * Template Name: Quem Somos oficial
 * Description: Página interna Quem Somos da MKT Presença Digital.
 *
 * @package MKT_Presenca_Digital
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_qsomos_get_first_post() {
    $query = new WP_Query(array(
        'post_type'      => 'qsomos',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => array(
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ),
        'no_found_rows'  => true,
    ));

    if ($query->have_posts()) {
        $post = $query->posts[0];
        wp_reset_postdata();
        return $post;
    }

    wp_reset_postdata();
    return null;
}

function mktpd_qsomos_meta($post_id, $key, $fallback = '') {
    if (!$post_id) {
        return $fallback;
    }

    $value = get_post_meta($post_id, $key, true);

    if ($value === '' || $value === null) {
        return $fallback;
    }

    return $value;
}

$qsomos_post = mktpd_qsomos_get_first_post();
$qsomos_id   = $qsomos_post ? $qsomos_post->ID : 0;

$hero_eyebrow = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_hero_eyebrow', 'MKT Presença Digital');
$hero_title   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_hero_title', $qsomos_post ? get_the_title($qsomos_post) : 'Quem Somos');
$hero_text    = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_hero_description', 'Construímos presença digital para pequenos negócios que precisam aparecer melhor, transmitir confiança e transformar visitas em oportunidades reais.');
$hero_image_id  = absint(mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_hero_image_id', 0));
$hero_image     = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'full') : '';

if (!$hero_image) {
    $hero_image = get_theme_mod('mktpd_home_hero_image', '');
}

$about_eyebrow = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_about_eyebrow', 'Nossa essência');
$about_title   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_about_title', 'Estratégia, foco e resultados para sua empresa crescer no digital.');
$about_text_1  = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_about_text_1', 'A MKT Presença Digital nasceu para ajudar pequenos negócios a organizarem sua comunicação online com clareza, tecnologia e visão comercial.');
$about_text_2  = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_about_text_2', 'Mais do que criar sites, desenvolvemos estruturas digitais pensadas para fortalecer autoridade, melhorar a presença no Google e facilitar o contato entre empresas e clientes.');

$about_image = $qsomos_id ? get_the_post_thumbnail_url($qsomos_id, 'large') : '';
if (!$about_image) {
    $about_image = get_theme_mod('mktpd_home_about_image', '');
}

$features = array(
    array(
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_1_label', 'Sites profissionais'),
        'url'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_1_url', home_url('/servicos/#sites-profissionais')),
    ),
    array(
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_2_label', 'SEO Local'),
        'url'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_2_url', home_url('/servicos/#seo-local')),
    ),
    array(
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_3_label', 'Google Meu Negócio'),
        'url'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_3_url', home_url('/servicos/#google-meu-negocio')),
    ),
    array(
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_4_label', 'Performance Web'),
        'url'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_feature_4_url', home_url('/servicos/#performance-web')),
    ),
);

$method_eyebrow = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_eyebrow', 'Como trabalhamos');
$method_title   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_title', 'Um processo simples, claro e orientado para resultado.');
$method_text    = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_description', 'Cada projeto começa entendendo o cenário atual da empresa para definir prioridades, evitar desperdício e construir uma presença digital mais eficiente.');

$methods = array(
    array(
        'number' => '01',
        'title'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_1_title', 'Diagnóstico'),
        'text'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_1_text', 'Analisamos site, presença no Google, comunicação, performance e pontos de melhoria.'),
    ),
    array(
        'number' => '02',
        'title'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_2_title', 'Estratégia'),
        'text'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_2_text', 'Definimos o caminho ideal para melhorar visibilidade, autoridade e conversão.'),
    ),
    array(
        'number' => '03',
        'title'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_3_title', 'Implementação'),
        'text'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_3_text', 'Aplicamos melhorias técnicas, visuais e estruturais com foco em presença digital.'),
    ),
    array(
        'number' => '04',
        'title'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_4_title', 'Evolução'),
        'text'   => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_method_4_text', 'Acompanhamos oportunidades, ajustes e próximos passos para manter o crescimento.'),
    ),
);

$stats = array(
    array(
        'value' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_1_value', '+50'),
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_1_label', 'Projetos analisados'),
    ),
    array(
        'value' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_2_value', '+15'),
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_2_label', 'Segmentos atendidos'),
    ),
    array(
        'value' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_3_value', '3'),
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_3_label', 'Cidades prioritárias'),
    ),
    array(
        'value' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_4_value', '100%'),
        'label' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_stat_4_label', 'Foco em presença digital'),
    ),
);

$values_eyebrow = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_values_eyebrow', 'Nosso posicionamento');
$values_title   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_values_title', 'Presença digital não é só estar online. É ser encontrado, entendido e lembrado.');
$values_text    = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_values_text', 'Trabalhamos para que cada projeto tenha uma comunicação clara, estrutura técnica organizada e caminhos simples para transformar visitantes em contatos.');

$values = array(
    array(
        'title' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_value_1_title', 'Clareza'),
        'text'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_value_1_text', 'Conteúdo direto, objetivo e fácil de entender.'),
    ),
    array(
        'title' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_value_2_title', 'Performance'),
        'text'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_value_2_text', 'Sites mais leves, rápidos e preparados para SEO.'),
    ),
    array(
        'title' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_value_3_title', 'Autoridade'),
        'text'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_value_3_text', 'Estrutura para fortalecer confiança e presença local.'),
    ),
);

$why_eyebrow = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_eyebrow', 'Por que escolher a MKT Presença Digital?');
$why_title   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_title', 'Três motivos para sua empresa dar o próximo passo no digital.');

$why_cards = array(
    array(
        'title' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_1_title', 'Atendimento próximo'),
        'text'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_1_text', 'Falamos a linguagem do pequeno negócio.'),
    ),
    array(
        'title' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_2_title', 'Soluções sob medida'),
        'text'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_2_text', 'Nada de pacotes engessados.'),
    ),
    array(
        'title' => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_3_title', 'Foco em resultado'),
        'text'  => mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_why_3_text', 'Sites que ajudam a vender e fortalecer a presença digital.'),
    ),
);

$cta_enabled = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_cta_enabled', '1');
$cta_eyebrow = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_cta_eyebrow', 'Próximo passo');
$cta_title   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_cta_title', 'Sua empresa está sendo encontrada no Google?');
$cta_text    = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_cta_text', 'Vamos analisar sua presença digital e identificar oportunidades para melhorar sua visibilidade, comunicação e geração de contatos.');
$cta_label   = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_cta_button_label', 'Solicitar diagnóstico');
$cta_url     = mktpd_qsomos_meta($qsomos_id, 'mktpd_qsomos_cta_button_url', home_url('/orcamento/'));

get_header();
?>

<main class="qs-page" id="conteudo-principal">
    <section class="qs-hero">
        <?php if (!empty($hero_image)) : ?>
            <img class="qs-hero-bg" src="<?php echo esc_url($hero_image); ?>" alt="" aria-hidden="true">
        <?php endif; ?>

        <div class="qs-hero-shape qs-hero-shape-one" aria-hidden="true"></div>
        <div class="qs-hero-shape qs-hero-shape-two" aria-hidden="true"></div>

        <div class="qs-container">
            <div class="qs-hero-content">
                <?php if (!empty($hero_eyebrow)) : ?>
                    <span class="qs-eyebrow"><?php echo esc_html($hero_eyebrow); ?></span>
                <?php endif; ?>

                <div class="qs-breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <span>Quem Somos</span>
                </div>

                <h1><?php echo esc_html($hero_title); ?></h1>

                <?php if (!empty($hero_text)) : ?>
                    <p><?php echo esc_html($hero_text); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="qs-section qs-about">
        <div class="qs-container">
            <div class="qs-about-card">
                <div class="qs-about-media">
                    <div class="qs-about-image">
                        <?php if (!empty($about_image)) : ?>
                            <img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr($about_title); ?>">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="qs-about-content">
                    <?php if (!empty($about_eyebrow)) : ?>
                        <span class="qs-eyebrow"><?php echo esc_html($about_eyebrow); ?></span>
                    <?php endif; ?>

                    <h2><?php echo esc_html($about_title); ?></h2>

                    <?php if (!empty($about_text_1)) : ?>
                        <p><?php echo esc_html($about_text_1); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($about_text_2)) : ?>
                        <p><?php echo esc_html($about_text_2); ?></p>
                    <?php endif; ?>

                    <div class="qs-feature-list">
                        <?php foreach ($features as $feature) : ?>
                            <?php if (!empty($feature['label'])) : ?>
                                <a href="<?php echo esc_url($feature['url']); ?>"><?php echo esc_html($feature['label']); ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="qs-section qs-method">
        <div class="qs-container">
            <div class="qs-section-heading">
                <?php if (!empty($method_eyebrow)) : ?>
                    <span class="qs-eyebrow"><?php echo esc_html($method_eyebrow); ?></span>
                <?php endif; ?>

                <h2><?php echo esc_html($method_title); ?></h2>

                <?php if (!empty($method_text)) : ?>
                    <p><?php echo esc_html($method_text); ?></p>
                <?php endif; ?>
            </div>

            <div class="qs-method-grid">
                <?php foreach ($methods as $method) : ?>
                    <article class="qs-method-card">
                        <span><?php echo esc_html($method['number']); ?></span>
                        <h3><?php echo esc_html($method['title']); ?></h3>
                        <p><?php echo esc_html($method['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="qs-stats">
        <div class="qs-container">
            <div class="qs-stats-grid">
                <?php foreach ($stats as $stat) : ?>
                    <div class="qs-stat">
                        <strong><?php echo esc_html($stat['value']); ?></strong>
                        <span><?php echo esc_html($stat['label']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="qs-section qs-values">
        <div class="qs-container">
            <div class="qs-values-grid">
                <div class="qs-values-content">
                    <?php if (!empty($values_eyebrow)) : ?>
                        <span class="qs-eyebrow"><?php echo esc_html($values_eyebrow); ?></span>
                    <?php endif; ?>

                    <h2><?php echo esc_html($values_title); ?></h2>

                    <?php if (!empty($values_text)) : ?>
                        <p><?php echo esc_html($values_text); ?></p>
                    <?php endif; ?>
                </div>

                <div class="qs-values-list">
                    <?php foreach ($values as $value_item) : ?>
                        <div class="qs-value-item">
                            <strong><?php echo esc_html($value_item['title']); ?></strong>
                            <span><?php echo esc_html($value_item['text']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="qs-section qs-why">
        <div class="qs-container">
            <div class="qs-section-heading">
                <?php if (!empty($why_eyebrow)) : ?>
                    <span class="qs-eyebrow"><?php echo esc_html($why_eyebrow); ?></span>
                <?php endif; ?>

                <h2><?php echo esc_html($why_title); ?></h2>
            </div>

            <div class="qs-why-grid">
                <?php foreach ($why_cards as $why_card) : ?>
                    <article class="qs-why-card">
                        <span class="qs-why-icon" aria-hidden="true">✓</span>
                        <h3><?php echo esc_html($why_card['title']); ?></h3>
                        <p><?php echo esc_html($why_card['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ($cta_enabled === '1') : ?>
        <section class="qs-cta">
            <div class="qs-container">
                <div class="qs-cta-card">
                    <?php if (!empty($cta_eyebrow)) : ?>
                        <span class="qs-eyebrow"><?php echo esc_html($cta_eyebrow); ?></span>
                    <?php endif; ?>

                    <h2><?php echo esc_html($cta_title); ?></h2>

                    <?php if (!empty($cta_text)) : ?>
                        <p><?php echo esc_html($cta_text); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($cta_label) && !empty($cta_url)) : ?>
                        <a href="<?php echo esc_url($cta_url); ?>" class="qs-btn">
                            <?php echo esc_html($cta_label); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
