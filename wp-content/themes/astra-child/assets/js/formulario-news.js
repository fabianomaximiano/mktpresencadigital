document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('formularioNews');
    const nomeInput = document.getElementById('NomeCompleto');
    const emailInput = document.getElementById('Seuemail');
    const mensagemResposta = document.getElementById('mensagemResposta');

    
    
  
    formulario.addEventListener('submit', function (e) {
      e.preventDefault();
  
      let valido = true;
      mensagemResposta.innerHTML = ''; // limpa mensagem
  
      // Reset classes de validação
      nomeInput.classList.remove('is-invalid', 'is-valid');
      emailInput.classList.remove('is-invalid', 'is-valid');

      //alert('passou aqui');

      // Validação do nome
      if (nomeInput.value.trim() === '') {
        nomeInput.classList.add('is-invalid');
        valido = false;
      } else {
        nomeInput.classList.add('is-valid');
      }
      //alert('passou aqui 01');
      // Validação do email
      if (emailInput.value.trim() === '' || !isValidEmail(emailInput.value.trim())) {
        emailInput.classList.add('is-invalid');
        valido = false;
      } else {
        emailInput.classList.add('is-valid');
      }
      //alert('passou aqui 02');
      if (!valido) {
        return;
      }
  
      //console.log("Nome:", nomeInput.value);
      //console.log("Email:", emailInput.value);

      // Dados para envio
      const data = {
        nome: nomeInput.value,
        email: emailInput.value,
        action: 'processar_meu_formulario',
        meu_nonce: meu_formulario.nonce
      };
     //alert(`${data.data}`);
      fetch(meu_formulario.ajaxurl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: new URLSearchParams(data).toString()
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          mensagemResposta.innerHTML = `<div class="alert alert-success">${data.data}</div>`;
          formulario.reset();
          nomeInput.classList.remove('is-valid');
          emailInput.classList.remove('is-valid');
        } else {
          //mensagemResposta.innerHTML = `<div class="alert alert-danger">${data.data}</div>`;
          console.log('Resposta do servidor:', data);
          mensagemResposta.innerHTML = `<div class="alert alert-danger">${data.data || 'Ocorreu um erro.'}</div>`;

        }
      })
      .catch(error => {
        mensagemResposta.innerHTML = `<div class="alert alert-danger">Erro ao enviar: ${error.message}</div>`;
      });
    });
  
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  });
  