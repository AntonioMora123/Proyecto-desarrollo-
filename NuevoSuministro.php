
<?php

// CONEXION
$server = "localhost";
$user = "root";
$pass = "";
$db = "Ganaderia";

// CREAR CONEXION
$conexion = new mysqli(
    $server,
    $user,
    $pass,
    $db
);

// VALIDAR CONEXION
if ($conexion->connect_error) {

    die(
        "Conexión fallida: " .
        $conexion->connect_error
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
        Nuevo Suministro
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

            <a href="InventarioAlmacen.php">

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

            <form
                method="POST"
                action="">

                <!-- TITULO -->
                <div style="
                    margin-bottom:30px;
                ">

                    <h2>
                        Registrar Nuevo Suministro
                    </h2>

                    <p>
                        Complete la información del suministro.
                    </p>

                </div>

                <!-- GRID -->
                <div style="
                    display:grid;
                    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                    gap:20px;
                ">

                    <!-- NOMBRE -->
                    <div>

                        <label for="Nombre">
                            Nombre del suministro
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            id="Nombre"
                            placeholder="Ingrese el nombre"
                            required>

                    </div>

                    <!-- CANTIDAD -->
                    <div>

                        <label for="Cantidad">
                            Cantidad
                        </label>

                        <input
                            type="number"
                            name="cantidad"
                            id="Cantidad"
                            placeholder="Ingrese la cantidad"
                            required>

                    </div>

                    <!-- UNIDADES -->
                    <div>

                        <label for="Unidades">
                            Unidades de medición
                        </label>

                        <input
                            type="text"
                            name="unidades"
                            id="Unidades"
                            placeholder="Ejemplo: kg, litros, piezas"
                            required>

                    </div>

                    <!-- PRECIO UNITARIO -->
                    <div>

                        <label for="PrecioUnidad">
                            Precio por unidad
                        </label>

                        <input
                            type="number"
                            name="PrecioPorUnidad"
                            id="PrecioUnidad"
                            min="0"
                            step="0.01"
                            placeholder="Ingrese el precio unitario"
                            required>

                    </div>

                    <!-- PRECIO TOTAL -->
                    <div>

                        <label for="preciototal">
                            Precio total
                        </label>

                        <input
                            type="number"
                            name="PrecioTotal"
                            id="preciototal"
                            min="0"
                            step="0.01"
                            placeholder="Ingrese el precio total"
                            required>

                    </div>

                    <!-- FECHA -->
                    <div>

                        <label for="fecha">
                            Fecha
                        </label>

                        <input
                            type="date"
                            name="Fecha"
                            id="fecha"
                            value="<?php echo date('Y-m-d'); ?>"
                            required>

                    </div>

                </div>

                <!-- BOTON -->
                <div style="
                    margin-top:30px;
                ">

                    <button type="submit">

                        Registrar Suministro

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>

<?php

// REGISTRO
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // DATOS
    $Nombre = $_POST['nombre'];

    $Cantidad = $_POST['cantidad'];

    $Unidades = $_POST['unidades'];

    $PrecioUnidad = $_POST['PrecioPorUnidad'];

    $PrecioTotal = $_POST['PrecioTotal'];

    $Fecha = $_POST['Fecha'];

    // PREPARAR CONSULTA
    $stmt = $conexion->prepare("
        INSERT INTO Almacen
        (
            nombre,
            cantidad,
            unidades,
            PrecioPorUnidad,
            PrecioTotal,
            Fecha
        )
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {

        $stmt->bind_param(
            "sissds",
            $Nombre,
            $Cantidad,
            $Unidades,
            $PrecioUnidad,
            $PrecioTotal,
            $Fecha
        );

        // EJECUTAR
        if ($stmt->execute()) {

            echo "
            <div class='container'>
                <div class='alert-success'>
                    Suministro registrado correctamente.
                </div>
            </div>
            ";

        } else {

            echo "
            <div class='container'>
                <div class='alert-danger'>
                    Error al registrar:
                    {$stmt->error}
                </div>
            </div>
            ";
        }

        $stmt->close();

    } else {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                Error al preparar la consulta:
                {$conexion->error}
            </div>
        </div>
        ";
    }
}

// CERRAR CONEXION
$conexion->close();

?>

