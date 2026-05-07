<?php
// api.php
header('Content-Type: application/json');
require 'conexion.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'estaciones') {
    // Traemos todo incluyendo el ID para poder armar el buscador
    $sql = "SELECT id_estacion, nombre, latitud, longitud, localidad FROM Estacion";
    $result = mysqli_query($conn, $sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
} 
elseif ($accion == 'consumo') {
    $sql = "SELECT M.hora, M.valor 
            FROM Medicion M 
            JOIN Sensor S ON M.id_sensor = S.id_sensor 
            WHERE S.tipo = 'Potencia' AND M.fecha = CURRENT_DATE 
            ORDER BY M.hora ASC";
    $result = mysqli_query($conn, $sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}
elseif ($accion == 'detalles') {
    // Buscamos los sensores y la última medición de la estación que elijas
    $id = intval($_GET['id_estacion']);
    $sql = "SELECT s.tipo, 
            (SELECT m.valor FROM Medicion m WHERE m.id_sensor = s.id_sensor ORDER BY m.fecha DESC, m.hora DESC LIMIT 1) as ultimo_valor,
            (SELECT m.hora FROM Medicion m WHERE m.id_sensor = s.id_sensor ORDER BY m.fecha DESC, m.hora DESC LIMIT 1) as ultima_hora
            FROM Sensor s 
            WHERE s.id_estacion = $id";
    $result = mysqli_query($conn, $sql);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}
?>