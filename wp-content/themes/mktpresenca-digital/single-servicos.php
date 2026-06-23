<?php
/**
 * Template para página interna do CPT Serviços.
 *
 * @package MKT_Presenca_Digital
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (!function_exists('mktpd_single_service_meta')) {
    function mktpd_single_service_meta($post_id, $key, $default = '') {
        $value = get_post_meta($post_id, $key, true);

        return $value !== '' ? $value : $default;
    }
}

$post_id = get_the_ID();

$hero_image_id  = absint(mktpd_single_service_meta($post_id, 'mktpd_service_hero_image_id', 0));
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'full') : '';

$included_defaults = array(
    array('Domínio e hospedagem', 'Orientação no registro do domínio, configuração da hospedagem e organização do ambiente do site.'),
    array('WordPress sob medida', 'Estrutura desenvolvida para facilitar manutenção, crescimento e evolução do projeto.'),
    array('Performance e imagens leves', 'Boas práticas de carregamento, otimização visual e preparação para PageSpeed.'),
    array('SEO técnico inicial', 'Estrutura pensada para ajudar o Google a entender melhor suas páginas e seus serviços.'),
    array('Atendimento e conversão', 'Botões de WhatsApp, formulários, chamadas comerciais e caminhos claros para contato.'),
    array('Painel de controle', 'Organização do conteúdo para facilitar atualizações e ajustes sem depender de plugins desnecessários.'),
);

$metric_defaults = array(
    array('95+', 'Meta Mobile'),
    array('99+', 'Meta Desktop'),
    array('WebP', 'Imagens leves'),
    array('SEO', 'Base técnica'),
);

$process_defaults = array(
    array('Diagnóstico', 'Entendemos seu negócio, público, serviços, região de atuação e objetivo comercial.'),
    array('Estrutura', 'Organizamos as páginas, mensagens, chamadas, formulários e caminhos de contato.'),
    array('Desenvolvimento', 'Criamos o site com foco em visual, performance, experiência mobile e clareza comercial.'),
    array('Publicação', 'Configuramos o ambiente, revisamos os pontos principais e deixamos o projeto pronto para receber visitantes.'),
);

$benefit_defaults = array(
    'Mais credibilidade para sua empresa.',
    'Melhor apresentação dos seus serviços.',
    'Mais facilidade para receber contatos e pedidos de orçamento.',
    'Base mais forte para SEO, Google e campanhas futuras.',
);

$faq_defaults = array(
    array('Preciso já ter domínio?', 'Não. Podemos orientar no registro do domínio e explicar os cuidados para escolher um endereço profissional.'),
    array('Vocês configuram hospedagem?', 'Sim. Ajudamos na configuração do ambiente para que o site funcione com segurança e estabilidade.'),
    array('O site será em WordPress?', 'Sim, quando fizer sentido para o projeto. Usamos WordPress de forma estruturada, leve e com o mínimo de dependência de plugins.'),
    array('O site vai ser rápido?', 'O desenvolvimento é feito considerando performance, imagens otimizadas, estrutura limpa e boas práticas de carregamento.'),
    array('Depois de pronto posso atualizar o conteúdo?', 'Sim. A estrutura pode ser preparada para facilitar atualizações de textos, imagens e informações principais.'),
);
?>

<main class="single-service-page">

    <section class="single-service-hero">
        <?php if ($hero_image_url) : ?>
            <img
                class="single-service-hero-bg"
                src="<?php echo esc_url($hero_image_url); ?>"
                alt=""
                aria-hidden="true"
            >
        <?php endif; ?>

        <div class="single-service-container">
            <div class="single-service-breadcrumb">
                <span><?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_hero_eyebrow', 'Serviços')); ?></span>
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span>/</span>
                <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Serviços</a>
                <span>/</span>
                <strong><?php the_title(); ?></strong>
            </div>

            <h1>
                <?php
                echo esc_html(
                    mktpd_single_service_meta(
                        $post_id,
                        'mktpd_service_hero_title',
                        get_the_title() . ' para empresas que precisam vender melhor.'
                    )
                );
                ?>
            </h1>

            <p>
                <?php
                echo esc_html(
                    mktpd_single_service_meta(
                        $post_id,
                        'mktpd_service_hero_text',
                        'Desenvolvemos soluções digitais profissionais, rápidas e preparadas para transformar visitantes em contatos, orçamentos e oportunidades reais de negócio.'
                    )
                );
                ?>
            </p>

            <div class="single-service-actions">
                <a href="<?php echo esc_url(mktpd_single_service_meta($post_id, 'mktpd_service_cta_url', home_url('/orcamento/'))); ?>" class="single-service-btn single-service-btn-primary">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_cta_button', 'Solicitar orçamento')); ?>
                </a>
                <a href="#como-funciona" class="single-service-btn single-service-btn-secondary">
                    Entender como funciona
                </a>
            </div>
        </div>
    </section>

    <section class="single-service-section single-service-intro">
        <div class="single-service-container single-service-grid">
            <div>
                <span class="single-service-eyebrow">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_intro_eyebrow', 'Mais que uma página bonita')); ?>
                </span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_intro_title',
                            'Seu site precisa apresentar, convencer e facilitar o atendimento.'
                        )
                    );
                    ?>
                </h2>
            </div>

            <div>
                <p>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_intro_text_1',
                            'Um site profissional não deve ser apenas um cartão de visitas online. Ele precisa carregar rápido, funcionar bem no celular, transmitir confiança e conduzir o visitante para uma ação.'
                        )
                    );
                    ?>
                </p>

                <p>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_intro_text_2',
                            'Por isso, criamos estruturas digitais pensadas para pequenos negócios que precisam aparecer melhor, explicar seus serviços e transformar acessos em oportunidades.'
                        )
                    );
                    ?>
                </p>
            </div>
        </div>
    </section>

    <section class="single-service-section single-service-included">
        <div class="single-service-container">
            <div class="single-service-heading">
                <span class="single-service-eyebrow">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_included_eyebrow', 'O que está incluso')); ?>
                </span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_included_title',
                            'Da estrutura ao lançamento, cuidamos dos pontos essenciais.'
                        )
                    );
                    ?>
                </h2>
            </div>

            <div class="single-service-cards">
                <?php foreach ($included_defaults as $index => $included) : ?>
                    <?php
                    $number = $index + 1;
                    $title  = mktpd_single_service_meta($post_id, "mktpd_service_included_{$number}_title", $included[0]);
                    $text   = mktpd_single_service_meta($post_id, "mktpd_service_included_{$number}_text", $included[1]);

                    if (!$title && !$text) {
                        continue;
                    }
                    ?>
                    <article>
                        <span><?php echo esc_html(str_pad((string) $number, 2, '0', STR_PAD_LEFT)); ?></span>
                        <?php if ($title) : ?>
                            <h3><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>
                        <?php if ($text) : ?>
                            <p><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="single-service-performance">
        <div class="single-service-container">
            <div class="single-service-heading single-service-heading-center">
                <span class="single-service-eyebrow">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_performance_eyebrow', 'Diferencial técnico')); ?>
                </span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_performance_title',
                            'Site rápido, leve e preparado para crescer.'
                        )
                    );
                    ?>
                </h2>

                <p>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_performance_text',
                            'Performance, estrutura limpa e conteúdo bem organizado ajudam sua empresa a transmitir mais confiança e melhorar sua presença digital.'
                        )
                    );
                    ?>
                </p>
            </div>

            <div class="single-service-metrics">
                <?php foreach ($metric_defaults as $index => $metric) : ?>
                    <?php
                    $number = $index + 1;
                    $value  = mktpd_single_service_meta($post_id, "mktpd_service_metric_{$number}_number", $metric[0]);
                    $label  = mktpd_single_service_meta($post_id, "mktpd_service_metric_{$number}_label", $metric[1]);

                    if (!$value && !$label) {
                        continue;
                    }
                    ?>
                    <div>
                        <?php if ($value) : ?>
                            <strong><?php echo esc_html($value); ?></strong>
                        <?php endif; ?>
                        <?php if ($label) : ?>
                            <span><?php echo esc_html($label); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="como-funciona" class="single-service-section single-service-process">
        <div class="single-service-container">
            <div class="single-service-heading single-service-heading-center">
                <span class="single-service-eyebrow">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_process_eyebrow', 'Metodologia')); ?>
                </span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_process_title',
                            'Como funciona o desenvolvimento do site.'
                        )
                    );
                    ?>
                </h2>
            </div>

            <div class="single-service-process-grid">
                <?php foreach ($process_defaults as $index => $step) : ?>
                    <?php
                    $number = $index + 1;
                    $title  = mktpd_single_service_meta($post_id, "mktpd_service_process_{$number}_title", $step[0]);
                    $text   = mktpd_single_service_meta($post_id, "mktpd_service_process_{$number}_text", $step[1]);

                    if (!$title && !$text) {
                        continue;
                    }
                    ?>
                    <article>
                        <span><?php echo esc_html(str_pad((string) $number, 2, '0', STR_PAD_LEFT)); ?></span>
                        <?php if ($title) : ?>
                            <h3><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>
                        <?php if ($text) : ?>
                            <p><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="single-service-section single-service-benefits">
        <div class="single-service-container single-service-grid">
            <div>
                <span class="single-service-eyebrow">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_benefits_eyebrow', 'Benefícios')); ?>
                </span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_benefits_title',
                            'O site passa a trabalhar como parte da sua estratégia comercial.'
                        )
                    );
                    ?>
                </h2>
            </div>

            <div class="single-service-benefit-list">
                <?php foreach ($benefit_defaults as $index => $benefit_default) : ?>
                    <?php
                    $number  = $index + 1;
                    $benefit = mktpd_single_service_meta($post_id, "mktpd_service_benefit_{$number}", $benefit_default);

                    if (!$benefit) {
                        continue;
                    }
                    ?>
                    <div><?php echo esc_html($benefit); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="single-service-section single-service-faq">
        <div class="single-service-container">
            <div class="single-service-heading">
                <span class="single-service-eyebrow">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_faq_eyebrow', 'Dúvidas frequentes')); ?>
                </span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_faq_title',
                            'Perguntas comuns sobre criação de sites.'
                        )
                    );
                    ?>
                </h2>
            </div>

            <div class="single-service-faq-list">
                <?php foreach ($faq_defaults as $index => $faq) : ?>
                    <?php
                    $number   = $index + 1;
                    $question = mktpd_single_service_meta($post_id, "mktpd_service_faq_{$number}_question", $faq[0]);
                    $answer   = mktpd_single_service_meta($post_id, "mktpd_service_faq_{$number}_answer", $faq[1]);

                    if (!$question && !$answer) {
                        continue;
                    }
                    ?>
                    <details>
                        <?php if ($question) : ?>
                            <summary><?php echo esc_html($question); ?></summary>
                        <?php endif; ?>
                        <?php if ($answer) : ?>
                            <p><?php echo esc_html($answer); ?></p>
                        <?php endif; ?>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="single-service-final-cta">
        <div class="single-service-container">
            <div class="single-service-cta-card">
                <span><?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_cta_eyebrow', 'MKT Presença Digital')); ?></span>

                <h2>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_cta_title',
                            'Vamos criar uma solução digital que ajude sua empresa a vender melhor?'
                        )
                    );
                    ?>
                </h2>

                <p>
                    <?php
                    echo esc_html(
                        mktpd_single_service_meta(
                            $post_id,
                            'mktpd_service_cta_text',
                            'Conte sua necessidade e vamos entender qual estrutura faz mais sentido para o seu negócio.'
                        )
                    );
                    ?>
                </p>

                <a href="<?php echo esc_url(mktpd_single_service_meta($post_id, 'mktpd_service_cta_url', home_url('/orcamento/'))); ?>" class="single-service-btn single-service-btn-primary">
                    <?php echo esc_html(mktpd_single_service_meta($post_id, 'mktpd_service_cta_button', 'Solicitar orçamento')); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
