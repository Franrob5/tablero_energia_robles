# TP - Modelado de Datos: Estaciones de Media Tensión

## 📌 Descripción del Proyecto
[cite_start]Este proyecto es la resolución del Trabajo Práctico "Modelado de Datos" para la materia Computación II (Profesor: Lucas Saclier) - Hölters Schule C.F.I.[cite: 4, 5, 6, 7, 8].

[cite_start]Consiste en un sistema web tipo SCADA que permite visualizar y monitorear una red de Estaciones de Media Tensión, integrando una base de datos relacional (MySQL/MariaDB) con un frontend interactivo[cite: 9].

## 🚀 Características Principales
* **Mapa Interactivo:** Visualización de las estaciones geolocalizadas utilizando la librería gratuita Leaflet y OpenStreetMap.
* [cite_start]**Monitoreo de Sensores:** Al seleccionar una estación en el mapa, se consultan en tiempo real los sensores asociados y su última lectura (Tensión, Corriente, Potencia, etc.)[cite: 11, 12].
* **Curva de Demanda:** Gráfico de líneas interactivo (mediante Chart.js) que representa el consumo de potencia a lo largo del día.
* **Interfaz Profesional:** Diseño responsivo en Modo Oscuro (Dark Mode) utilizando Bootstrap 5.

## 📁 Estructura del Proyecto
* `/js/app.js`: Lógica del frontend, inicialización del mapa Leaflet y gráficos Chart.js.
* `index.php`: Interfaz de usuario (Dashboard).
* `api.php`: Endpoint que procesa las peticiones del frontend y consulta a la base de datos devolviendo JSON.
* `conexion.php`: Archivo de configuración para la conexión PDO/MySQLi.
* `dump_tp_estaciones.sql`: Respaldo completo de la base de datos (estructura y registros de prueba).
* [cite_start]`consultas.sql`: Archivo con las consultas SQL requeridas en las consignas del TP[cite: 18].
* `DER_Estaciones.png`: Diagrama de Entidad-Relación del modelo.

## 🛠️ Instalación y Uso (Entorno Local)
Para correr este proyecto en tu computadora, vas a necesitar tener instalado **XAMPP** (o similar con Apache y MySQL).

1. Clonar o descargar este repositorio.
2. Copiar la carpeta del proyecto dentro del directorio `C:\xampp\htdocs\`.
3. Abrir XAMPP Control Panel e iniciar los módulos **Apache** y **MySQL**.
4. Abrir un gestor de bases de datos (como HeidiSQL o phpMyAdmin).
5. Crear una base de datos llamada `tp_estaciones` e importar el archivo `dump_tp_estaciones.sql` para cargar la estructura y los datos.
6. (Opcional) Si tu servidor MySQL tiene contraseña, editar el archivo `conexion.php` para ingresar las credenciales correctas.
7. Abrir el navegador e ingresar a: `http://localhost/nombre_de_la_carpeta/index.php`.

## 📚 Tecnologías Utilizadas
* **Backend:** PHP, MySQL (MariaDB).
* **Frontend:** HTML5, CSS3, JavaScript (Fetch API).
* **Librerías:** Bootstrap 5.3, Chart.js, Leaflet.js.
