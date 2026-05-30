
<?php

// CONEXION
require_once "conexion.php";

// CONSULTA
$consulta = "SELECT * FROM ventaganado";

$guardar = $conexion->query($consulta);

// VALIDAR CONSULTA
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
        Reporte de Ventas
    </title>

    <link
        rel="stylesheet"
        href="styles/global.css">

    <link
        rel="icon"
        type="image/jpg"
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

            <h1>
                GANADERÍA EL ROSARIO
            </h1>

            <a href="Administradores.php">

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

        <!-- CARD PRINCIPAL -->
        <div class="card">

            <!-- TITULO -->
            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:25px;
                flex-wrap:wrap;
                gap:10px;
            ">

                <div>

                    <h2>
                        Reporte de Ventas
                    </h2>

                    <p>
                        Consulta general de ventas registradas.
                    </p>

                </div>

            </div>

            <!-- TABLA -->
            <div style="overflow-x:auto;">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID Venta
                            </th>

                            <th>
                                Reemo
                            </th>

                            <th>
                                Destino
                            </th>

                            <th>
                                Tipo de Venta
                            </th>

                            <th>
                                Peso Venta
                            </th>

                            <th>
                                Precio Venta
                            </th>

                            <th>
                                Ganancia
                            </th>

                            <th>
                                Fecha Venta
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $guardar->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row['idVenta']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['N_Reemo']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Destino']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['TipoVenta']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['PesoVenta']); ?>
                                </td>

                                <td>
                                    $
                                    <?php echo htmlspecialchars($row['PrecioVenta']); ?>
                                </td>

                                <td>
                                    $
                                    <?php echo htmlspecialchars($row['Ganancia']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['FechaVenta']); ?>
                                </td>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>

<?php

// CERRAR CONEXION
$conexion->close();

?>

