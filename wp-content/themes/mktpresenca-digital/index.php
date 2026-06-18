<?php
/**
 * Template fallback principal.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="site-main">
    <section class="section">
        <div class="container">
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('content-card'); ?>>
                        <h1><?php the_title(); ?></h1>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <div class="pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '← Anterior',
                        'next_text' => 'Próxima →',
                    ));
                    ?>
                </div>

            <?php else : ?>

                <article class="content-card">
                    <h1>Nenhum conteúdo encontrado</h1>
                    <p>Não encontramos conteúdo para exibir nesta página.</p>
                </article>

            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
