document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formulario-contato');
    const resposta = document.getElementById('resposta-formulario');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const formData = new FormData(form);
        formData.append('action', 'enviar_formulario_contato');
        formData.append('nonce', formularioContatoVars.nonce);

        resposta.innerHTML = '<div class="alert alert-info">Enviando mensagem...</div>';

        fetch(formularioContatoVars.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                resposta.innerHTML = '<div class="alert alert-success">' + data.data.message + '</div>';
                form.reset();
                form.classList.remove('was-validated');
            } else {
                resposta.innerHTML = '<div class="alert alert-danger">' + data.data.message + '</div>';
            }
        })
        .catch(error => {
            console.error(error);
            resposta.innerHTML = '<div class="alert alert-danger">Erro inesperado. Tente novamente.</div>';
        });
    });
});
