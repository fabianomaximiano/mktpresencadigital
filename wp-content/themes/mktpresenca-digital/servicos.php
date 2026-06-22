<?php
/**
 * Template Name: Serviços
 * Description: Página Serviços MKT Presença Digital.
 *
 * @package MKT_Presenca_Digital
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$post_id = get_the_ID();
$data = get_post_meta($post_id, '_mktpd_services_page', true);
$data = is_array($data) ? $data : array();

function mktpd_service_value($data, $key, $default = '')
{
    return isset($data[$key]) && $data[$key] !== '' ? $data[$key] : $default;
}

$hero_image_id  = absint(mktpd_service_value($data, 'hero_image_id', 0));
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'full') : '';
?>

<main class="services-page">

    <section class="services-hero">

        <?php if ($hero_image_url) : ?>
            <img
                class="services-hero-bg"
                src="<?php echo esc_url($hero_image_url); ?>"
                alt=""
                aria-hidden="true"
            >
        <?php endif; ?>

        <div class="services-container">

            <div class="services-breadcrumb">
                <span class="services-eyebrow">
                    <?php echo esc_html(mktpd_service_value($data, 'hero_eyebrow', 'Serviços')); ?>
                </span>

                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span>/</span>
                <span><?php the_title(); ?></span>
            </div>

            <h1><?php echo esc_html(mktpd_service_value($data, 'hero_title', 'Soluções digitais para fortalecer sua presença e gerar resultados.')); ?></h1>

            <p><?php echo esc_html(mktpd_service_value($data, 'hero_text', 'Estratégias, sites, SEO, Google Meu Negócio e performance para ajudar pequenas empresas a serem encontradas, lembradas e escolhidas.')); ?></p>

            <div class="services-hero-actions">
                <a href="#servicos" class="services-btn services-btn-primary">
                    <?php echo esc_html(mktpd_service_value($data, 'hero_button_1', 'Conhecer serviços')); ?>
                </a>

                <a href="#diagnostico" class="services-btn services-btn-secondary">
                    <?php echo esc_html(mktpd_service_value($data, 'hero_button_2', 'Solicitar diagnóstico')); ?>
                </a>
            </div>
        </div>
    </section>

    <section class="services-section services-intro">
        <div class="services-container services-intro-grid">
            <div>
                <span class="services-eyebrow-dark"><?php echo esc_html(mktpd_service_value($data, 'intro_eyebrow', 'Presença digital na prática')); ?></span>

                <h2><?php echo esc_html(mktpd_service_value($data, 'intro_title', 'Mais do que ter um site. É ser encontrado, lembrado e escolhido.')); ?></h2>

                <p><?php echo esc_html(mktpd_service_value($data, 'intro_text_1', 'Presença digital é o conjunto de canais, estratégias e experiências que fazem sua empresa aparecer da maneira certa para as pessoas certas.')); ?></p>

                <p><?php echo esc_html(mktpd_service_value($data, 'intro_text_2', 'Site, Google, avaliações, SEO, redes sociais, velocidade e conteúdo precisam trabalhar juntos para gerar confiança e oportunidades reais.')); ?></p>
            </div>

            <div class="services-intro-card">
                <?php
                $presence_items = array(
                    'Site profissional',
                    'SEO local',
                    'Google Meu Negócio',
                    'Performance',
                    'Conteúdo',
                    'Conversão',
                );

                foreach ($presence_items as $index => $default_item) :
                    $item = mktpd_service_value($data, 'presence_item_' . ($index + 1), $default_item);

                    if (empty($item)) {
                        continue;
                    }
                    ?>
                    <div class="presence-item"><?php echo esc_html($item); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="servicos" class="services-section services-list">
        <div class="services-container">
            <div class="services-heading">
                <span class="services-eyebrow-dark"><?php echo esc_html(mktpd_service_value($data, 'services_eyebrow', 'Soluções principais')); ?></span>
                <h2><?php echo esc_html(mktpd_service_value($data, 'services_title', 'Serviços pensados para transformar presença digital em crescimento.')); ?></h2>
            </div>

            <div class="services-grid">
                <?php
                $cards = array(
                    array('performance', '99', 'PageSpeed', 'Sites rápidos e preparados para o Google', 'Performance, Core Web Vitals, imagens leves e experiência do usuário para páginas que carregam rápido e transmitem confiança.'),
                    array('local', 'SP', 'SEO Local', 'Seja encontrado na sua região', 'Estratégias para aparecer no bairro, cidade e região onde sua empresa atua, fortalecendo sua presença local.'),
                    array('google', '★★★★★', 'Google Meu Negócio', 'Fortaleça sua presença no Google', 'Organização, otimização e melhoria do perfil para gerar mais confiança, avaliações e oportunidades.'),
                    array('sites', 'Web', 'Sites e Landing Pages', 'Sites profissionais e responsivos', 'Desenvolvimento de sites institucionais e landing pages com estrutura limpa, visual profissional e foco em conversão.'),
                    array('diagnosis', 'Check', 'Diagnóstico Digital', 'Descubra oportunidades de crescimento', 'Análise da presença digital atual da empresa, identificando pontos técnicos, comerciais e estratégicos que podem ser melhorados.'),
                );

                foreach ($cards as $i => $card) :
                    $num = $i + 1;
                    $extra_class = $num === 5 ? ' service-card-wide' : '';
                    $service_image_id = absint(mktpd_service_value($data, "service_{$num}_image_id", 0));
                    $service_image_url = $service_image_id ? wp_get_attachment_image_url($service_image_id, 'large') : '';
                    $service_image_style = '';

                    if ($service_image_url) {
                        $service_image_style = sprintf(
                            "background-image: linear-gradient(135deg, rgba(13,15,20,.76), rgba(13,15,20,.92)), url('%s');",
                            esc_url($service_image_url)
                        );
                    }
                    ?>
                    <article class="service-card<?php echo esc_attr($extra_class); ?>">
                        <div class="service-card-image service-<?php echo esc_attr($card[0]); ?>"<?php echo $service_image_style ? ' style="' . esc_attr($service_image_style) . '"' : ''; ?>>
                            <span><?php echo esc_html(mktpd_service_value($data, "service_{$num}_badge", $card[1])); ?></span>
                            <small><?php echo esc_html(mktpd_service_value($data, "service_{$num}_label", $card[2])); ?></small>
                        </div>
                        <div class="service-card-content">
                            <h3><?php echo esc_html(mktpd_service_value($data, "service_{$num}_title", $card[3])); ?></h3>
                            <p><?php echo esc_html(mktpd_service_value($data, "service_{$num}_text", $card[4])); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="services-metrics">
        <div class="services-container">
            <div class="services-heading services-heading-center">
                <span class="services-eyebrow-gold"><?php echo esc_html(mktpd_service_value($data, 'metrics_eyebrow', 'O que poucas empresas mostram')); ?></span>
                <h2><?php echo esc_html(mktpd_service_value($data, 'metrics_title', 'Performance também é parte da presença digital.')); ?></h2>
            </div>

            <div class="metrics-grid">
                <?php
                $metrics = array(
                    array('96+', 'PageSpeed Mobile'),
                    array('99+', 'Desktop'),
                    array('100%', 'Imagens WebP'),
                    array('CWV', 'Core Web Vitals'),
                );

                foreach ($metrics as $i => $metric) :
                    $num = $i + 1;
                    ?>
                    <div class="metric-card">
                        <strong><?php echo esc_html(mktpd_service_value($data, "metric_{$num}_number", $metric[0])); ?></strong>
                        <span><?php echo esc_html(mktpd_service_value($data, "metric_{$num}_label", $metric[1])); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="metrics-quote">
                <?php echo esc_html(mktpd_service_value($data, 'metrics_quote', 'Performance sem conteúdo é invisibilidade. Conteúdo sem performance é desperdício.')); ?>
            </p>
        </div>
    </section>

    <section class="services-section">
        <div class="services-container">
            <div class="services-heading services-heading-center">
                <span class="services-eyebrow-dark"><?php echo esc_html(mktpd_service_value($data, 'process_eyebrow', 'Metodologia')); ?></span>
                <h2><?php echo esc_html(mktpd_service_value($data, 'process_title', 'Como transformamos presença digital em resultados.')); ?></h2>
            </div>

            <div class="process-grid">
                <?php
                $process = array(
                    array('01', 'Antes', 'Empresa pouco encontrada, site lento, pouca clareza e presença digital fragmentada.', 'muted'),
                    array('02', 'Estratégia', 'SEO, site, Google, conteúdo, performance e comunicação trabalhando juntos.', 'strategy'),
                    array('03', 'Resultado', 'Mais visibilidade, mais confiança e mais oportunidades para o negócio.', 'result'),
                );

                foreach ($process as $i => $step) :
                    $num = $i + 1;
                    ?>
                    <div class="process-card <?php echo esc_attr($step[3]); ?>">
                        <span><?php echo esc_html(mktpd_service_value($data, "process_{$num}_number", $step[0])); ?></span>
                        <h3><?php echo esc_html(mktpd_service_value($data, "process_{$num}_title", $step[1])); ?></h3>
                        <p><?php echo esc_html(mktpd_service_value($data, "process_{$num}_text", $step[2])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="services-section services-faq">
        <div class="services-container">
            <div class="services-heading">
                <span class="services-eyebrow-dark"><?php echo esc_html(mktpd_service_value($data, 'faq_eyebrow', 'Dúvidas frequentes')); ?></span>
                <h2><?php echo esc_html(mktpd_service_value($data, 'faq_title', 'Perguntas que muitos empresários fazem antes de investir.')); ?></h2>
            </div>

            <div class="faq-list">
                <?php
                $faqs = array(
                    array('Meu Instagram já vende. Preciso mesmo de um site?', 'O Instagram ajuda, mas não substitui um site. Redes sociais mudam regras e alcance. O site é seu espaço próprio, fortalece autoridade e ajuda sua empresa a ser encontrada no Google.'),
                    array('Facebook morreu?', 'Não. O Facebook ainda faz parte do ecossistema digital, principalmente em campanhas, presença local e relacionamento. O ponto é usar cada canal com estratégia.'),
                    array('A inteligência artificial cria sites em minutos. Por que contratar uma empresa?', 'A IA pode ajudar, mas não substitui estratégia, performance, SEO, experiência, segurança e visão comercial. Um site não deve apenas existir; ele precisa gerar confiança e oportunidades.'),
                    array('Um site sozinho vende?', 'Não. O site é uma peça da estratégia. Ele precisa trabalhar junto com SEO, Google Meu Negócio, conteúdo, avaliações e canais de relacionamento.'),
                    array('Vale mais investir em anúncios?', 'Anúncios podem gerar resultado rápido, mas presença digital constrói autoridade no longo prazo. O ideal é combinar estratégia orgânica com ações pagas quando fizer sentido.'),
                    array('', ''),
                    array('', ''),
                    array('', ''),
                    array('', ''),
                    array('', ''),
                );

                foreach ($faqs as $i => $faq) :
                    $num = $i + 1;
                    $question = mktpd_service_value($data, "faq_{$num}_question", $faq[0]);
                    $answer = mktpd_service_value($data, "faq_{$num}_answer", $faq[1]);

                    if (empty($question) || empty($answer)) {
                        continue;
                    }
                    ?>
                    <details>
                        <summary><?php echo esc_html($question); ?></summary>
                        <p><?php echo esc_html($answer); ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="diagnostico" class="services-final-cta">
        <div class="services-container">
            <div class="services-cta-card">
                <span><?php echo esc_html(mktpd_service_value($data, 'cta_eyebrow', 'MKT Presença Digital')); ?></span>
                <h2><?php echo esc_html(mktpd_service_value($data, 'cta_title', 'Vamos analisar a presença digital da sua empresa?')); ?></h2>
                <p><?php echo esc_html(mktpd_service_value($data, 'cta_text', 'Entenda onde sua empresa está hoje e quais melhorias podem gerar mais visibilidade, confiança e oportunidades.')); ?></p>
                <a href="<?php echo esc_url(mktpd_service_value($data, 'cta_url', home_url('/orcamento/'))); ?>" class="services-btn services-btn-primary">
                    <?php echo esc_html(mktpd_service_value($data, 'cta_button', 'Solicitar diagnóstico')); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
