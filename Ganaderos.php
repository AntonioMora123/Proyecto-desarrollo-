
<?php

// CONEXION
require_once "conexion.php";

// CONSULTA
$consulta = "SELECT * FROM Ganaderos";

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
        Ganaderías Socias
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

        <!-- CARD -->
        <div class="card">

            <!-- TITULO -->
            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                flex-wrap:wrap;
                gap:20px;
                margin-bottom:30px;
            ">

                <div>

                    <h2>
                        Ganaderías Socias
                    </h2>

                    <p>
                        Administración y consulta de socios ganaderos registrados.
                    </p>

                </div>

                <!-- BOTONES -->
                <div style="
                    display:flex;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <a href="NuevoGanadero.php">

                        <button type="button">

                            + Nuevo Socio

                        </button>

                    </a>

                    <a href="EliminarGanadero.php">

                        <button
                            type="button"
                            class="btn-danger">

                            Eliminar Socio

                        </button>

                    </a>

                </div>

            </div>

            <!-- TABLA -->
            <div style="overflow-x:auto;">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Compra Ganado
                            </th>

                            <th>
                                Nombre del Socio
                            </th>

                            <th>
                                Ganadería
                            </th>

                            <th>
                                Domicilio
                            </th>

                            <th>
                                Localidad
                            </th>

                            <th>
                                Municipio
                            </th>

                            <th>
                                Estado
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $guardar->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row['IdGanadero']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['IdCompraGanado']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Nombre']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['RazonSocial']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Domicilio']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Localidad']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Municipio']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Estado']); ?>
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

