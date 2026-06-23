<?php
/**
 * Template Name: Laboratório Serviço Interno
 * Description: Laboratório visual para página interna de serviço.
 *
 * @package MKT_Presenca_Digital
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

wp_enqueue_style(
    'mktpd-lab-single-servico',
    get_stylesheet_directory_uri() . '/assets/css/single-servicos.css',
    array('mktpd-header'),
    wp_get_theme()->get('Version')
);
?>

<main class="single-service-page">

    <!-- HERO -->
<section class="single-service-hero">
    <div class="single-service-container">
        <div class="single-service-breadcrumb">
            <span>Serviços</span>
            <a href="/">Home</a>
            <span>/</span>
            <a href="/servicos/">Serviços</a>
            <span>/</span>
            <strong>Criação de Sites</strong>
        </div>

        <h1>Criação de Sites para empresas que precisam vender melhor.</h1>

        <p>
            Desenvolvemos sites profissionais, rápidos e preparados para transformar visitantes em contatos, orçamentos e oportunidades reais de negócio.
        </p>

        <div class="single-service-actions">
            <a href="/orcamento/" class="single-service-btn single-service-btn-primary">Solicitar orçamento</a>
            <a href="#como-funciona" class="single-service-btn single-service-btn-secondary">Entender como funciona</a>
        </div>
    </div>
</section>

<!-- INTRO -->
<section class="single-service-section single-service-intro">
    <div class="single-service-container single-service-grid">
        <div>
            <span class="single-service-eyebrow">Mais que uma página bonita</span>
            <h2>Seu site precisa apresentar, convencer e facilitar o atendimento.</h2>
        </div>

        <div>
            <p>
                Um site profissional não deve ser apenas um cartão de visitas online. Ele precisa carregar rápido, funcionar bem no celular, transmitir confiança e conduzir o visitante para uma ação.
            </p>

            <p>
                Por isso, criamos estruturas digitais pensadas para pequenos negócios que precisam aparecer melhor, explicar seus serviços e transformar acessos em oportunidades.
            </p>
        </div>
    </div>
</section>

<!-- INCLUSO -->
<section class="single-service-section single-service-included">
    <div class="single-service-container">
        <div class="single-service-heading">
            <span class="single-service-eyebrow">O que está incluso</span>
            <h2>Da estrutura ao lançamento, cuidamos dos pontos essenciais.</h2>
        </div>

        <div class="single-service-cards">
            <article>
                <span>01</span>
                <h3>Domínio e hospedagem</h3>
                <p>Orientação no registro do domínio, configuração da hospedagem e organização do ambiente do site.</p>
            </article>

            <article>
                <span>02</span>
                <h3>WordPress sob medida</h3>
                <p>Estrutura desenvolvida para facilitar manutenção, crescimento e evolução do projeto.</p>
            </article>

            <article>
                <span>03</span>
                <h3>Performance e imagens leves</h3>
                <p>Boas práticas de carregamento, otimização visual e preparação para PageSpeed.</p>
            </article>

            <article>
                <span>04</span>
                <h3>SEO técnico inicial</h3>
                <p>Estrutura pensada para ajudar o Google a entender melhor suas páginas e seus serviços.</p>
            </article>

            <article>
                <span>05</span>
                <h3>Atendimento e conversão</h3>
                <p>Botões de WhatsApp, formulários, chamadas comerciais e caminhos claros para contato.</p>
            </article>

            <article>
                <span>06</span>
                <h3>Painel de controle</h3>
                <p>Organização do conteúdo para facilitar atualizações e ajustes sem depender de plugins desnecessários.</p>
            </article>
        </div>
    </div>
</section>

<!-- FAIXA ESCURA -->
<section class="single-service-performance">
    <div class="single-service-container">
        <div class="single-service-heading single-service-heading-center">
            <span class="single-service-eyebrow">Diferencial técnico</span>
            <h2>Site rápido, leve e preparado para crescer.</h2>
            <p>
                Performance, estrutura limpa e conteúdo bem organizado ajudam sua empresa a transmitir mais confiança e melhorar sua presença digital.
            </p>
        </div>

        <div class="single-service-metrics">
            <div>
                <strong>95+</strong>
                <span>Meta Mobile</span>
            </div>

            <div>
                <strong>99+</strong>
                <span>Meta Desktop</span>
            </div>

            <div>
                <strong>WebP</strong>
                <span>Imagens leves</span>
            </div>

            <div>
                <strong>SEO</strong>
                <span>Base técnica</span>
            </div>
        </div>
    </div>
</section>

<!-- COMO FUNCIONA -->
<section id="como-funciona" class="single-service-section single-service-process">
    <div class="single-service-container">
        <div class="single-service-heading single-service-heading-center">
            <span class="single-service-eyebrow">Metodologia</span>
            <h2>Como funciona o desenvolvimento do site.</h2>
        </div>

        <div class="single-service-process-grid">
            <article>
                <span>01</span>
                <h3>Diagnóstico</h3>
                <p>Entendemos seu negócio, público, serviços, região de atuação e objetivo comercial.</p>
            </article>

            <article>
                <span>02</span>
                <h3>Estrutura</h3>
                <p>Organizamos as páginas, mensagens, chamadas, formulários e caminhos de contato.</p>
            </article>

            <article>
                <span>03</span>
                <h3>Desenvolvimento</h3>
                <p>Criamos o site com foco em visual, performance, experiência mobile e clareza comercial.</p>
            </article>

            <article>
                <span>04</span>
                <h3>Publicação</h3>
                <p>Configuramos o ambiente, revisamos os pontos principais e deixamos o projeto pronto para receber visitantes.</p>
            </article>
        </div>
    </div>
</section>

<!-- BENEFÍCIOS -->
<section class="single-service-section single-service-benefits">
    <div class="single-service-container single-service-grid">
        <div>
            <span class="single-service-eyebrow">Benefícios</span>
            <h2>O site passa a trabalhar como parte da sua estratégia comercial.</h2>
        </div>

        <div class="single-service-benefit-list">
            <div>Mais credibilidade para sua empresa.</div>
            <div>Melhor apresentação dos seus serviços.</div>
            <div>Mais facilidade para receber contatos e pedidos de orçamento.</div>
            <div>Base mais forte para SEO, Google e campanhas futuras.</div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="single-service-section single-service-faq">
    <div class="single-service-container">
        <div class="single-service-heading">
            <span class="single-service-eyebrow">Dúvidas frequentes</span>
            <h2>Perguntas comuns sobre criação de sites.</h2>
        </div>

        <div class="single-service-faq-list">
            <details>
                <summary>Preciso já ter domínio?</summary>
                <p>Não. Podemos orientar no registro do domínio e explicar os cuidados para escolher um endereço profissional.</p>
            </details>

            <details>
                <summary>Vocês configuram hospedagem?</summary>
                <p>Sim. Ajudamos na configuração do ambiente para que o site funcione com segurança e estabilidade.</p>
            </details>

            <details>
                <summary>O site será em WordPress?</summary>
                <p>Sim, quando fizer sentido para o projeto. Usamos WordPress de forma estruturada, leve e com o mínimo de dependência de plugins.</p>
            </details>

            <details>
                <summary>O site vai ser rápido?</summary>
                <p>O desenvolvimento é feito considerando performance, imagens otimizadas, estrutura limpa e boas práticas de carregamento.</p>
            </details>

            <details>
                <summary>Depois de pronto posso atualizar o conteúdo?</summary>
                <p>Sim. A estrutura pode ser preparada para facilitar atualizações de textos, imagens e informações principais.</p>
            </details>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="single-service-final-cta">
    <div class="single-service-container">
        <div class="single-service-cta-card">
            <span>MKT Presença Digital</span>
            <h2>Vamos criar um site que ajude sua empresa a vender melhor?</h2>
            <p>
                Conte sua necessidade e vamos entender qual estrutura faz mais sentido para o seu negócio.
            </p>
            <a href="/orcamento/" class="single-service-btn single-service-btn-primary">Solicitar orçamento</a>
        </div>
    </div>
</section>

</main>

<?php
get_footer();