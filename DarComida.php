
<?php

// CONEXION
require_once "conexion.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Dar Alimento
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

            <form action="" method="POST">

                <!-- TITULO -->
                <div style="
                    margin-bottom:30px;
                ">

                    <h2>
                        Dar Alimento
                    </h2>

                    <p>
                        Registro de alimentación del ganado.
                    </p>

                </div>

                <!-- INPUTS -->
                <div>

                    <label>
                        Número de Arete
                    </label>

                    <input
                        type="number"
                        id="arete"
                        name="NumeroArete"
                        placeholder="Ingrese el número de arete"
                        required>

                </div>

                <div>

                    <label>
                        ID del Trabajador
                    </label>

                    <input
                        type="number"
                        id="idEmpleado"
                        name="idEmpleado"
                        placeholder="Ingrese el ID del trabajador"
                        required>

                </div>

                <!-- OPCIONES DE ALIMENTO -->
                <div style="
                    margin-top:30px;
                ">

                    <label style="
                        display:block;
                        margin-bottom:15px;
                    ">

                        Seleccione el tipo de alimento

                    </label>

                    <div class="food-grid">

                        <label class="food-card">

                            <input
                                type="radio"
                                name="Opcion"
                                value="comida1"
                                required>

                            <div>

                                <strong>
                                    Abasto
                                </strong>

                                <p>
                                    Alimentación básica
                                </p>

                            </div>

                        </label>

                        <label class="food-card">

                            <input
                                type="radio"
                                name="Opcion"
                                value="comida2">

                            <div>

                                <strong>
                                    Inicio
                                </strong>

                                <p>
                                    Desarrollo inicial
                                </p>

                            </div>

                        </label>

                        <label class="food-card">

                            <input
                                type="radio"
                                name="Opcion"
                                value="comida3">

                            <div>

                                <strong>
                                    Desarrollo
                                </strong>

                                <p>
                                    Crecimiento del ganado
                                </p>

                            </div>

                        </label>

                        <label class="food-card">

                            <input
                                type="radio"
                                name="Opcion"
                                value="comida4">

                            <div>

                                <strong>
                                    Engorda
                                </strong>

                                <p>
                                    Incremento de peso
                                </p>

                            </div>

                        </label>

                        <label class="food-card">

                            <input
                                type="radio"
                                name="Opcion"
                                value="comida5">

                            <div>

                                <strong>
                                    Finalización
                                </strong>

                                <p>
                                    Preparación final
                                </p>

                            </div>

                        </label>

                    </div>

                </div>

                <!-- BOTON -->
                <div style="
                    margin-top:30px;
                ">

                    <button type="submit">

                        Alimentar Animal

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
    $idEmpleado = filter_input(
        INPUT_POST,
        'idEmpleado',
        FILTER_SANITIZE_STRING
    );

    $idAnimal = filter_input(
        INPUT_POST,
        'NumeroArete',
        FILTER_SANITIZE_STRING
    );

    $tipoAlimento = filter_input(
        INPUT_POST,
        'Opcion',
        FILTER_SANITIZE_STRING
    );

    // VALIDAR CAMPOS
    if (
        empty($idEmpleado) ||
        empty($idAnimal) ||
        empty($tipoAlimento)
    ) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                Complete todos los campos.
            </div>
        </div>
        ";

        exit;
    }

    // VALIDAR OPCION
    $opcionesValidas = [
        'comida1',
        'comida2',
        'comida3',
        'comida4',
        'comida5'
    ];

    if (!in_array($tipoAlimento, $opcionesValidas)) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                Opción de alimento inválida.
            </div>
        </div>
        ";

        exit;
    }

    // FUNCION EXISTENCIA
    function verificarExistencia(
        $conexion,
        $tabla,
        $columna,
        $valor
    ) {

        $query = "
            SELECT $columna
            FROM $tabla
            WHERE $columna = ?
        ";

        $stmt = $conexion->prepare($query);

        $stmt->bind_param(
            "s",
            $valor
        );

        $stmt->execute();

        $stmt->store_result();

        $existe = $stmt->num_rows > 0;

        $stmt->close();

        return $existe;
    }

    // VALIDAR EMPLEADO
    if (
        !verificarExistencia(
            $conexion,
            "empleados",
            "idEmpleado",
            $idEmpleado
        )
    ) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                El empleado no existe.
            </div>
        </div>
        ";

        exit;
    }

    // VALIDAR ANIMAL
    if (
        !verificarExistencia(
            $conexion,
            "animales",
            "NumeroArete",
            $idAnimal
        )
    ) {

        echo "
        <div class='container'>
            <div class='alert-danger'>
                El número de arete no existe.
            </div>
        </div>
        ";

        exit;
    }

    // FORMULAS DE ALIMENTO
    $alimentos = [

        'comida1' => [
            'Rastrojo' => 9.35,
            'Maiz' => 1.1,
            'Sal' => 0.44,
            'Electrolitos' => 0.11
        ],

        'comida2' => [
            'Rastrojo' => 2.6829,
            'Maiz Roaldo' => 2.1463,
            'Soya' => 1.0731
        ],

        'comida3' => [
            'Rastrojo' => 2.1463,
            'Maiz Roaldo' => 2.1463,
            'Soya' => 1.0731
        ],

        'comida4' => [
            'Rastrojo' => 2.1890,
            'Maiz Roaldo' => 3.2835,
            'Soya' => 1.0945
        ],

        'comida5' => [
            'Rastrojo' => 2.189,
            'Maiz Roaldo' => 3.2835,
            'Zilpaterol' => 0.0013
        ]
    ];

    // CALCULAR COSTOS
    $gananciaTotal = 0;

    foreach (
        $alimentos[$tipoAlimento]
        as $nombre => $cantidad
    ) {

        // OBTENER PRECIO
        $query = "
            SELECT PrecioPorUnidad
            FROM almacen
            WHERE nombre = ?
        ";

        $stmt = $conexion->prepare($query);

        $stmt->bind_param(
            "s",
            $nombre
        );

        $stmt->execute();

        $stmt->bind_result($precioUnidad);

        $stmt->fetch();

        $stmt->close();

        // SUMAR COSTO
        if ($precioUnidad !== null) {

            $gananciaTotal += (
                $cantidad *
                $precioUnidad
            );
        }

        // ACTUALIZAR INVENTARIO
        $query = "
            UPDATE Almacen
            SET Cantidad = Cantidad - ?
            WHERE Nombre = ?
        ";

        $stmt = $conexion->prepare($query);

        $stmt->bind_param(
            "ds",
            $cantidad,
            $nombre
        );

        $stmt->execute();

        $stmt->close();
    }

    // ACTUALIZAR GANANCIA
    $query = "
        UPDATE animales
        SET Ganancia = Ganancia + ?
        WHERE NumeroArete = ?
    ";

    $stmt = $conexion->prepare($query);

    $stmt->bind_param(
        "ds",
        $gananciaTotal,
        $idAnimal
    );

    $stmt->execute();

    $stmt->close();

    echo "
    <div class='container'>
        <div class='alert-success'>
            El animal fue alimentado correctamente.
        </div>
    </div>
    ";

    // CERRAR CONEXION
    $conexion->close();
}

?>

