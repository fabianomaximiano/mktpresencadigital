<?php
function orcamentos_editar_pagina() {
    if (!isset($_GET['id'])) {
        echo '<div class="notice notice-error"><p>ID não fornecido.</p></div>';
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'orcamentos';
    $id = intval($_GET['id']);

    // Buscar dados do orçamento
    $orcamento = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if (!$orcamento) {
        echo '<div class="notice notice-error"><p>Orçamento não encontrado.</p></div>';
        return;
    }

    // Se formulário enviado (edição ou resposta)
    if (isset($_POST['update_orcamento'])) {
        $nome = sanitize_text_field($_POST['nome']);
        $email = sanitize_email($_POST['email']);
        $telefone = sanitize_text_field($_POST['telefone']);
        $servicos = sanitize_textarea_field($_POST['servicos']);
        $detalhes = sanitize_textarea_field($_POST['detalhes']);

        $wpdb->update(
            $table_name,
            [
                'nome' => $nome,
                'email' => $email,
                'telefone' => $telefone,
                'servicos' => $servicos,
                'detalhes' => $detalhes
            ],
            ['id' => $id]
        );

        echo '<div class="notice notice-success"><p>Orçamento atualizado!</p></div>';

        // Atualizar o objeto depois de salvar
        $orcamento = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));
    }

    if (isset($_POST['responder_orcamento'])) {
        $mensagem = sanitize_textarea_field($_POST['mensagem']);
        $assunto = 'Resposta ao seu pedido de orçamento';

        wp_mail($orcamento->email, $assunto, $mensagem);

        echo '<div class="notice notice-success"><p>Resposta enviada para o cliente!</p></div>';
    }

    ?>
    <div class="wrap">
        <h1>Editar Orçamento</h1>
        <form method="post">
            <table class="form-table">
                <tr><th>Nome</th><td><input type="text" name="nome" value="<?php echo esc_attr($orcamento->nome); ?>" class="regular-text"></td></tr>
                <tr><th>Email</th><td><input type="email" name="email" value="<?php echo esc_attr($orcamento->email); ?>" class="regular-text"></td></tr>
                <tr><th>Telefone</th><td><input type="text" name="telefone" value="<?php echo esc_attr($orcamento->telefone); ?>" class="regular-text"></td></tr>
                <tr><th>Serviços</th><td><textarea name="servicos" rows="3" class="large-text"><?php echo esc_textarea($orcamento->servicos); ?></textarea></td></tr>
                <tr><th>Detalhes</th><td><textarea name="detalhes" rows="5" class="large-text"><?php echo esc_textarea($orcamento->detalhes); ?></textarea></td></tr>
            </table>
            <p>
                <input type="submit" name="update_orcamento" class="button button-primary" value="Atualizar Orçamento">
            </p>
        </form>

        <hr>

        <h2>Responder Cliente</h2>
        <form method="post">
            <textarea name="mensagem" rows="5" class="large-text" placeholder="Digite sua resposta..."></textarea>
            <p>
                <input type="submit" name="responder_orcamento" class="button button-secondary" value="Enviar Resposta">
            </p>
        </form>
    </div>
    <?php
}

