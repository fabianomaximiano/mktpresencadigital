<div class="fundo spaco">
<div class="container">
<form id="formulario-orcamento">
    <div class="form-group">
        <label for="NomeCompletoOrcamento">Nome Completo:</label>
        <input type="text" class="form-control" id="NomeCompletoOrcamento" name="nome" required>
        <div class="invalid-feedback" id="erroNomeCompleto"></div>
    </div>

    <div class="form-group">
        <label for="EmailOrcamento">Seu Email:</label>
        <input type="email" class="form-control" id="EmailOrcamento" name="email" required>
        <div class="invalid-feedback" id="erroEmail"></div>
    </div>

    <div class="form-group">
        <label for="TelefoneOrcamento">Telefone:</label>
        <input type="tel" class="form-control" id="TelefoneOrcamento" name="telefone">
    </div>

    <div class="form-group">
        <label for="ServicosOrcamento">Serviços de Interesse:</label>
        <select class="form-control" id="ServicosOrcamento" name="servicos[]" multiple required>
            <option value="criacao_sites">Criação de Sites e Landing Pages</option>
            <option value="seo">SEO</option>
            <option value="redes_sociais">Redes Sociais</option>
            <option value="email_marketing">Email Marketing</option>
            <option value="analise_dados">Análise de Dados e Métricas</option>
            <option value="automacao_crm">Automação e CRM</option>
        </select>
        <div class="invalid-feedback" id="erroServicos">Selecione ao menos um serviço.</div>
        <small class="form-text text-muted">Selecione um ou mais serviços desejados (Ctrl+Clique para múltiplos).</small>
    </div>

    <div class="form-group">
        <label for="DetalhesOrcamento">Detalhes Adicionais:</label>
        <textarea class="form-control" id="DetalhesOrcamento" name="detalhes" rows="5"></textarea>
    </div>

    <input type="hidden" name="action" value="processar_orcamento">
    <?php wp_nonce_field( 'orcamento_nonce', 'orcamento_nonce_field' ); ?>
    <button type="button" id="solicitarOrcamento" class="btn btn-primary">Solicitar Orçamento</button>
    <div id="mensagemRespostaOrcamento" class="mt-3"></div>
</form>
</div>
</div>

