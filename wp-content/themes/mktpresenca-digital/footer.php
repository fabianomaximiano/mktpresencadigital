<?php
/**
 * Footer principal do tema MKT Presença Digital.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>MKT Presença <span>Digital</span></h3>
                <p>
                    Soluções digitais para empresas que desejam melhorar sua presença online,
                    aparecer melhor no Google e gerar mais oportunidades.
                </p>
            </div>

            <div class="footer-col">
                <h4>Links</h4>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'footer-menu',
                    'fallback_cb'    => 'mktpd_footer_menu_fallback',
                    'depth'          => 1,
                ));
                ?>
            </div>

            <div class="footer-col">
                <h4>Serviços</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/servicos/')); ?>">Criação de Sites</a></li>
                    <li><a href="<?php echo esc_url(home_url('/servicos/')); ?>">SEO Local</a></li>
                    <li><a href="<?php echo esc_url(home_url('/servicos/')); ?>">Google Meu Negócio</a></li>
                    <li><a href="<?php echo esc_url(home_url('/servicos/')); ?>">Diagnóstico Digital</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contato</h4>
                <p>São Paulo, Osasco e Guarulhos</p>
                <p>
                    <a href="mailto:contato@mktpresencadigital.com.br">
                        contato@mktpresencadigital.com.br
                    </a>
                </p>
                <p>
                    <a href="<?php echo esc_url(home_url('/contato/')); ?>">
                        Fale conosco
                    </a>
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            © <?php echo esc_html(date('Y')); ?> MKT Presença Digital. Todos os direitos reservados.
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
