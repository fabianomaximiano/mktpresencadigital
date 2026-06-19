<?php
/**
 * Customizer do tema MKT Presença Digital.
 */

if (!defined('ABSPATH')) {
    exit;
}

function mktpd_customize_register($wp_customize) {
    $wp_customize->add_panel('mktpd_home_panel', array(
        'title'       => 'Home - MKT Presença Digital',
        'description' => 'Configurações principais da Home.',
        'priority'    => 30,
    ));

    $wp_customize->add_section('mktpd_home_hero_section', array(
        'title'    => 'Hero',
        'panel'    => 'mktpd_home_panel',
        'priority' => 10,
    ));

    mktpd_add_text_control($wp_customize, 'mktpd_home_hero_eyebrow', 'Chamada superior', 'Marketing, SEO e Presença Digital', 'mktpd_home_hero_section');
    mktpd_add_text_control($wp_customize, 'mktpd_home_hero_title', 'Título principal', 'Presença digital para pequenos negócios', 'mktpd_home_hero_section');

    mktpd_add_textarea_control(
        $wp_customize,
        'mktpd_home_hero_description',
        'Descrição',
        'Estratégias digitais, criação de sites, SEO Local e soluções sob medida para empresas que querem aparecer melhor no Google e conquistar mais clientes.',
        'mktpd_home_hero_section'
    );

    mktpd_add_text_control($wp_customize, 'mktpd_home_hero_primary_label', 'Texto do botão principal', 'Solicitar orçamento', 'mktpd_home_hero_section');
    mktpd_add_url_control($wp_customize, 'mktpd_home_hero_primary_url', 'URL do botão principal', home_url('/orcamento/'), 'mktpd_home_hero_section');
    mktpd_add_text_control($wp_customize, 'mktpd_home_hero_secondary_label', 'Texto do botão secundário', 'Conhecer serviços', 'mktpd_home_hero_section');
    mktpd_add_url_control($wp_customize, 'mktpd_home_hero_secondary_url', 'URL do botão secundário', home_url('/servicos/'), 'mktpd_home_hero_section');

    mktpd_add_image_control($wp_customize, 'mktpd_home_hero_image', 'Imagem de fundo do Hero', 'mktpd_home_hero_section');

    $wp_customize->add_section('mktpd_home_images_section', array(
        'title'       => 'Imagens da Home',
        'description' => 'Imagens principais da Home. Os cases serão tratados depois como Projetos/CPT.',
        'panel'       => 'mktpd_home_panel',
        'priority'    => 20,
    ));

    mktpd_add_image_control($wp_customize, 'mktpd_home_about_image', 'Imagem da seção Quem Somos', 'mktpd_home_images_section');
    mktpd_add_image_control($wp_customize, 'mktpd_home_stats_image', 'Imagem de fundo dos indicadores', 'mktpd_home_images_section');
}
add_action('customize_register', 'mktpd_customize_register');

function mktpd_add_text_control($wp_customize, $setting_id, $label, $default, $section) {
    $wp_customize->add_setting($setting_id, array(
        'default'           => $default,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control($setting_id, array(
        'label'   => $label,
        'section' => $section,
        'type'    => 'text',
    ));
}

function mktpd_add_textarea_control($wp_customize, $setting_id, $label, $default, $section) {
    $wp_customize->add_setting($setting_id, array(
        'default'           => $default,
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control($setting_id, array(
        'label'   => $label,
        'section' => $section,
        'type'    => 'textarea',
    ));
}

function mktpd_add_url_control($wp_customize, $setting_id, $label, $default, $section) {
    $wp_customize->add_setting($setting_id, array(
        'default'           => $default,
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control($setting_id, array(
        'label'   => $label,
        'section' => $section,
        'type'    => 'url',
    ));
}

function mktpd_add_image_control($wp_customize, $setting_id, $label, $section, $description = '') {
    $wp_customize->add_setting($setting_id, array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $setting_id,
        array(
            'label'       => $label,
            'description' => $description,
            'section'     => $section,
        )
    ));
}
