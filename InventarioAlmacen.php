
<?php

// CONEXION
require_once "conexion.php";

// CONSULTA
$consulta = "SELECT * FROM almacen";

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
        Inventario de Almacén
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

            <a href="ADMINISTRADORES.php">

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
                flex-wrap:wrap;
                gap:15px;
                margin-bottom:25px;
            ">

                <div>

                    <h2>
                        Inventario de Almacén
                    </h2>

                    <p>
                        Consulta y administración de suministros registrados.
                    </p>

                </div>

                <!-- BOTON NUEVO -->
                <a href="NuevoSuministro.php">

                    <button
                        type="button">

                        + Nuevo Suministro

                    </button>

                </a>

            </div>

            <!-- TABLA -->
            <div style="overflow-x:auto;">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Cantidad
                            </th>

                            <th>
                                Unidad
                            </th>

                            <th>
                                Precio por Unidad
                            </th>

                            <th>
                                Precio Total
                            </th>

                            <th>
                                Fecha de Compra
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $guardar->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row['nombre']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['cantidad']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['unidades']); ?>
                                </td>

                                <td>
                                    $
                                    <?php echo htmlspecialchars($row['PrecioPorUnidad']); ?>
                                </td>

                                <td>
                                    $
                                    <?php echo htmlspecialchars($row['PrecioTotal']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Fecha']); ?>
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

