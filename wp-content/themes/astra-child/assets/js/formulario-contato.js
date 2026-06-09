document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-contato');
    const botaoEnviar = document.getElementById('solicitar-contato');
    const mensagemResposta = document.getElementById('mensagemRespostaContato');

    const nomeInput = document.getElementById('NomeCompleto-Contato');
    const emailInput = document.getElementById('Email-Contato');
    const telefoneInput = document.getElementById('Telefone-Contato');
    const assuntoSelect = document.getElementById('assunto-contato');
    const mensagemText = document.getElementById('mensagem-contato');

    const erroNomeCompleto = document.getElementById('erroNomeCompleto');
    const erroEmail = document.getElementById('erroEmail');
    const erroTelefone = document.getElementById('erroTelefone');
    const erroAssunto = document.getElementById('erroAssunto');
    const erroMensagem = document.getElementById('erroMensagem');

    if (botaoEnviar) {
        botaoEnviar.addEventListener('click', function(event) {
            event.preventDefault();

            let isValid = true;

            // Resetar erros
            [nomeInput, emailInput, telefoneInput, assuntoSelect, mensagemText].forEach(input => input.classList.remove('is-invalid'));
            [erroNomeCompleto, erroEmail, erroTelefone, erroAssunto, erroMensagem].forEach(div => div.textContent = '');

            // Validações
            if (nomeInput.value.trim() === '') {
                isValid = false;
                nomeInput.classList.add('is-invalid');
                erroNomeCompleto.textContent = 'O nome é obrigatório.';
            }

            if (emailInput.value.trim() === '') {
                isValid = false;
                emailInput.classList.add('is-invalid');
                erroEmail.textContent = 'O email é obrigatório.';
            } else if (!isValidEmail(emailInput.value.trim())) {
                isValid = false;
                emailInput.classList.add('is-invalid');
                erroEmail.textContent = 'Email inválido.';
            }

            if (telefoneInput.value.trim() === '') {
                isValid = false;
                telefoneInput.classList.add('is-invalid');
                erroTelefone.textContent = 'O telefone é obrigatório.';
            }

            if (assuntoSelect.value === '') {
                isValid = false;
                assuntoSelect.classList.add('is-invalid');
                erroAssunto.textContent = 'Selecione um assunto.';
            }

            if (mensagemText.value.trim() === '') {
                isValid = false;
                mensagemText.classList.add('is-invalid');
                erroMensagem.textContent = 'A mensagem é obrigatória.';
            }

            if (!isValid) {
                mensagemResposta.className = 'alert alert-danger mt-3';
                mensagemResposta.textContent = 'Por favor, corrija os erros antes de enviar.';
                return;
            }

            mensagemResposta.className = 'alert alert-info mt-3';
            mensagemResposta.textContent = 'Enviando...';

            const formData = new FormData(formulario);
            formData.append('action', 'processar_contato');
            formData.append('contato_nonce_field', formularioContato.nonce);

            fetch(formularioContato.ajaxurl, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mensagemResposta.className = 'alert alert-success mt-3';
                    mensagemResposta.textContent = data.data.message;
                    formulario.reset();
                } else {
                    mensagemResposta.className = 'alert alert-danger mt-3';
                    mensagemResposta.textContent = 'Erro: ' + data.data.message;
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                mensagemResposta.className = 'alert alert-danger mt-3';
                mensagemResposta.textContent = 'Erro inesperado. Tente novamente.';
            });
        });
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
