let map;

// Função auxiliar para exibir mensagem amigável no lugar do mapa
function exibirErroMapa(mensagem) {
    const mapElement = document.getElementById('map');
    if (mapElement) {
        mapElement.style.display = 'flex';
        mapElement.style.alignItems = 'center';
        mapElement.style.justifyContent = 'center';
        mapElement.style.backgroundColor = '#f8f9fa';
        mapElement.style.border = '1px solid #dee2e6';
        mapElement.innerHTML = `
            <div style="text-align: center; padding: 20px; color: #6c757d;">
                <p><strong>Mapa indisponível</strong></p>
                <p style="font-size: 0.9em;">${mensagem}</p>
            </div>`;
    }
}

function initMap() {
    // 1. Verifica se os dados necessários existem
    if (typeof mapa_vars === 'undefined' || !mapa_vars.endereco) {
        exibirErroMapa('Configurações do mapa não encontradas.');
        return;
    }

    const enderecoEmpresa = mapa_vars.endereco;
    const iconePersonalizadoUrl = mapa_vars.icone_url;
    const zoomNivel = parseInt(mapa_vars.zoom_nivel, 10) || 15;

    // 2. Tenta instanciar o Geocoder (pode falhar se a API Key for inválida)
    try {
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: enderecoEmpresa }, function(results, status) {
            if (status === 'OK') {
                const localizacao = results[0].geometry.location;

                map = new google.maps.Map(document.getElementById('map'), {
                    center: localizacao,
                    zoom: zoomNivel,
                    mapTypeControl: false // Opcional: limpa o visual
                });

                const marcadorConfig = {
                    position: localizacao,
                    map: map,
                    title: enderecoEmpresa,
                    animation: google.maps.Animation.BOUNCE
                };

                if (iconePersonalizadoUrl) {
                    marcadorConfig.icon = {
                        url: iconePersonalizadoUrl,
                        scaledSize: new google.maps.Size(50, 50),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(25, 50)
                    };
                }

                const marcador = new google.maps.Marker(marcadorConfig);

                marcador.addListener('click', function() {
                    if (marcador.getAnimation() !== null) {
                        marcador.setAnimation(null);
                    } else {
                        marcador.setAnimation(google.maps.Animation.BOUNCE);
                    }
                });

            } else {
                // Erro de Geocoding (ex: endereço não encontrado ou limite de cota)
                console.error('Geocode failed: ' + status);
                exibirErroMapa('Não foi possível localizar o endereço no mapa.');
            }
        });
    } catch (e) {
        // Erro crítico (ex: API do Google não carregou ou chave bloqueada)
        console.error('Google Maps API Error:', e);
        exibirErroMapa('Erro ao carregar a biblioteca do Google Maps.');
    }
}

// Opcional: Capturar erros globais de autenticação da API do Google
window.gm_authFailure = function() {
    exibirErroMapa('Erro de autenticação: Verifique a chave da API.');
};