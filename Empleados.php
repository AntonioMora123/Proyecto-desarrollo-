
<?php

// CONEXION
require_once "conexion.php";

// CONSULTA
$consulta = "SELECT * FROM Empleados";

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
        Trabajadores
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
                display:flex;
                justify-content:space-between;
                align-items:center;
                flex-wrap:wrap;
                gap:20px;
                margin-bottom:30px;
            ">

                <div>

                    <h2>
                        Tabla de Trabajadores
                    </h2>

                    <p>
                        Administración y consulta de empleados registrados.
                    </p>

                </div>

                <!-- BOTONES -->
                <div style="
                    display:flex;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <a href="Registro.php">

                        <button type="button">

                            + Nuevo Empleado

                        </button>

                    </a>

                    <a href="EliminarEmpleados.php">

                        <button
                            type="button"
                            class="btn-danger">

                            Eliminar Empleado

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
                                Nombre
                            </th>

                            <th>
                                Apellido Paterno
                            </th>

                            <th>
                                Apellido Materno
                            </th>

                            <th>
                                Género
                            </th>

                            <th>
                                Teléfono
                            </th>

                            <th>
                                Puesto
                            </th>

                            <th>
                                Salario
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $guardar->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row['idEmpleado']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Nombre']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['ApellidoP']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['ApellidoM']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Sexo']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Telefono']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['Puesto']); ?>
                                </td>

                                <td>
                                    $
                                    <?php echo htmlspecialchars($row['Salario']); ?>
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

