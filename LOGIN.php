
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Iniciar Sesión
    </title>

    <link
        rel="stylesheet"
        href="styles/global.css">

    <link
        rel="icon"
        type="image/jpg"
        href="image/toro1.jpg">

</head>

<body class="login-page">

    <!-- CONTENEDOR LOGIN -->
    <div class="login-wrapper">

        <!-- CARD -->
        <div class="login-card">

            <!-- ENCABEZADO -->
            <div class="login-header">

                <h1>
                    GANADERÍA EL ROSARIO
                </h1>

                <p>
                    Sistema de Gestión Ganadera
                </p>

            </div>

            <!-- FORMULARIO -->
            <form
                method="POST"
                action="Login.php">

                <!-- TITULO -->
                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:30px;
                    gap:15px;
                ">

                    <h2>
                        Iniciar Sesión
                    </h2>

                    <a href="Inicio.html">

                        <button
                            type="button"
                            class="btn-secondary">

                            Regresar

                        </button>

                    </a>

                </div>

                <!-- USUARIO -->
                <label for="Nombre">
                    Usuario
                </label>

                <input
                    type="text"
                    id="Nombre"
                    name="Nombre"
                    placeholder="Ingrese su usuario"
                    required>

                <!-- CONTRASEÑA -->
                <label for="password">
                    Contraseña
                </label>

                <input
                    type="password"
                    id="password"
                    name="Clave"
                    placeholder="Ingrese su contraseña"
                    required>

                <!-- BOTON -->
                <button
                    type="submit"
                    name="Boton">

                    Ingresar

                </button>

            </form>

        </div>

    </div>

</body>

</html>

<?php

// VALIDAR LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CONEXION
    require_once "conexion.php";

    if (isset($_POST["Boton"])) {

        // VALIDAR CAMPOS
        if (
            empty($_POST["Nombre"]) ||
            empty($_POST["Clave"])
        ) {

            echo "
            <div class='container'>
                <div class='alert-danger'>
                    Todos los campos son obligatorios.
                </div>
            </div>
            ";

        } else {

            // DATOS
            $usuario = mysqli_real_escape_string(
                $conexion,
                $_POST["Nombre"]
            );

            $clave = mysqli_real_escape_string(
                $conexion,
                $_POST["Clave"]
            );

            // CONSULTA
            $sql = $conexion->prepare("
                SELECT *
                FROM empleados
                WHERE Nombre = ?
                AND Clave = ?
            ");

            $sql->bind_param(
                "ss",
                $usuario,
                $clave
            );

            $sql->execute();

            $result = $sql->get_result();

            // VALIDAR LOGIN
            if ($result->num_rows > 0) {

                $_SESSION['usuario'] = $usuario;

                header("Location: Administradores.php");

                exit();

            } else {

                echo "
                <div class='container'>
                    <div class='alert-danger'>
                        El usuario o contraseña son incorrectos.
                    </div>
                </div>
                ";
            }
        }
    }

    // CERRAR CONEXION
    $conexion->close();
}

?>

