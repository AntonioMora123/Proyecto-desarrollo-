<?php
// Configuración de la base de datos
require_once "conexion.php";


// Consultar datos
$consulta = "SELECT * FROM Empleados";
$guardar = $conexion->query($consulta);

if (!$guardar) {
    die("Error en la consulta: " . $conexion->error);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Administrativos</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image/jpeg" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
    </div>
    <div class="button-container">
        <!-- Fila 1 -->
        <div class="image-button">
            <a href="DatosAnimales.php">
                <img src="toro1.jpg" alt="Sección Trabajadores" title="Sección Trabajadores">
            </a>
            <p>Datos de los animales</p>
        </div>
        <div class="image-button">
            <a href="Empleados.php">
                <img src="Trabajadores.jpg" alt="Iniciar Sesión" title="Iniciar Sesión">
            </a>
            <p>Datos trabajadores</p>
        </div>
        <div class="image-button">
            <a href="InventarioAlmacen.php">
                <img src="almacen.jpg" alt="Registrar Nuevos Trabajadores" title="Registrar Nuevos Trabajadores">
            </a>
            <p>Inventario del almacen</p>
        </div>
        <!-- Fila 2 -->
        <div class="image-button">
            <a href="Ganaderos.php">
                <img src="ganaderos.jpg" alt="Reporte de Inventarios" title="Reporte de Inventarios">
            </a>
            <p>Ganaderias Socias</p>
        </div>
        <div class="image-button">
            <a href="ReporteVentas.php">
                <img src="ventaanimal.jpg" alt="Gestión de Animales" title="Gestión de Animales">
            </a>
            <p>Reportes de ventas</p>
        </div>
        <div class="image-button">
            <a href="ReporteCompras.php">
                <img src="compraanimal.jpg" alt="Ventas y Facturación" title="Ventas y Facturación">
            </a>
            <p>Reportes de compras</p>
        </div>
    </div>

    <!-- Botón para regresar -->
    <a href="INICIO.html" class="back-button">
        <img src="flechaatras.jpg" alt="Regresar" title="Regresar" />
    </a>
</body>
</html>
