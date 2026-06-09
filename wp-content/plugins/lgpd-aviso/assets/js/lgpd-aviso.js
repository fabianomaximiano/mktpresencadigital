// document.addEventListener('DOMContentLoaded', function() {
//     const aviso = document.getElementById('aviso-lgpd');
//     const botaoAceitar = document.getElementById('aceitar-lgpd');

//     if (!localStorage.getItem('lgpd_aceito')) {
//         aviso.style.display = 'block';
//     }

//     botaoAceitar.addEventListener('click', function() {
//         localStorage.setItem('lgpd_aceito', 'sim');
//         aviso.style.display = 'none';
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    const aviso = document.getElementById('aviso-lgpd');
    const botaoAceitar = document.getElementById('aceitar-lgpd');

    const diasValidade = 7;
    const agora = Date.now(); // timestamp atual em milissegundos
    const aceitoEm = localStorage.getItem('lgpd_aceito_em');

    let mostrarAviso = true;

    if (aceitoEm !== null) {
        const aceitoTimestamp = parseInt(aceitoEm, 10);
        const msPorDia = 24 * 60 * 60 * 1000;
        const diferencaDias = (agora - aceitoTimestamp) / msPorDia;

        if (diferencaDias < diasValidade) {
            mostrarAviso = false;
        }
    }

    if (mostrarAviso) {
        aviso.style.display = 'block';
    } else {
        aviso.style.display = 'none'; // garante que não apareça se já aceitou
    }

    botaoAceitar.addEventListener('click', function () {
        localStorage.setItem('lgpd_aceito_em', Date.now().toString());
        aviso.style.display = 'none';
    });
});

