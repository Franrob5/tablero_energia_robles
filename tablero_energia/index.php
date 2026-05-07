<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero SCADA - Media Tensión</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        body { background-color: #121212 !important; }
        .card { background-color: #1e1e1e !important; border: 1px solid #333; }
        #mapa { height: 450px; width: 100%; border-radius: 8px; border: 2px solid #444; z-index: 1;}
        /* Estilizamos la tablita para el modo nocturno */
        .table { --bs-table-bg: transparent; --bs-table-color: #e0e0e0; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4 text-center text-warning fw-bold">CENTRO DE CONTROL ELÉCTRICO</h2>
    
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="card p-3 shadow text-center">
                <label for="buscador" class="form-label fw-bold text-light">Localizar Estación de Media Tensión:</label>
                <select id="buscador" class="form-select bg-dark text-white border-secondary">
                    <option value="">-- Seleccione una estación o haga clic en el mapa --</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card p-3 shadow mb-3">
                <h5 class="card-title text-warning">Ubicación Geográfica</h5>
                <div id="mapa"></div>
            </div>

            <div class="card p-3 shadow d-none border-warning" id="panelDetalles">
                <h5 class="card-title text-warning" id="tituloDetalles">Detalles de la Estación</h5>
                <table class="table table-hover mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>Sensor</th>
                            <th>Último Valor</th>
                            <th>Hora de Lectura</th>
                        </tr>
                    </thead>
                    <tbody id="tablaSensores"></tbody>
                </table>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-3 shadow">
                <h5 class="card-title text-warning">Curva de Demanda CAMMESA</h5>
                <canvas id="graficoConsumo"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/app.js"></script>

</body>
</html>