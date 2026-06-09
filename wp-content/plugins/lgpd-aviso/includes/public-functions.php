<?php

// Cria o shortcode para exibir o documento LGPD
function lgpd_exibir_documento_shortcode($atts) {
    $atts = shortcode_atts(
        [
            'tipo' => '', // Tipo de negócio (ex: 'pizzaria', 'confeitaria', etc.)
        ],
        $atts
    );

    if (empty($atts['tipo'])) {
        return 'Tipo de negócio não especificado.';
    }

    $documentos = get_option('lgpd_documentos');
    if (!isset($documentos[$atts['tipo']])) {
        return 'Documento não encontrado para este tipo de negócio.';
    }

    return '<a href="' . esc_url($documentos[$atts['tipo']]) . '" target="_blank">Leia a Política de Privacidade/LGPD</a>';
}

add_shortcode('lgpd_documento', 'lgpd_exibir_documento_shortcode');
