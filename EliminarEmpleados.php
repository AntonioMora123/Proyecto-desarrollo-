
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
        Eliminar Empleado
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

            <a href="Empleados.php">

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
                        Eliminar Empleado
                    </h2>

                    <p>
                        Ingrese el ID del empleado que desea eliminar.
                    </p>

                </div>

                <!-- INPUT -->
                <div>

                    <label for="IdEmpleado">
                        ID del Empleado
                    </label>

                    <input
                        type="number"
                        name="IdEmpleado"
                        id="IdEmpleado"
                        placeholder="Ingrese el ID"
                        required>

                </div>

                <!-- BOTON -->
                <div style="
                    margin-top:30px;
                ">

                    <button
                        type="submit"
                        class="btn-danger">

                        Eliminar Empleado

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>

<?php

// ELIMINAR EMPLEADO
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // DATOS
    $IdEmpleado = $_POST['IdEmpleado'];

    // PREPARAR CONSULTA
    $stmt = $conexion->prepare("
        DELETE FROM Empleados
        WHERE IdEmpleado = ?
    ");

    if ($stmt) {

        $stmt->bind_param(
            "i",
            $IdEmpleado
        );

        // EJECUTAR
        if ($stmt->execute()) {

            // VALIDAR SI EXISTE
            if ($stmt->affected_rows > 0) {

                echo "
                <div class='container'>
                    <div class='alert-success'>
                        Empleado eliminado correctamente.
                    </div>
                </div>
                ";

            } else {

                echo "
                <div class='container'>
                    <div class='alert-danger'>
                        No se encontró un empleado con ese ID.
                    </div>
                </div>
                ";
            }

        } else {

            echo "
            <div class='container'>
                <div class='alert-danger'>
                    Error al eliminar:
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

