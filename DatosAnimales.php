
<?php

// CONEXION
require_once "conexion.php";

// CONSULTA
$consulta = "

    SELECT 
        c.N_Reemo,
        c.Motivo,
        a.NumeroArete,
        a.Sexo,
        a.Meses,
        a.Fierro,
        a.Clasificacion

    FROM animales a

    JOIN compraganado c
    ON a.idCompraGanado = c.idCompraGanado

";

// EJECUTAR CONSULTA
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
        Animales
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

        <!-- CARD -->
        <div class="card">

            <!-- TITULO -->
            <div style="
                margin-bottom:30px;
            ">

                <h2>
                    Registro de Animales
                </h2>

                <p>
                    Consulta general de animales registrados dentro de la ganadería.
                </p>

            </div>

            <!-- TABLA -->
            <div style="overflow-x:auto;">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Reemo
                            </th>

                            <th>
                                Número de Arete
                            </th>

                            <th>
                                Motivo
                            </th>

                            <th>
                                Sexo
                            </th>

                            <th>
                                Edad (Meses)
                            </th>

                            <th>
                                Clasificación
                            </th>

                            <th>
                                Fierros
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $guardar->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row['N_Reemo']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['NumeroArete']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Motivo']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Sexo']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Meses']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Clasificacion']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Fierro']); ?>
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

