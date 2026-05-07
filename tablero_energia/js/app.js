// js/app.js
let mapa;
let marcadores = [];

// Le decimos a Chart.js que todas las letras sean de color claro por defecto
Chart.defaults.color = '#e0e0e0';

document.addEventListener('DOMContentLoaded', () => {
    iniciarTablero();
});

function iniciarTablero() {
    cargarMapa();
    cargarGrafico();
}

async function cargarMapa() {
    const centroGBA = [-34.5400, -58.5588]; 
    mapa = L.map('mapa').setView(centroGBA, 11);

    // MAPA MODO OSCURO (CartoDB Dark Matter)
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(mapa);

    const respuesta = await fetch('api.php?accion=estaciones');
    const estaciones = await respuesta.json();
    const buscador = document.getElementById('buscador');

    estaciones.forEach(est => {
        let option = document.createElement('option');
        option.value = est.id_estacion;
        option.text = est.nombre + ' (' + est.localidad + ')';
        buscador.appendChild(option);

        let latLng = [parseFloat(est.latitud), parseFloat(est.longitud)];
        let marker = L.marker(latLng).addTo(mapa);
        
        marker.bindTooltip(est.nombre);

        marker.on('click', () => {
            buscador.value = est.id_estacion;
            mostrarDetalles(est.id_estacion, est.nombre, latLng);
        });

        marcadores.push({ id: est.id_estacion, marker: marker, latLng: latLng, nombre: est.nombre });
    });

    buscador.addEventListener('change', function() {
        let idSeleccionado = this.value;
        if(idSeleccionado) {
            let infoEstacion = marcadores.find(m => m.id == idSeleccionado);
            mostrarDetalles(idSeleccionado, infoEstacion.nombre, infoEstacion.latLng);
        } else {
            document.getElementById('panelDetalles').classList.add('d-none');
        }
    });
}

async function mostrarDetalles(id_estacion, nombre, latLng) {
    mapa.flyTo(latLng, 14, { duration: 1.5 });

    document.getElementById('panelDetalles').classList.remove('d-none');
    document.getElementById('tituloDetalles').innerText = "Monitoreo: " + nombre;

    const respuesta = await fetch('api.php?accion=detalles&id_estacion=' + id_estacion);
    const sensores = await respuesta.json();

    const tbody = document.getElementById('tablaSensores');
    tbody.innerHTML = '';

    if(sensores.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Sin conexión a los sensores.</td></tr>';
        return;
    }

    sensores.forEach(s => {
        let valorFila = s.ultimo_valor ? s.ultimo_valor : '--';
        let horaFila = s.ultima_hora ? s.ultima_hora : '--:--:--';
        
        let unidad = '';
        if(s.tipo === 'Tensión') unidad = ' V';
        if(s.tipo === 'Corriente') unidad = ' A';
        if(s.tipo === 'Potencia') unidad = ' kW';

        // Pintamos el texto de naranja (text-warning) para que parezca un display electrónico
        tbody.innerHTML += `
            <tr>
                <td class="fw-bold">${s.tipo}</td>
                <td class="text-warning fw-bold font-monospace">${valorFila}${unidad}</td>
                <td class="font-monospace">${horaFila}</td>
            </tr>
        `;
    });
}

async function cargarGrafico() {
    const respuesta = await fetch('api.php?accion=consumo');
    const datos = await respuesta.json();

    const horas = datos.map(d => d.hora);
    const valores = datos.map(d => parseFloat(d.valor));

    const ctx = document.getElementById('graficoConsumo').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: horas,
            datasets: [{
                label: 'Demanda de Potencia (kW)',
                data: valores,
                borderColor: '#ffc107', // Amarillo alerta
                backgroundColor: 'rgba(255, 193, 7, 0.2)', // Fondo semitransparente
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#ffc107'
            }]
        },
        options: {
            scales: {
                y: { grid: { color: '#444' } }, // Rejilla oscura
                x: { grid: { color: '#444' } }
            }
        }
    });
}