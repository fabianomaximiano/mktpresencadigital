<?php
/**
 * Enfileiramento de assets do tema.
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_enqueue_assets() {
    $theme_uri = get_template_directory_uri();

    wp_enqueue_style(
        'mktpd-bootstrap',
        $theme_uri . '/assets/vendor/bootstrap/css/bootstrap.min.css',
        array(),
        '4.6.2'
    );

    wp_enqueue_style(
        'mktpd-fontawesome',
        $theme_uri . '/assets/vendor/fontawesome/css/all.min.css',
        array(),
        '6.7.2'
    );

    wp_enqueue_style(
        'mktpd-header',
        $theme_uri . '/assets/css/header.css',
        array('mktpd-bootstrap', 'mktpd-fontawesome'),
        '1.0.0'
    );

    if (is_front_page()) {
        wp_enqueue_style(
            'mktpd-front-end',
            $theme_uri . '/assets/css/front-end.css',
            array('mktpd-header'),
            '1.0.0'
        );

        mktpd_enqueue_home_dynamic_styles();
    }

    wp_enqueue_style(
        'mktpd-footer',
        $theme_uri . '/assets/css/footer.css',
        array('mktpd-header'),
        '1.0.0'
    );

    wp_enqueue_script(
        'mktpd-jquery',
        $theme_uri . '/assets/vendor/jquery/jquery.min.js',
        array(),
        '3.7.1',
        true
    );

    wp_enqueue_script(
        'mktpd-bootstrap',
        $theme_uri . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        array('mktpd-jquery'),
        '4.6.2',
        true
    );

    wp_enqueue_script(
        'mktpd-header',
        $theme_uri . '/assets/js/header.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'mktpd_enqueue_assets');

function mktpd_enqueue_home_dynamic_styles() {
    if (!is_front_page()) {
        return;
    }

    $dynamic_images = array(
        '.hero' => array(
            'theme_mod' => 'mktpd_home_hero_image',
            'overlay'   => 'linear-gradient(90deg, rgba(0,0,0,.78), rgba(0,0,0,.44), rgba(0,0,0,.72))',
        ),
        '.about-image' => array(
            'theme_mod' => 'mktpd_home_about_image',
            'overlay'   => 'linear-gradient(rgba(0,0,0,.08), rgba(0,0,0,.1))',
        ),
        '.stats' => array(
            'theme_mod' => 'mktpd_home_stats_image',
            'overlay'   => 'linear-gradient(rgba(13,15,20,.92), rgba(13,15,20,.92))',
        ),
    );

    $custom_css = '';

    foreach ($dynamic_images as $selector => $config) {
        $image_url = get_theme_mod($config['theme_mod']);

        if (empty($image_url)) {
            continue;
        }

        $custom_css .= sprintf(
            "%s { background-image: %s, url('%s'); }\n",
            $selector,
            $config['overlay'],
            esc_url($image_url)
        );
    }

    if (!empty($custom_css)) {
        wp_add_inline_style('mktpd-front-end', $custom_css);
    }
}
