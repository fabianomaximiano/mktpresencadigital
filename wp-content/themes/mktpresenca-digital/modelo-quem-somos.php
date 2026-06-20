<?php
/**
 * Template Name: Quem Somos
 * Description: PÃ¡gina interna Quem Somos da MKT PresenÃ§a Digital.
 *
 * @package MKT_Presenca_Digital
 */

if (!defined('ABSPATH')) {
    exit;
}

$about_image = get_theme_mod('mktpd_home_about_image', '');

get_header();

wp_enqueue_style(
    'mktpd-quem-somos',
    get_stylesheet_directory_uri() . '/assets/css/modelo-quem-somos.css',
    array(),
    wp_get_theme()->get('Version')
);

?>

<main class="qs-page" id="conteudo-principal">
    <section class="qs-hero">
        <div class="qs-hero-shape qs-hero-shape-one" aria-hidden="true"></div>
        <div class="qs-hero-shape qs-hero-shape-two" aria-hidden="true"></div>

        <div class="qs-container">
            <div class="qs-hero-content">
                <span class="qs-eyebrow">MKT Presença Digital</span>

                <div class="qs-breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <span>Quem Somos</span>
                </div>

                <h1>Quem Somos</h1>

                <p>
                    Construimos presença digital para pequenos negócios que precisam aparecer melhor,
                    transmitir confiança e transformar visitas em oportunidades reais.
                </p>
            </div>
        </div>
    </section>

    <section class="qs-section qs-about">
        <div class="qs-container">
            <div class="qs-about-card">
                <div class="qs-about-media">
                    <div class="qs-about-image">
                        <?php if (!empty($about_image)) : ?>
                            <img src="<?php echo esc_url($about_image); ?>" alt="Ambiente de trabalho com monitores e tecnologia">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="qs-about-content">
                    <span class="qs-eyebrow">Nossa essência</span>

                    <h2>Estratégia, foco e resultados para sua empresa crescer no digital.</h2>

                    <p>
                        A MKT Presença Digital nasceu para ajudar pequenos negÃ³cios a organizarem sua comunicação
                        online com clareza, tecnologia e visão comercial.
                    </p>

                    <p>
                        Mais do que criar sites, desenvolvemos estruturas digitais pensadas para fortalecer autoridade,
                        melhorar a presença no Google e facilitar o contato entre empresas e clientes.
                    </p>

                    <div class="qs-feature-list">
                        <a href="<?php echo esc_url(home_url('/servicos/#sites-profissionais')); ?>">Sites profissionais</a>
                        <a href="<?php echo esc_url(home_url('/servicos/#seo-local')); ?>">SEO Local</a>
                        <a href="<?php echo esc_url(home_url('/servicos/#google-meu-negocio')); ?>">Google Meu NegÃ³cio</a>
                        <a href="<?php echo esc_url(home_url('/servicos/#performance-web')); ?>">Performance Web</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="qs-section qs-method">
        <div class="qs-container">
            <div class="qs-section-heading">
                <span class="qs-eyebrow">Como trabalhamos</span>

                <h2>Um processo simples, claro e orientado para resultado.</h2>

                <p>
                    Cada projeto comeÃ§a entendendo o cenÃ¡rio atual da empresa para definir prioridades,
                    evitar desperdÃ­cio e construir uma presenÃ§a digital mais eficiente.
                </p>
            </div>

            <div class="qs-method-grid">
                <article class="qs-method-card">
                    <span>01</span>
                    <h3>DiagnÃ³stico</h3>
                    <p>Analisamos site, presenÃ§a no Google, comunicaÃ§Ã£o, performance e pontos de melhoria.</p>
                </article>

                <article class="qs-method-card">
                    <span>02</span>
                    <h3>EstratÃ©gia</h3>
                    <p>Definimos o caminho ideal para melhorar visibilidade, autoridade e conversÃ£o.</p>
                </article>

                <article class="qs-method-card">
                    <span>03</span>
                    <h3>ImplementaÃ§Ã£o</h3>
                    <p>Aplicamos melhorias tÃ©cnicas, visuais e estruturais com foco em presenÃ§a digital.</p>
                </article>

                <article class="qs-method-card">
                    <span>04</span>
                    <h3>EvoluÃ§Ã£o</h3>
                    <p>Acompanhamos oportunidades, ajustes e prÃ³ximos passos para manter o crescimento.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="qs-stats">
        <div class="qs-container">
            <div class="qs-stats-grid">
                <div class="qs-stat">
                    <strong>+50</strong>
                    <span>Projetos analisados</span>
                </div>

                <div class="qs-stat">
                    <strong>+15</strong>
                    <span>Segmentos atendidos</span>
                </div>

                <div class="qs-stat">
                    <strong>3</strong>
                    <span>Cidades prioritÃ¡rias</span>
                </div>

                <div class="qs-stat">
                    <strong>100%</strong>
                    <span>Foco em presenÃ§a digital</span>
                </div>
            </div>
        </div>
    </section>

    <section class="qs-section qs-values">
        <div class="qs-container">
            <div class="qs-values-grid">
                <div class="qs-values-content">
                    <span class="qs-eyebrow">Nosso posicionamento</span>

                    <h2>PresenÃ§a digital nÃ£o Ã© sÃ³ estar online. Ã‰ ser encontrado, entendido e lembrado.</h2>

                    <p>
                        Trabalhamos para que cada projeto tenha uma comunicaÃ§Ã£o clara, estrutura tÃ©cnica organizada
                        e caminhos simples para transformar visitantes em contatos.
                    </p>
                </div>

                <div class="qs-values-list">
                    <div class="qs-value-item">
                        <strong>Clareza</strong>
                        <span>ConteÃºdo direto, objetivo e fÃ¡cil de entender.</span>
                    </div>

                    <div class="qs-value-item">
                        <strong>Performance</strong>
                        <span>Sites mais leves, rÃ¡pidos e preparados para SEO.</span>
                    </div>

                    <div class="qs-value-item">
                        <strong>Autoridade</strong>
                        <span>Estrutura para fortalecer confianÃ§a e presenÃ§a local.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="qs-cta">
        <div class="qs-container">
            <div class="qs-cta-card">
                <span class="qs-eyebrow">PrÃ³ximo passo</span>

                <h2>Sua empresa estÃ¡ sendo encontrada no Google?</h2>

                <p>
                    Vamos analisar sua presenÃ§a digital e identificar oportunidades para melhorar sua visibilidade,
                    comunicaÃ§Ã£o e geraÃ§Ã£o de contatos.
                </p>

                <a href="<?php echo esc_url(home_url('/orcamento/')); ?>" class="qs-btn">
                    Solicitar diagnÃ³stico
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
