<?php
/**
 * Single Projeto.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <?php
        $project_client = get_post_meta(get_the_ID(), 'mktpd_project_client', true);
        $project_website = get_post_meta(get_the_ID(), 'mktpd_project_website', true);
        $project_challenge = get_post_meta(get_the_ID(), 'mktpd_project_challenge', true);
        $project_solution = get_post_meta(get_the_ID(), 'mktpd_project_solution', true);
        $project_differential = get_post_meta(get_the_ID(), 'mktpd_project_differential', true);
        $project_services = get_post_meta(get_the_ID(), 'mktpd_project_services', true);
        ?>

        <section class="section section-light">
            <div class="container">
                <div class="section-title">
                    <div class="small">Projeto</div>
                    <h1><?php the_title(); ?></h1>
                    <?php if (!empty($project_client)) : ?>
                        <p><?php echo esc_html($project_client); ?></p>
                    <?php endif; ?>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="about-image" aria-hidden="true" style="background-image: linear-gradient(rgba(0,0,0,.08), rgba(0,0,0,.1)), url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');"></div>
                <?php endif; ?>

                <div class="about-content" style="max-width: 860px; margin: 54px auto 0;">
                    <?php the_content(); ?>

                    <?php if (!empty($project_challenge)) : ?>
                        <h2>Desafio</h2>
                        <p><?php echo nl2br(esc_html($project_challenge)); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($project_solution)) : ?>
                        <h2>Solução aplicada</h2>
                        <p><?php echo nl2br(esc_html($project_solution)); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($project_differential)) : ?>
                        <h2>Diferenciais</h2>
                        <p><?php echo nl2br(esc_html($project_differential)); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($project_services)) : ?>
                        <h2>Serviços aplicados</h2>
                        <p><?php echo nl2br(esc_html($project_services)); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($project_website)) : ?>
                        <p>
                            <a href="<?php echo esc_url($project_website); ?>" class="btn-primary" target="_blank" rel="noopener">
                                Acessar projeto
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<?php
get_footer();
