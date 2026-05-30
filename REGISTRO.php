
<?php

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
        Nuevo Empleado
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

            <a href="Inicio.html">

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
                action="Registro.php">

                <!-- TITULO -->
                <div style="
                    margin-bottom:30px;
                ">

                    <h2>
                        Registrar Nuevo Empleado
                    </h2>

                    <p>
                        Complete la información del empleado.
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

                        <label for="nombre">
                            Nombre(s)
                        </label>

                        <input
                            type="text"
                            name="Nombre"
                            id="nombre"
                            placeholder="Ingrese el nombre"
                            required>

                    </div>

                    <!-- APELLIDO P -->
                    <div>

                        <label for="apellidoP">
                            Apellido Paterno
                        </label>

                        <input
                            type="text"
                            name="ApellidoP"
                            id="apellidoP"
                            placeholder="Ingrese el apellido paterno"
                            required>

                    </div>

                    <!-- APELLIDO M -->
                    <div>

                        <label for="apellidoM">
                            Apellido Materno
                        </label>

                        <input
                            type="text"
                            name="ApellidoM"
                            id="apellidoM"
                            placeholder="Ingrese el apellido materno">

                    </div>

                    <!-- GENERO -->
                    <div>

                        <label for="sexo">
                            Género
                        </label>

                        <select
                            name="Sexo"
                            id="sexo"
                            required>

                            <option value="" disabled selected>
                                Seleccione una opción
                            </option>

                            <option value="Masculino">
                                Masculino
                            </option>

                            <option value="Femenino">
                                Femenino
                            </option>

                        </select>

                    </div>

                    <!-- TELEFONO -->
                    <div>

                        <label for="telefono">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="Telefono"
                            id="telefono"
                            placeholder="Ingrese el teléfono"
                            required>

                    </div>

                    <!-- PUESTO -->
                    <div>

                        <label for="puesto">
                            Puesto
                        </label>

                        <select
                            name="Puesto"
                            id="puesto"
                            required>

                            <option value="" disabled selected>
                                Seleccione una opción
                            </option>

                            <option value="Administrativo">
                                Administrativo
                            </option>

                            <option value="Obrero">
                                Obrero
                            </option>

                            <option value="Dueño">
                                Dueño
                            </option>

                        </select>

                    </div>

                    <!-- SALARIO -->
                    <div>

                        <label for="salario">
                            Salario
                        </label>

                        <input
                            type="number"
                            name="Salario"
                            id="salario"
                            placeholder="Ingrese el salario"
                            required>

                    </div>

                    <!-- CONTRASEÑA -->
                    <div>

                        <label for="clave">
                            Nueva Contraseña
                        </label>

                        <input
                            type="password"
                            name="Clave"
                            id="clave"
                            placeholder="Ingrese la contraseña"
                            required>

                    </div>

                </div>

                <!-- BOTON -->
                <div style="
                    margin-top:30px;
                ">

                    <button type="submit">

                        Registrar Empleado

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
    $nombre = $_POST['Nombre'];

    $apellidop = $_POST['ApellidoP'];

    $apellidom = $_POST['ApellidoM'];

    $sexo = $_POST['Sexo'];

    $telefono = $_POST['Telefono'];

    $puesto = $_POST['Puesto'];

    $salario = $_POST['Salario'];

    $clave = $_POST['Clave'];

    // PREPARAR CONSULTA
    $stmt = $conexion->prepare("
        INSERT INTO Empleados
        (
            Nombre,
            ApellidoP,
            ApellidoM,
            Sexo,
            Telefono,
            Puesto,
            Salario,
            Clave
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {

        $stmt->bind_param(
            "ssssssis",
            $nombre,
            $apellidop,
            $apellidom,
            $sexo,
            $telefono,
            $puesto,
            $salario,
            $clave
        );

        // EJECUTAR
        if ($stmt->execute()) {

            echo "
            <div class='container'>
                <div class='alert-success'>
                    Empleado registrado correctamente.
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

