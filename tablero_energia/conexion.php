<?php
// conexion.php
$host = "localhost";
$user = "root";
$pass = ""; // Dejá esto vacío si usas XAMPP por defecto
$db   = "tp_estaciones";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión al motor: " . mysqli_connect_error());
}
?>