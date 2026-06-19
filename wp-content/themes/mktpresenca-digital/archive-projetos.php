<?php
/**
 * Archive Projetos.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main>
    <section class="section section-light">
        <div class="container">
            <div class="section-title">
                <div class="small">Projetos</div>
                <h1>Projetos que fortalecem presença digital</h1>
                <p>Soluções aplicadas para melhorar presença online, autoridade e geração de oportunidades.</p>
            </div>

            <?php if (have_posts()) : ?>
                <div class="cases-grid">
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <?php
                        $project_solution = get_post_meta(get_the_ID(), 'mktpd_project_solution', true);
                        $project_terms = get_the_terms(get_the_ID(), 'segmento_projeto');
                        $project_segment = (!empty($project_terms) && !is_wp_error($project_terms)) ? $project_terms[0]->name : 'Presença Digital';
                        ?>

                        <article class="case-card">
                            <a href="<?php the_permalink(); ?>" class="case-link">
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
                                    <p><?php echo esc_html(wp_trim_words($project_solution ?: get_the_excerpt(), 22, '...')); ?></p>
                                    <span class="case-more">Ver projeto →</span>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>Nenhum projeto cadastrado no momento.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
