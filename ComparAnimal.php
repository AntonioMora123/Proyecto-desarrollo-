
<?php
require_once "conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comprar Animal</title>

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

                <!-- ENCABEZADO -->
                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:25px;
                    flex-wrap:wrap;
                    gap:15px;
                ">

                    <h2>Comprar Animal</h2>

                    <a href="menuTrabajadores.html">

                        <button
                            type="button"
                            class="btn-secondary">

                            Regresar

                        </button>

                    </a>

                </div>

                <!-- REEMO -->
                <label for="N_Reemo">
                    Reemo
                </label>

                <input
                    type="text"
                    name="N_Reemo"
                    id="N_Reemo"
                    placeholder="Ingrese el número de reemo"
                    required>

                <!-- MOTIVO -->
                <label for="Motivo">
                    Razón de compra
                </label>

                <select
                    name="Motivo"
                    id="Motivo"
                    required>

                    <option value="" disabled selected>
                        Seleccione una opción
                    </option>

                    <option value="cria">
                        Cría
                    </option>

                    <option value="engorda">
                        Engorda
                    </option>

                    <option value="sacrificio">
                        Sacrificio
                    </option>

                </select>

                <!-- FECHA -->
                <label for="Fecha">
                    Fecha de compra
                </label>

                <input
                    type="date"
                    name="Fecha"
                    id="Fecha"
                    value="<?php echo date('Y-m-d'); ?>"
                    required>

                <!-- ARETE -->
                <label for="NumeroArete">
                    Número de Arete
                </label>

                <input
                    type="text"
                    name="NumeroArete"
                    id="NumeroArete"
                    placeholder="Ingrese el número de arete"
                    pattern="\d+"
                    title="Debe ser un número"
                    required>

                <!-- SEXO -->
                <label for="Sexo">
                    Sexo del animal
                </label>

                <select
                    name="Sexo"
                    id="Sexo"
                    required>

                    <option value="" disabled selected>
                        Seleccione el sexo
                    </option>

                    <option value="masculino">
                        Macho
                    </option>

                    <option value="femenino">
                        Hembra
                    </option>

                </select>

                <!-- EDAD -->
                <label for="Meses">
                    Edad en meses
                </label>

                <input
                    type="number"
                    name="Meses"
                    id="Meses"
                    min="0"
                    placeholder="Ingrese la edad"
                    required>

                <!-- CLASIFICACION -->
                <label for="Clasificacion">
                    Clasificación
                </label>

                <select
                    name="Clasificacion"
                    id="Clasificacion"
                    required>

                    <option value="" disabled selected>
                        Seleccione una clasificación
                    </option>

                    <option value="becerro">
                        Becerro
                    </option>

                    <option value="becerra">
                        Becerra
                    </option>

                    <option value="torete">
                        Torete
                    </option>

                    <option value="vacona">
                        Vacona
                    </option>

                    <option value="toro">
                        Toro
                    </option>

                    <option value="vaca">
                        Vaca
                    </option>

                </select>

                <!-- FIERRO -->
                <label for="Fierro">
                    Fierros marcados
                </label>

                <input
                    type="number"
                    name="Fierro"
                    id="Fierro"
                    placeholder="Ingrese los fierros"
                    required>

                <!-- PESO -->
                <label for="Peso">
                    Peso en kg
                </label>

                <input
                    type="number"
                    name="Peso"
                    id="Peso"
                    min="0"
                    step="0.01"
                    placeholder="Ingrese el peso"
                    required>

                <!-- PRECIO -->
                <label for="PrecioCompra">
                    Precio por kg ($)
                </label>

                <input
                    type="number"
                    name="PrecioCompra"
                    id="PrecioCompra"
                    min="0"
                    step="0.01"
                    placeholder="Ingrese el precio"
                    required>

                <!-- BOTON -->
                <button type="submit">
                    Registrar Compra
                </button>

            </form>

        </div>

    </div>

</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // DATOS FORMULARIO
    $nReemo = $_POST['N_Reemo'];
    $motivo = $_POST['Motivo'];
    $fecha = $_POST['Fecha'];
    $numeroArete = $_POST['NumeroArete'];
    $sexo = $_POST['Sexo'];
    $meses = $_POST['Meses'];
    $clasificacion = $_POST['Clasificacion'];
    $fierro = $_POST['Fierro'];
    $peso = $_POST['Peso'];
    $precioCompra = $_POST['PrecioCompra'];

    // CALCULOS
    $precioTotal = $precioCompra * $peso;
    $ganancia = $precioTotal;

    // INICIAR TRANSACCION
    mysqli_begin_transaction($conexion);

    try {

        // INSERTAR COMPRA
        $stmtCompraganado = $conexion->prepare("
            INSERT INTO compraganado
            (
                N_Reemo,
                Motivo,
                Fecha
            )
            VALUES (?, ?, ?)
        ");

        if ($stmtCompraganado) {

            $stmtCompraganado->bind_param(
                "sss",
                $nReemo,
                $motivo,
                $fecha
            );

            $stmtCompraganado->execute();

            $idCompraGanado = $conexion->insert_id;

            $stmtCompraganado->close();

        } else {

            throw new Exception(
                "Error en compraganado: " .
                $conexion->error
            );
        }

        // INSERTAR ANIMAL
        $stmtAnimales = $conexion->prepare("
            INSERT INTO animales
            (
                NumeroArete,
                Sexo,
                Meses,
                Clasificacion,
                Fierro,
                Peso,
                PrecioCompra,
                PrecioTotal,
                Ganancia,
                idCompraGanado
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if ($stmtAnimales) {

            $stmtAnimales->bind_param(
                "ssissddddi",
                $numeroArete,
                $sexo,
                $meses,
                $clasificacion,
                $fierro,
                $peso,
                $precioCompra,
                $precioTotal,
                $ganancia,
                $idCompraGanado
            );

            $stmtAnimales->execute();

            $stmtAnimales->close();

        } else {

            throw new Exception(
                "Error en animales: " .
                $conexion->error
            );
        }

        // CONFIRMAR
        mysqli_commit($conexion);

        echo "
        <div class='container'>
            <div class='alert-success'>
                Compra y animal registrados correctamente.
            </div>
        </div>
        ";

    } catch (Exception $e) {

        // REVERTIR
        mysqli_roll_back($conexion);

        echo "
        <div class='container'>
            <div class='alert-danger'>
                Error:
                {$e->getMessage()}
            </div>
        </div>
        ";
    }

}

// CERRAR CONEXION
$conexion->close();

?>

