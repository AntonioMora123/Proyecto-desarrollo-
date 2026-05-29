
<?php
// Obtener la fecha actual en formato YYYY-MM-DD
$fecha_actual = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vender Animal</title>

    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image/jpg" href="image/toro1.jpg">
</head>

<body>

    <!-- HEADER -->
    <header>
        <h1>GANADERÍA EL ROSARIO</h1>
    </header>

    <!-- CONTENIDO -->
    <div class="container">

        <div class="form-container">

            <form action="" method="POST">

                <!-- TITULO -->
                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:25px;
                ">

                    <h2>Vender Animal</h2>

                    <a href="menuTrabajadores.html">
                        <button type="button" class="btn-secondary">
                            Regresar
                        </button>
                    </a>

                </div>

                <!-- NUMERO ARETE -->
                <label for="NumeroArete">
                    Número de Arete
                </label>

                <input
                    type="text"
                    id="NumeroArete"
                    name="NumeroArete"
                    placeholder="Ingrese el número de arete"
                    required>

                <!-- DESTINO -->
                <label for="Destino">
                    Destino
                </label>

                <input
                    type="text"
                    id="Destino"
                    name="Destino"
                    placeholder="Ingrese el destino"
                    required>

                <!-- PESO -->
                <label for="PesoVenta">
                    Peso del animal (kg)
                </label>

                <input
                    type="number"
                    id="PesoVenta"
                    name="PesoVenta"
                    min="0"
                    step="0.01"
                    placeholder="Ingrese el peso"
                    required>

                <!-- PRECIO -->
                <label for="PrecioVenta">
                    Precio por kilo ($)
                </label>

                <input
                    type="number"
                    id="PrecioVenta"
                    name="PrecioVenta"
                    min="0"
                    step="0.01"
                    placeholder="Ingrese el precio"
                    required>

                <!-- FECHA -->
                <label for="FechaVenta">
                    Fecha de Venta
                </label>

                <input
                    type="date"
                    id="FechaVenta"
                    name="FechaVenta"
                    value="<?php echo $fecha_actual; ?>"
                    required>

                <!-- TIPO -->
                <label for="TipoVenta">
                    Tipo de Venta
                </label>

                <select id="TipoVenta" name="TipoVenta" required>

                    <option value="" disabled selected>
                        Seleccione el tipo de venta
                    </option>

                    <option value="engorda">
                        Engorda
                    </option>

                    <option value="cria">
                        Cría
                    </option>

                    <option value="sacrificio">
                        Sacrificio
                    </option>

                </select>

                <!-- BOTON -->
                <button type="submit">
                    Registrar Venta
                </button>

            </form>

        </div>

    </div>

</body>

</html>

<?php

require_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener datos del formulario
    $numeroArete = $_POST['NumeroArete'];
    $destino = $_POST['Destino'];
    $tipoVenta = $_POST['TipoVenta'];
    $pesoVenta = $_POST['PesoVenta'];
    $precioVenta = $_POST['PrecioVenta'];
    $fechaVenta = $_POST['FechaVenta'];

    // Calcular precio total
    $precioTotal = $precioVenta * $pesoVenta;

    // Consulta para obtener datos
    $consultaDatos = "
        SELECT 
            c.N_Reemo,
            a.Ganancia
        FROM compraganado c
        INNER JOIN animales a
            ON c.idCompraGanado = a.idCompraGanado
        WHERE a.NumeroArete = ?
    ";

    $stmtDatos = $conexion->prepare($consultaDatos);

    if ($stmtDatos === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmtDatos->bind_param("i", $numeroArete);

    $stmtDatos->execute();

    $stmtDatos->bind_result($nReemo, $ganancia);

    $stmtDatos->fetch();

    $stmtDatos->close();

    // Validar resultados
    if ($nReemo !== null && $ganancia !== null) {

        // Calcular ganancia total
        $gananciaTotal = $precioTotal - $ganancia;

        // Insertar venta
        $stmtVenta = $conexion->prepare("
            INSERT INTO ventaganado
            (
                N_Reemo,
                Destino,
                TipoVenta,
                PesoVenta,
                PrecioVenta,
                FechaVenta,
                Ganancia
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        if ($stmtVenta === false) {
            die("Error al preparar la venta: " . $conexion->error);
        }

        $stmtVenta->bind_param(
            "issiisi",
            $nReemo,
            $destino,
            $tipoVenta,
            $pesoVenta,
            $precioVenta,
            $fechaVenta,
            $gananciaTotal
        );

        if ($stmtVenta->execute()) {

            echo "
            <div class='container'>
                <div class='alert-success'>
                    Venta registrada correctamente.
                    Ganancia total: $$gananciaTotal
                </div>
            </div>
            ";

        } else {

            echo "
            <div class='container'>
                <div class='alert-danger'>
                    Error al registrar la venta:
                    {$stmtVenta->error}
                </div>
            </div>
            ";
        }

        $stmtVenta->close();

    } else {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                No se encontró información para el número de arete proporcionado.
            </div>
        </div>
        ";
    }
}

// Cerrar conexión
$conexion->close();

?>

