document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-orcamento');
    const botaoEnviar = document.getElementById('solicitarOrcamento');
    const mensagemResposta = document.getElementById('mensagemRespostaOrcamento');
    const nomeInput = document.getElementById('NomeCompletoOrcamento');
    const emailInput = document.getElementById('EmailOrcamento');
    const servicosSelect = document.getElementById('ServicosOrcamento');
    const erroNomeCompleto = document.getElementById('erroNomeCompleto');
    const erroEmail = document.getElementById('erroEmail');
    const erroServicos = document.getElementById('erroServicos');

    if (botaoEnviar) {
        botaoEnviar.addEventListener('click', function(event) {
            event.preventDefault();

            let isValid = true;
            let errors = [];

            // Validação do Nome
            if (nomeInput.value.trim() === '') {
                isValid = false;
                erroNomeCompleto.textContent = 'O campo Nome Completo é obrigatório.';
                nomeInput.classList.add('is-invalid');
            } else {
                erroNomeCompleto.textContent = '';
                nomeInput.classList.remove('is-invalid');
            }

            // Validação do Email
            if (emailInput.value.trim() === '') {
                isValid = false;
                erroEmail.textContent = 'O campo Email é obrigatório.';
                emailInput.classList.add('is-invalid');
            } else if (!isValidEmail(emailInput.value.trim())) {
                isValid = false;
                erroEmail.textContent = 'Por favor, insira um email válido.';
                emailInput.classList.add('is-invalid');
            } else {
                erroEmail.textContent = '';
                emailInput.classList.remove('is-invalid');
            }

            // Validação dos Serviços
            if (servicosSelect.value === '') {
                isValid = false;
                erroServicos.textContent = 'Selecione ao menos um serviço de interesse.';
                servicosSelect.classList.add('is-invalid');
            } else {
                erroServicos.textContent = '';
                servicosSelect.classList.remove('is-invalid');
            }

            if (!isValid) {
                mensagemResposta.className = 'alert alert-danger mt-3';
                mensagemResposta.textContent = 'Por favor, corrija os erros listados acima.';
                return;
            } else {
                mensagemResposta.className = 'alert alert-info mt-3';
                mensagemResposta.textContent = 'Enviando sua solicitação...';
            }

            const formData = new FormData(formulario);

            fetch(ajaxurl, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mensagemResposta.className = 'alert alert-success mt-3';
                    mensagemResposta.textContent = data.message ? data.message : 'Formulário enviado com sucesso!';
                    formulario.reset();
                
                /*if (data.success) {
                    console.log(data.success);
                    mensagemResposta.className = 'alert alert-success mt-3';
                    //mensagemResposta.innerHTML = `<div class="alert alert-success mt-3">${data.message}</div>`;
                    mensagemResposta.innerText = 'mensagegem enviada com sucesso!';
                    mensagemResposta.textContent = data.message;
                    formulario.reset(); */
                    // Limpar estilos de validação e mensagens
                    erroNomeCompleto.textContent = '';
                    nomeInput.classList.remove('is-invalid');
                    erroEmail.textContent = '';
                    emailInput.classList.remove('is-invalid');
                    erroServicos.textContent = '';
                    servicosSelect.classList.remove('is-invalid');
                } else {
                    mensagemResposta.className = 'alert alert-danger mt-3';
                    mensagemResposta.textContent = 'Erro: ' + data.message;
                }
            })
            .catch(error => {
                console.error('Erro ao enviar o formulário de orçamento:', error);
                mensagemResposta.className = 'alert alert-danger mt-3';
                mensagemResposta.textContent = 'Ocorreu um erro ao enviar o formulário de orçamento.';
            });
        });
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});