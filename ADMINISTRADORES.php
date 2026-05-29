
<?php

// CONEXION
require_once "conexion.php";

// CONSULTA
$consulta = "SELECT * FROM Empleados";

$guardar = $conexion->query($consulta);

if (!$guardar) {

    die(
        "Error en la consulta: " .
        $conexion->error
    );
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Panel Administrativo
    </title>

    <link
        rel="stylesheet"
        href="styles/global.css">

    <link
        rel="icon"
        type="image/jpeg"
        href="image/toro1.jpg">

</head>

<body>

    <!-- HEADER -->
    <header>

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:15px;
        ">

            <div>

                <h1>
                    GANADERÍA EL ROSARIO
                </h1>

                <p>
                    Panel administrativo del sistema ganadero.
                </p>

            </div>

            <a href="Inicio.html">

                <button
                    type="button"
                    class="btn-secondary">

                    Regresar

                </button>

            </a>

        </div>

    </header>

    <!-- CONTENIDO -->
    <div class="container">

        <!-- TITULO -->
        <div style="
            margin-bottom:35px;
        ">

            <h2>
                Administración General
            </h2>

            <p>
                Seleccione un módulo para gestionar la información.
            </p>

        </div>

        <!-- TARJETAS -->
        <div class="dashboard-grid">

            <!-- ANIMALES -->
            <a
                href="DatosAnimales.php"
                class="dashboard-card">

                <img
                    src="image/toro1.jpg"
                    alt="Animales">

                <h3>
                    Animales
                </h3>

                <p>
                    Consultar información del ganado.
                </p>

            </a>

            <!-- EMPLEADOS -->
            <a
                href="Empleados.php"
                class="dashboard-card">

                <img
                    src="image/Trabajadores.jpg"
                    alt="Trabajadores">

                <h3>
                    Trabajadores
                </h3>

                <p>
                    Gestionar empleados y personal.
                </p>

            </a>

            <!-- INVENTARIO -->
            <a
                href="InventarioAlmacen.php"
                class="dashboard-card">

                <img
                    src="image/almacen.jpg"
                    alt="Inventario">

                <h3>
                    Inventario
                </h3>

                <p>
                    Control de suministros y almacén.
                </p>

            </a>

            <!-- GANADEROS -->
            <a
                href="Ganaderos.php"
                class="dashboard-card">

                <img
                    src="image/ganaderos.jpg"
                    alt="Ganaderos">

                <h3>
                    Ganaderías Socias
                </h3>

                <p>
                    Administración de socios ganaderos.
                </p>

            </a>

            <!-- VENTAS -->
            <a
                href="ReporteVentas.php"
                class="dashboard-card">

                <img
                    src="image/ventaanimal.jpg"
                    alt="Ventas">

                <h3>
                    Reporte de Ventas
                </h3>

                <p>
                    Visualizar ventas registradas.
                </p>

            </a>

            <!-- COMPRAS -->
            <a
                href="ReporteCompras.php"
                class="dashboard-card">

                <img
                    src="image/compraanimal.jpg"
                    alt="Compras">

                <h3>
                    Reporte de Compras
                </h3>

                <p>
                    Historial de compras de ganado.
                </p>

            </a>

        </div>

    </div>

</body>

</html>

<?php

// CERRAR CONEXION
$conexion->close();

?>

