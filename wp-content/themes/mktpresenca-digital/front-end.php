<?php
/**
 * Template Name: MKT Presença Digital - Home Front-end
 * Description: Template inicial da Home com visual atual preservado para reconstrução limpa do tema.
 *
 * @package MKT_Presenca_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$theme_uri  = get_stylesheet_directory_uri();
$upload_url = wp_upload_dir()['baseurl'];

$logo_white = get_theme_mod( 'mkt_logo_white', $upload_url . '/2025/05/logo-p.png' );
$logo_dark  = get_theme_mod( 'mkt_logo_dark', $upload_url . '/2025/07/logo-p-black.png' );
$hero_bg    = get_theme_mod( 'mkt_home_hero_bg', $upload_url . '/2025/04/banner-home.jpg' );

$whatsapp = preg_replace( '/\D+/', '', get_theme_mod( 'mkt_whatsapp_number', '5511997794726' ) );
$cta_url  = get_theme_mod( 'mkt_home_cta_url', home_url( '/orcamento/' ) );

$services = array(
    array(
        'icon'  => '✍',
        'title' => 'Criação de Sites e Landing Pages',
        'text'  => 'Ter um espaço online profissional e otimizado é o primeiro passo para sua presença digital. Criamos sites modernos, responsivos e intuitivos, além de landing pages estratégicas focadas em conversão.',
    ),
    array(
        'icon'  => '🔎',
        'title' => 'SEO',
        'text'  => 'Quer aparecer no topo do Google quando seus clientes buscam por seus produtos ou serviços? Nossa expertise em SEO envolve otimizar seu conteúdo, estrutura do site e outros fatores para melhorar seu posicionamento orgânico.',
    ),
    array(
        'icon'  => '👥',
        'title' => 'Redes Sociais',
        'text'  => 'As redes sociais são o canal perfeito para construir relacionamentos com seus clientes, divulgar sua marca e gerar engajamento com estratégias de conteúdo personalizadas.',
    ),
    array(
        'icon'  => '✉',
        'title' => 'Email Marketing',
        'text'  => 'O email marketing continua sendo uma ferramenta poderosa para nutrir leads, comunicar novidades e fidelizar clientes com campanhas criativas e eficazes.',
    ),
    array(
        'icon'  => '📊',
        'title' => 'Análise de Dados e Métricas',
        'text'  => 'Acompanhar e entender os dados é fundamental para o sucesso. Utilizamos ferramentas de análise para monitorar o desempenho das campanhas e identificar oportunidades.',
    ),
    array(
        'icon'  => '⌂',
        'title' => 'Automação e CRM',
        'text'  => 'Um sistema de CRM ajuda a organizar e gerenciar seus relacionamentos com clientes e potenciais clientes, construindo relacionamentos duradouros.',
    ),
);

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        :root {
            --mkt-dark: #070704;
            --mkt-blue: #071432;
            --mkt-gold: #dda13c;
            --mkt-cream: #f8f0df;
            --mkt-white: #ffffff;
            --mkt-text: #111827;
        }

        body.mkt-home-template {
            margin: 0;
            background: var(--mkt-cream);
            color: var(--mkt-text);
            font-family: 'Poppins', Arial, sans-serif;
        }

        .mkt-container {
            width: min(1110px, calc(100% - 40px));
            margin: 0 auto;
        }

        .mkt-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            padding: 24px 0;
            transition: background .25s ease, box-shadow .25s ease, padding .25s ease;
            background: transparent;
        }

        .mkt-header.is-scrolled {
            background: rgba(7, 7, 4, .92);
            box-shadow: 0 10px 25px rgba(0,0,0,.18);
            padding: 12px 0;
            backdrop-filter: blur(8px);
        }

        .mkt-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .mkt-logo img {
            width: 150px;
            height: auto;
            display: block;
        }

        .mkt-nav {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-left: auto;
        }

        .mkt-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color .2s ease;
        }

        .mkt-nav a:hover,
        .mkt-nav a:focus {
            color: var(--mkt-gold);
        }

        .mkt-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 28px;
            border-radius: 999px;
            background: var(--mkt-gold);
            color: #fff !important;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .04em;
            border: 0;
        }

        .mkt-hero {
            min-height: 690px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .mkt-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.62);
        }

        .mkt-hero-content {
            position: relative;
            z-index: 1;
            max-width: 850px;
            padding: 120px 20px 80px;
        }

        .mkt-eyebrow {
            font-size: clamp(24px, 3vw, 38px);
            font-weight: 800;
            line-height: 1.1;
            margin: 0 0 12px;
        }

        .mkt-hero h1 {
            font-size: clamp(34px, 5vw, 64px);
            line-height: 1.08;
            margin: 0 0 20px;
            color: #fff;
            font-weight: 800;
        }

        .mkt-hero p {
            font-size: clamp(16px, 1.8vw, 20px);
            line-height: 1.6;
            margin: 0 auto 34px;
            max-width: 820px;
        }

        .mkt-cookie-bar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: #1f1f1f;
            color: #fff;
            font-size: 12px;
            text-align: center;
            padding: 10px 15px;
        }

        .mkt-cookie-bar a {
            color: #6ec1e4;
        }

        .mkt-cookie-bar button {
            margin-left: 14px;
            border: 0;
            border-radius: 4px;
            background: #20b14b;
            color: #fff;
            font-size: 12px;
            padding: 6px 18px;
            cursor: pointer;
        }

        .mkt-section {
            padding: 92px 0;
        }

        .mkt-section-white {
            background: #fff;
        }

        .mkt-section-title {
            text-align: center;
            max-width: 780px;
            margin: 0 auto 54px;
        }

        .mkt-section-title h2 {
            font-size: clamp(32px, 4vw, 52px);
            line-height: 1.12;
            margin: 0 0 18px;
            color: var(--mkt-blue);
            font-weight: 800;
        }

        .mkt-section-title p {
            font-size: 15px;
            line-height: 1.8;
            color: #4b5563;
            margin: 0;
        }

        .mkt-service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .mkt-service-card {
            background: #fff;
            padding: 42px 34px;
            min-height: 320px;
            box-shadow: 0 12px 35px rgba(0,0,0,.04);
        }

        .mkt-service-icon {
            color: var(--mkt-gold);
            font-size: 48px;
            line-height: 1;
            margin-bottom: 20px;
            display: block;
        }

        .mkt-service-card h3 {
            font-size: 21px;
            line-height: 1.25;
            margin: 0 0 16px;
            color: var(--mkt-blue);
            font-weight: 800;
        }

        .mkt-service-card p {
            font-size: 15px;
            line-height: 1.75;
            color: #374151;
            margin: 0;
        }

        .mkt-cases {
            min-height: 560px;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .mkt-customers {
            min-height: 330px;
            text-align: center;
        }

        .mkt-logo-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            margin-top: 55px;
            opacity: .35;
        }

        .mkt-logo-box {
            min-height: 115px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-left: 1px solid #e5e7eb;
            color: #64748b;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .mkt-logo-box:last-child {
            border-right: 1px solid #e5e7eb;
        }

        .mkt-testimonials-title {
            background: var(--mkt-cream);
            text-align: center;
            padding: 70px 0;
        }

        .mkt-testimonials-title h2 {
            margin: 0;
            color: var(--mkt-blue);
            font-size: clamp(28px, 3vw, 40px);
            font-weight: 800;
        }

        .mkt-author {
            padding: 92px 0 54px;
            background: linear-gradient(180deg, #fff 0%, var(--mkt-cream) 100%);
        }

        .mkt-author-box {
            max-width: 980px;
            margin: 0 auto;
            border-left: 5px solid var(--mkt-gold);
            padding-left: 42px;
        }

        .mkt-author-box h3 {
            text-align: center;
            color: var(--mkt-blue);
            font-size: 18px;
            margin: 0 0 18px;
            font-weight: 800;
        }

        .mkt-author-box p {
            font-size: 14px;
            line-height: 1.8;
            color: #1f2937;
            margin: 0;
        }

        .mkt-newsletter {
            background: var(--mkt-cream);
            padding: 50px 0 100px;
        }

        .mkt-newsletter-card {
            background: #fff;
            border-radius: 6px;
            padding: 42px 48px;
            max-width: 960px;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(0,0,0,.04);
        }

        .mkt-newsletter-card h2 {
            color: var(--mkt-gold);
            margin: 0 0 8px;
            font-size: 30px;
            font-weight: 800;
        }

        .mkt-newsletter-card p {
            margin: 0 0 22px;
            color: var(--mkt-gold);
            font-size: 13px;
            font-weight: 600;
        }

        .mkt-newsletter-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .mkt-form-field label {
            display: block;
            color: var(--mkt-gold);
            font-size: 12px;
            margin-bottom: 6px;
        }

        .mkt-form-field input {
            width: 100%;
            height: 42px;
            border: 1px solid #e5e7eb;
            border-radius: 2px;
            padding: 0 12px;
        }

        .mkt-form-actions {
            grid-column: 1 / -1;
        }

        .mkt-form-actions button {
            background: #0d6efd;
            color: #fff;
            border: 0;
            border-radius: 4px;
            padding: 10px 18px;
            cursor: pointer;
        }

        .mkt-footer {
            background: var(--mkt-dark);
            color: #fff;
            padding: 86px 0 0;
        }

        .mkt-footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
            gap: 54px;
            align-items: flex-start;
            padding-bottom: 70px;
        }

        .mkt-footer-logo {
            width: 150px;
            margin-bottom: 36px;
        }

        .mkt-footer h3 {
            font-size: 20px;
            margin: 0 0 24px;
            color: #fff;
            font-weight: 800;
        }

        .mkt-footer p,
        .mkt-footer a {
            color: #fff;
            font-size: 14px;
            line-height: 1.75;
            text-decoration: none;
        }

        .mkt-footer ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .mkt-footer-bottom {
            border-top: 1px solid rgba(255,255,255,.08);
            text-align: center;
            padding: 28px 15px;
            font-size: 13px;
        }

        .mkt-mobile-toggle {
            display: none;
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255,255,255,.4);
            border-radius: 4px;
            padding: 8px 10px;
        }

        @media (max-width: 920px) {
            .mkt-mobile-toggle { display: block; }
            .mkt-nav {
                position: absolute;
                top: 100%;
                left: 20px;
                right: 20px;
                display: none;
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                background: rgba(7,7,4,.98);
                padding: 18px;
                border-radius: 8px;
            }
            .mkt-nav.is-open { display: flex; }
            .mkt-nav a { padding: 12px 0; }
            .mkt-service-grid { grid-template-columns: 1fr; }
            .mkt-logo-row { grid-template-columns: 1fr 1fr; }
            .mkt-footer-grid { grid-template-columns: 1fr; }
            .mkt-newsletter-form { grid-template-columns: 1fr; }
            .mkt-hero { min-height: 620px; }
        }
    </style>
</head>
<body <?php body_class( 'mkt-home-template' ); ?>>
<?php wp_body_open(); ?>

<header class="mkt-header" id="mktHeader">
    <div class="mkt-container mkt-header-inner">
        <a class="mkt-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="MKT Presença Digital">
            <img src="<?php echo esc_url( $logo_white ); ?>" alt="MKT Presença Digital" data-logo-white="<?php echo esc_url( $logo_white ); ?>" data-logo-dark="<?php echo esc_url( $logo_dark ); ?>">
        </a>

        <button class="mkt-mobile-toggle" type="button" aria-label="Abrir menu" aria-controls="mktNav" aria-expanded="false">☰</button>

        <nav class="mkt-nav" id="mktNav" aria-label="Menu principal">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <a href="<?php echo esc_url( home_url( '/quem-somos/' ) ); ?>">Quem somos</a>
            <a href="<?php echo esc_url( home_url( '/servicos/' ) ); ?>">Serviços</a>
            <a href="<?php echo esc_url( home_url( '/contato/' ) ); ?>">Contato</a>
            <a class="mkt-btn" href="<?php echo esc_url( $cta_url ); ?>">Solicitar orçamento</a>
        </nav>
    </div>
</header>

<main id="conteudo-principal">
    <section class="mkt-hero" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
        <div class="mkt-hero-content">
            <p class="mkt-eyebrow"><?php echo esc_html( get_theme_mod( 'mkt_home_eyebrow', 'Presença Digital' ) ); ?></p>
            <h1><?php echo esc_html( get_theme_mod( 'mkt_home_title', 'Sua empresa online do jeito certo.' ) ); ?></h1>
            <p><?php echo esc_html( get_theme_mod( 'mkt_home_subtitle', 'Presença digital profissional para atrair mais clientes todos os dias. Tenha um site atrativo, redes sociais com engajamento e estratégias que realmente funcionam.' ) ); ?></p>
            <a class="mkt-btn" href="<?php echo esc_url( get_theme_mod( 'mkt_home_button_url', home_url( '/servicos/' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'mkt_home_button_text', 'Saiba mais' ) ); ?></a>
        </div>
    </section>

    <div class="mkt-cookie-bar" id="mktCookieBar">
        Este site utiliza cookies para melhorar sua experiência. <a href="<?php echo esc_url( home_url( '/politica-de-privacidade/' ) ); ?>">Saiba mais.</a>
        <button type="button" id="mktCookieAccept">Aceitar</button>
    </div>

    <section class="mkt-section">
        <div class="mkt-container">
            <div class="mkt-section-title">
                <h2>Conheça os principais<br>serviços</h2>
                <p>E saiba como construir a imagem da sua empresa na internet.</p>
            </div>

            <div class="mkt-service-grid">
                <?php foreach ( $services as $service ) : ?>
                    <article class="mkt-service-card">
                        <span class="mkt-service-icon" aria-hidden="true"><?php echo esc_html( $service['icon'] ); ?></span>
                        <h3><?php echo esc_html( $service['title'] ); ?></h3>
                        <p><?php echo esc_html( $service['text'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mkt-section-white mkt-cases">
        <div class="mkt-container">
            <div class="mkt-section-title">
                <h2>Principais Cases</h2>
                <p>Projetos desenvolvidos para fortalecer presença digital, desempenho e posicionamento online.</p>
            </div>
            <a class="mkt-btn" href="<?php echo esc_url( home_url( '/cases/' ) ); ?>">Saiba mais</a>
        </div>
    </section>

    <section class="mkt-section-white mkt-customers">
        <div class="mkt-container">
            <div class="mkt-section-title">
                <h2>Our Customers</h2>
                <p>Empresas e projetos que confiaram na MKT Presença Digital.</p>
            </div>
            <div class="mkt-logo-row" aria-label="Clientes">
                <div class="mkt-logo-box">LOGO</div>
                <div class="mkt-logo-box">LOGOIPSUM</div>
                <div class="mkt-logo-box">LOGO</div>
                <div class="mkt-logo-box">LOGOIPSUM</div>
            </div>
        </div>
    </section>

    <section class="mkt-testimonials-title">
        <div class="mkt-container">
            <h2>O que estão dizendo nossos clientes</h2>
        </div>
    </section>

    <section class="mkt-author">
        <div class="mkt-container">
            <div class="mkt-author-box">
                <h3>Fabiano Maximiano</h3>
                <p><strong>Fabiano Maximiano</strong> é um desenvolvedor Full Stack com foco em WordPress e ampla experiência no desenvolvimento de aplicações web. Especialista em criar temas e plugins personalizados, otimizar performance e garantir a segurança de sites. Com experiência em empresas como Crefisa e G&amp;P Sistemas, atua no desenvolvimento e manutenção de soluções digitais sob medida.</p>
            </div>
        </div>
    </section>

    <section class="mkt-newsletter">
        <div class="mkt-container">
            <div class="mkt-newsletter-card">
                <h2>Assine nossa Newsletter</h2>
                <p>Fique por dentro das novidades, preencha o formulário e receba dicas e novidades.</p>

                <form class="mkt-newsletter-form" id="formulario-news" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                    <input type="hidden" name="action" value="processar_meu_formulario">
                    <input type="hidden" name="meu_nonce" value="<?php echo esc_attr( wp_create_nonce( 'meu_formulario_nonce' ) ); ?>">

                    <div class="mkt-form-field">
                        <label for="mkt-news-name">Nome Completo</label>
                        <input id="mkt-news-name" type="text" name="nome" autocomplete="name" required>
                    </div>
                    <div class="mkt-form-field">
                        <label for="mkt-news-email">Email</label>
                        <input id="mkt-news-email" type="email" name="email" autocomplete="email" required>
                    </div>
                    <div class="mkt-form-actions">
                        <button type="submit">Assinar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="mkt-footer">
    <div class="mkt-container mkt-footer-grid">
        <div>
            <img class="mkt-footer-logo" src="<?php echo esc_url( $logo_white ); ?>" alt="MKT Presença Digital">
            <p><strong>MKT PRESENÇA DIGITAL</strong><br>Conectando Pequenos Negócios ao Sucesso Online</p>
            <p><a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" target="_blank" rel="noopener">WhatsApp</a></p>
        </div>

        <div>
            <h3>Company</h3>
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><a href="<?php echo esc_url( home_url( '/quem-somos/' ) ); ?>">Quem Somos</a></li>
                <li><a href="<?php echo esc_url( home_url( '/servicos/' ) ); ?>">Serviços</a></li>
                <li><a href="<?php echo esc_url( home_url( '/contato/' ) ); ?>">Contato</a></li>
            </ul>
        </div>

        <div>
            <h3>Business</h3>
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/cases/' ) ); ?>">Project</a></li>
                <li><a href="<?php echo esc_url( home_url( '/quem-somos/' ) ); ?>">Our Team</a></li>
                <li><a href="<?php echo esc_url( home_url( '/servicos/' ) ); ?>">Facts</a></li>
                <li><a href="<?php echo esc_url( home_url( '/clientes/' ) ); ?>">Customers</a></li>
            </ul>
        </div>

        <div>
            <h3>Onde estamos</h3>
            <p>Rua Sara Newton, 103, JD Boa Vista – Butantã – SP<br>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">www.mktpresencadigital.com.br</a><br>
            <a href="tel:+5511997794726">+55 (11) 99779-4726</a></p>
        </div>
    </div>

    <div class="mkt-footer-bottom">
        Copyright © <?php echo esc_html( date( 'Y' ) ); ?> MKT Presença Digital | Powered by MKT Presença Digital
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.getElementById('mktHeader');
        const toggle = document.querySelector('.mkt-mobile-toggle');
        const nav = document.getElementById('mktNav');
        const cookieBar = document.getElementById('mktCookieBar');
        const cookieAccept = document.getElementById('mktCookieAccept');

        function updateHeader() {
            if (window.scrollY > 80) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        }

        updateHeader();
        window.addEventListener('scroll', updateHeader, { passive: true });

        if (toggle && nav) {
            toggle.addEventListener('click', function () {
                const isOpen = nav.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        if (cookieBar && cookieAccept) {
            if (localStorage.getItem('mkt_cookie_accepted') === '1') {
                cookieBar.style.display = 'none';
            }

            cookieAccept.addEventListener('click', function () {
                localStorage.setItem('mkt_cookie_accepted', '1');
                cookieBar.style.display = 'none';
            });
        }
    });
</script>

<?php wp_footer(); ?>
</body>
</html>
