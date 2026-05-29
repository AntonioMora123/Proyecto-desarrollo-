
<?php

// CONEXION
require_once "conexion.php";

// OBTENER MEDICAMENTOS
$medicamentos = [];

$query = "
    SELECT
        Nombre,
        Cantidad,
        PrecioPorUnidad
    FROM almacen
    WHERE unidades = 'Ml'
";

$resultado = mysqli_query(
    $conexion,
    $query
);

// GUARDAR MEDICAMENTOS
if ($resultado) {

    while ($fila = mysqli_fetch_assoc($resultado)) {

        $medicamentos[] = $fila;
    }
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
        Tratar Animal
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

            <a href="menuTrabajadores.html">

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

        <div class="form-container">

            <form method="POST">

                <!-- TITULO -->
                <div style="
                    margin-bottom:30px;
                ">

                    <h2>
                        Tratar Animal
                    </h2>

                    <p>
                        Aplicación de medicamento al ganado registrado.
                    </p>

                </div>

                <!-- INPUTS -->
                <div>

                    <label>
                        Número de Arete
                    </label>

                    <input
                        type="number"
                        name="NumArete"
                        placeholder="Ingrese el número de arete"
                        required>

                </div>

                <div>

                    <label>
                        ID del Trabajador
                    </label>

                    <input
                        type="number"
                        name="idempleado"
                        placeholder="Ingrese el ID del trabajador"
                        required>

                </div>

                <!-- MEDICAMENTOS -->
                <div style="
                    margin-top:30px;
                ">

                    <label style="
                        margin-bottom:15px;
                        display:block;
                    ">

                        Seleccione un medicamento

                    </label>

                    <?php if (!empty($medicamentos)): ?>

                        <div style="
                            display:grid;
                            gap:15px;
                        ">

                            <?php foreach ($medicamentos as $medicamento): ?>

                                <label class="med-card">

                                    <input
                                        type="radio"
                                        name="medicamento"
                                        value="<?= $medicamento['Nombre']; ?>"
                                        required>

                                    <div>

                                        <strong>
                                            <?= $medicamento['Nombre']; ?>
                                        </strong>

                                        <p style="
                                            margin-top:5px;
                                            font-size:0.9rem;
                                            opacity:0.8;
                                        ">

                                            Disponible:
                                            <?= $medicamento['Cantidad']; ?>
                                            Ml

                                        </p>

                                    </div>

                                </label>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="alert-danger">

                            No hay medicamentos disponibles.

                        </div>

                    <?php endif; ?>

                </div>

                <!-- BOTON -->
                <div style="
                    margin-top:30px;
                ">

                    <button
                        type="submit">

                        Aplicar Tratamiento

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>

<?php

// PROCESAR FORMULARIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // DATOS
    $idEmpleado = $_POST['idempleado'];

    $numeroArete = $_POST['NumArete'];

    $nombreMedicamento = $_POST['medicamento'];

    // VALIDAR EMPLEADO
    $query = "
        SELECT *
        FROM empleados
        WHERE idEmpleado = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "i",
        $idEmpleado
    );

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows == 0) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                El empleado no existe.
            </div>
        </div>
        ";

        exit;
    }

    $stmt->close();

    // VALIDAR ANIMAL
    $query = "
        SELECT *
        FROM animales
        WHERE NumeroArete = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "i",
        $numeroArete
    );

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows == 0) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                El número de arete no existe.
            </div>
        </div>
        ";

        exit;
    }

    $stmt->close();

    // OBTENER MEDICAMENTO
    $query = "
        SELECT
            Cantidad,
            PrecioPorUnidad
        FROM almacen
        WHERE Nombre = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "s",
        $nombreMedicamento
    );

    $stmt->execute();

    $stmt->bind_result(
        $cantidadDisponible,
        $precioUnidad
    );

    $stmt->fetch();

    $stmt->close();

    // VALIDAR STOCK
    if ($cantidadDisponible < 5) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                No hay suficiente medicamento disponible.
            </div>
        </div>
        ";

        exit;
    }

    // COSTO TOTAL
    $costoTotal = $precioUnidad * 5;

    // DESCONTAR MEDICAMENTO
    $nuevaCantidad = $cantidadDisponible - 5;

    $query = "
        UPDATE almacen
        SET Cantidad = ?
        WHERE Nombre = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "is",
        $nuevaCantidad,
        $nombreMedicamento
    );

    if (!$stmt->execute()) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                Error al actualizar medicamento.
            </div>
        </div>
        ";

        exit;
    }

    $stmt->close();

    // OBTENER GANANCIA ACTUAL
    $gananciaActual = 0;

    $query = "
        SELECT Ganancia
        FROM animales
        WHERE NumeroArete = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "i",
        $numeroArete
    );

    $stmt->execute();

    $stmt->bind_result($gananciaActual);

    $stmt->fetch();

    $stmt->close();

    // ACTUALIZAR GANANCIA
    $nuevaGanancia = $gananciaActual + $costoTotal;

    $query = "
        UPDATE animales
        SET Ganancia = ?
        WHERE NumeroArete = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "di",
        $nuevaGanancia,
        $numeroArete
    );

    if ($stmt->execute()) {

        echo "
        <div class='container'>
            <div class='alert-success'>
                Tratamiento aplicado correctamente.
            </div>
        </div>
        ";

    } else {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                Error al actualizar la ganancia.
            </div>
        </div>
        ";
    }

    $stmt->close();

    // CERRAR CONEXION
    mysqli_close($conexion);
}

?>

