<div class="container">
    <form id="formulario-contato" novalidate>
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
            <div class="invalid-feedback">Por favor, preencha seu nome.</div>
        </div>

        <div class="form-group">
            <label for="email">Seu Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">Por favor, preencha um email válido.</div>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" required>
            <div class="invalid-feedback">Por favor, preencha seu telefone.</div>
        </div>

        <div class="form-group">
            <label for="assunto">Assunto</label>
            <select class="form-control" id="assunto" name="assunto" required>
                <option value="">Selecione</option>
                <option value="Sugestão">Sugestão</option>
                <option value="Reclamação">Reclamação</option>
                <option value="Elogio">Elogio</option>
                <option value="Dúvida">Dúvida</option>
            </select>
            <div class="invalid-feedback">Por favor, selecione um assunto.</div>
        </div>

        <div class="form-group">
            <label for="mensagem">Mensagem</label>
            <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
            <div class="invalid-feedback">Por favor, escreva sua mensagem.</div>
        </div>

        <div id="resposta-formulario" class="mt-3"></div>

        <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
    </form>
</div>
