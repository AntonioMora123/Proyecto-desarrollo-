
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
        Nuevo Socio
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

            <a href="Ganaderos.php">

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
                        Registrar Nuevo Socio
                    </h2>

                    <p>
                        Complete la información del ganadero o socio.
                    </p>

                </div>

                <!-- GRID -->
                <div style="
                    display:grid;
                    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                    gap:20px;
                ">

                    <!-- ID GANADO -->
                    <div>

                        <label for="Idganado">
                            ID Compra de Ganado
                        </label>

                        <input
                            type="number"
                            name="IdCompraGanado"
                            id="Idganado"
                            placeholder="Ingrese el ID"
                            required>

                    </div>

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

                    <!-- RAZON SOCIAL -->
                    <div>

                        <label for="razonsocial">
                            Nombre de Ganadería
                        </label>

                        <input
                            type="text"
                            name="RazonSocial"
                            id="razonsocial"
                            placeholder="Ingrese la razón social"
                            required>

                    </div>

                    <!-- DOMICILIO -->
                    <div>

                        <label for="domicilio">
                            Domicilio
                        </label>

                        <input
                            type="text"
                            name="Domicilio"
                            id="domicilio"
                            placeholder="Ingrese el domicilio"
                            required>

                    </div>

                    <!-- LOCALIDAD -->
                    <div>

                        <label for="localidad">
                            Localidad
                        </label>

                        <input
                            type="text"
                            name="Localidad"
                            id="localidad"
                            placeholder="Ingrese la localidad"
                            required>

                    </div>

                    <!-- MUNICIPIO -->
                    <div>

                        <label for="municipio">
                            Municipio
                        </label>

                        <input
                            type="text"
                            name="Municipio"
                            id="municipio"
                            placeholder="Ingrese el municipio"
                            required>

                    </div>

                    <!-- ESTADO -->
                    <div>

                        <label for="estado">
                            Estado
                        </label>

                        <input
                            type="text"
                            name="Estado"
                            id="estado"
                            placeholder="Ingrese el estado"
                            required>

                    </div>

                </div>

                <!-- BOTON -->
                <div style="
                    margin-top:30px;
                ">

                    <button type="submit">

                        Registrar Socio

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
    $Idganado = $_POST['IdCompraGanado'];

    $nombre = $_POST['Nombre'];

    $razonsocial = $_POST['RazonSocial'];

    $domicilio = $_POST['Domicilio'];

    $localidad = $_POST['Localidad'];

    $municipio = $_POST['Municipio'];

    $estado = $_POST['Estado'];

    // PREPARAR CONSULTA
    $stmt = $conexion->prepare("
        INSERT INTO ganaderos
        (
            IdCompraGanado,
            Nombre,
            RazonSocial,
            Domicilio,
            Localidad,
            Municipio,
            Estado
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {

        $stmt->bind_param(
            "sssssss",
            $Idganado,
            $nombre,
            $razonsocial,
            $domicilio,
            $localidad,
            $municipio,
            $estado
        );

        // EJECUTAR
        if ($stmt->execute()) {

            echo "
            <div class='container'>
                <div class='alert-success'>
                    Socio registrado correctamente.
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

