<?php
function orcamentos_registrar_menu() {
    add_menu_page(
        'Orçamentos Recebidos',
        'Orçamentos',
        'manage_options',
        'orcamentos-recebidos',
        'orcamentos_listar_pagina',
        'dashicons-clipboard',
        6
    );
    add_submenu_page(
        null, // oculto
        'Editar Orçamento',
        'Editar',
        'manage_options',
        'orcamentos-editar',
        'orcamentos_editar_pagina'
    );
}
add_action('admin_menu', 'orcamentos_registrar_menu');

function orcamentos_listar_pagina() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'orcamentos';

    $orcamentos = $wpdb->get_results("SELECT * FROM $table_name ORDER BY data_solicitacao DESC");

    echo '<div class="wrap">';
    echo '<h1>Orçamentos Recebidos</h1>';

    if (!empty($orcamentos)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Serviços</th>
                    <th>Detalhes</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
              </thead>';
        echo '<tbody>';

        foreach ($orcamentos as $orcamento) {
            $editar_url = admin_url('admin.php?page=orcamentos-editar&id=' . $orcamento->id);
            echo '<tr>';
            echo '<td>' . esc_html($orcamento->nome) . '</td>';
            echo '<td>' . esc_html($orcamento->email) . '</td>';
            echo '<td>' . esc_html($orcamento->telefone) . '</td>';
            echo '<td>' . esc_html($orcamento->servicos) . '</td>';
            echo '<td>' . esc_html($orcamento->detalhes) . '</td>';
            echo '<td>' . esc_html(date('d/m/Y H:i', strtotime($orcamento->data_solicitacao))) . '</td>';
            echo '<td><a href="' . esc_url($editar_url) . '" class="button button-primary">Editar</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Nenhum orçamento recebido ainda.</p>';
    }

    echo '</div>';
}
