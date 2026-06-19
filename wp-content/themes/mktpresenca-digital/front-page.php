<?php
/**
 * Front Page - MKT Presença Digital
 *
 * Home principal do novo tema.
 */

get_header();
?>

<main>
    <section class="hero" id="inicio">
        <div class="container">
            <div class="hero-content">
                <span class="eyebrow">Marketing, SEO e Presença Digital</span>
                <h1>Presença digital para pequenos negócios</h1>
                <p>
                    Estratégias digitais, criação de sites, SEO Local e soluções sob medida para empresas que querem aparecer melhor no Google e conquistar mais clientes.
                </p>

                <div class="hero-actions">
                    <a href="<?php echo esc_url(home_url('/orcamento/')); ?>" class="btn-primary">Solicitar orçamento</a>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>" class="btn-outline">Conhecer serviços</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="quem-somos">
        <div class="container about-grid">
            <div class="about-image" aria-hidden="true"></div>

            <div class="about-content">
                <div class="small">Quem somos</div>
                <h2>Soluções digitais para empresas que precisam crescer com estratégia.</h2>
                <p>
                    A MKT Presença Digital ajuda pequenos negócios a construir uma presença online profissional, clara e preparada para gerar oportunidades reais.
                </p>
                <p>
                    Atuamos com criação de sites, SEO Local, Google Meu Negócio, páginas de conversão e melhorias técnicas para que sua empresa seja encontrada por quem realmente procura seus serviços.
                </p>

                <ul class="feature-list">
                    <li>Sites profissionais</li>
                    <li>SEO Local</li>
                    <li>Google Meu Negócio</li>
                    <li>Performance Web</li>
                </ul>

                <a href="<?php echo esc_url(home_url('/contato/')); ?>" class="btn-primary">Falar com especialista</a>
            </div>
        </div>
    </section>

    <section class="section section-light" id="servicos">
        <div class="container">
            <div class="section-title">
                <div class="small">Nossos serviços</div>
                <h2>O que fazemos para melhorar sua presença digital</h2>
                <p>
                    Uma estrutura completa para sua empresa aparecer melhor, transmitir mais confiança e converter visitantes em contatos.
                </p>
            </div>

            <div class="services-grid">
                <article class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-arrow-trend-up" aria-hidden="true"></i></div>
                    <h3>Criação de Sites</h3>
                    <p>Sites institucionais modernos, responsivos e preparados para conversão.</p>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Saiba mais →</a>
                </article>

                <article class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-magnifying-glass-location" aria-hidden="true"></i></div>
                    <h3>SEO Local</h3>
                    <p>Estratégias para sua empresa aparecer melhor nas buscas da sua região.</p>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Saiba mais →</a>
                </article>

                <article class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-star" aria-hidden="true"></i></div>
                    <h3>Google Meu Negócio</h3>
                    <p>Otimização do perfil da empresa para gerar mais visibilidade e confiança.</p>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Saiba mais →</a>
                </article>

                <article class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-bolt" aria-hidden="true"></i></div>
                    <h3>Performance Web</h3>
                    <p>Melhorias técnicas para sites mais rápidos, leves e eficientes.</p>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Saiba mais →</a>
                </article>

                <article class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-layer-group" aria-hidden="true"></i></div>
                    <h3>Landing Pages</h3>
                    <p>Páginas focadas em campanhas, captação de leads e vendas.</p>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Saiba mais →</a>
                </article>

                <article class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></div>
                    <h3>Diagnóstico Digital</h3>
                    <p>Análise da presença online para identificar oportunidades de melhoria.</p>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>">Saiba mais →</a>
                </article>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container stats-grid">
            <div class="stat">
                <strong>+50</strong>
                <span>Projetos analisados</span>
            </div>
            <div class="stat">
                <strong>+15</strong>
                <span>Segmentos atendidos</span>
            </div>
            <div class="stat">
                <strong>3</strong>
                <span>Cidades prioritárias</span>
            </div>
            <div class="stat">
                <strong>100%</strong>
                <span>Foco em presença digital</span>
            </div>
        </div>
    </section>

    <section class="section section-light" id="cases">
        <div class="container">
            <div class="section-title">
                <div class="small">Cases e projetos</div>
                <h2>Projetos que fortalecem presença digital</h2>
                <p>
                    Soluções aplicadas para empresas locais, prestadores de serviços e negócios que precisam melhorar sua presença online, autoridade e geração de oportunidades.
                </p>
            </div>

            <?php
            $mktpd_projects_query = new WP_Query(array(
                'post_type'      => 'projetos',
                'posts_per_page' => 3,
                'meta_key'       => 'mktpd_project_featured',
                'meta_value'     => '1',
                'orderby'        => 'menu_order date',
                'order'          => 'DESC',
            ));

            if (!$mktpd_projects_query->have_posts()) {
                $mktpd_projects_query = new WP_Query(array(
                    'post_type'      => 'projetos',
                    'posts_per_page' => 3,
                    'orderby'        => 'menu_order date',
                    'order'          => 'DESC',
                ));
            }
            ?>

            <?php if ($mktpd_projects_query->have_posts()) : ?>
                <div class="cases-grid">
                    <?php while ($mktpd_projects_query->have_posts()) : ?>
                        <?php
                        $mktpd_projects_query->the_post();

                        $project_solution = get_post_meta(get_the_ID(), 'mktpd_project_solution', true);
                        $project_terms = get_the_terms(get_the_ID(), 'segmento_projeto');
                        $project_segment = (!empty($project_terms) && !is_wp_error($project_terms)) ? $project_terms[0]->name : 'Presença Digital';
                        ?>

                        <article class="case-card">
                            <a href="<?php the_permalink(); ?>" class="case-link" aria-label="<?php echo esc_attr(sprintf('Ver projeto %s', get_the_title())); ?>">
                                <div class="case-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    <?php else : ?>
                                        <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </div>

                                <div class="case-body">
                                    <small><?php echo esc_html($project_segment); ?></small>

                                    <h3><?php the_title(); ?></h3>

                                    <p>
                                        <?php
                                        if (!empty($project_solution)) {
                                            echo esc_html(wp_trim_words($project_solution, 18, '...'));
                                        } elseif (has_excerpt()) {
                                            echo esc_html(wp_trim_words(get_the_excerpt(), 18, '...'));
                                        } else {
                                            echo esc_html('Solução desenvolvida para fortalecer a presença digital e melhorar a comunicação online.');
                                        }
                                        ?>
                                    </p>

                                    <span class="case-more">Ver projeto →</span>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="cases-grid">
                    <article class="case-card">
                        <div class="case-image">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>

                        <div class="case-body">
                            <small>SEO Local</small>
                            <h3>Projeto para empresa local</h3>
                            <p>Melhoria da estrutura digital, presença no Google e páginas orientadas para conversão.</p>
                            <span class="case-more">Em breve →</span>
                        </div>
                    </article>

                    <article class="case-card">
                        <div class="case-image">
                            <i class="fa-solid fa-laptop-code" aria-hidden="true"></i>
                        </div>

                        <div class="case-body">
                            <small>Presença Digital</small>
                            <h3>Presença online institucional</h3>
                            <p>Estrutura visual moderna para transmitir confiança e facilitar contato.</p>
                            <span class="case-more">Em breve →</span>
                        </div>
                    </article>

                    <article class="case-card">
                        <div class="case-image">
                            <i class="fa-solid fa-gauge-high" aria-hidden="true"></i>
                        </div>

                        <div class="case-body">
                            <small>Performance</small>
                            <h3>Otimização técnica</h3>
                            <p>Ajustes em velocidade, organização de conteúdo e preparação para SEO técnico.</p>
                            <span class="case-more">Em breve →</span>
                        </div>
                    </article>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="section section-dark">
        <div class="container">
            <div class="section-title">
                <div class="small">Depoimentos</div>
                <h2>O que nossos clientes percebem na prática</h2>
                <p>Mais clareza, mais presença e uma estrutura digital mais profissional.</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial">
                    <p>“A comunicação ficou mais clara e o site passou a transmitir muito mais confiança.”</p>
                    <strong>Cliente local</strong>
                    <span>Prestador de serviços</span>
                </div>

                <div class="testimonial">
                    <p>“Conseguimos organizar melhor nossa presença no Google e nas redes.”</p>
                    <strong>Empresa parceira</strong>
                    <span>Comércio local</span>
                </div>

                <div class="testimonial">
                    <p>“O diagnóstico ajudou a enxergar pontos que estavam prejudicando nossa presença digital.”</p>
                    <strong>Negócio analisado</strong>
                    <span>Serviços profissionais</span>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter" id="newsletter">
        <div class="container newsletter-inner">
            <div>
                <h2>Receba dicas para melhorar sua presença digital.</h2>
                <p>Conteúdos práticos sobre Google, sites, SEO Local e estratégias digitais para pequenos negócios.</p>
            </div>

            <form class="newsletter-form" action="#" method="post">
                <input type="email" name="email" placeholder="Digite seu e-mail" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </section>
</main>

<?php
get_footer();
