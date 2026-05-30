<?php
// 1. Iniciar sesión DE INMEDIATO en la línea 1 y 2
session_start();

// 2. Procesar el formulario ANTES de pintar el HTML 
// Esto evita errores de redirección ("headers already sent") al iniciar sesión con éxito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Boton"])) {
    
    // Conexión a la base de datos
    require_once "conexion.php";

    if (empty($_POST["Nombre"]) || empty($_POST["Clave"])) {
        $error_msg = "Todos los campos son obligatorios.";
    } else {
        $usuario = mysqli_real_escape_string($conexion, $_POST["Nombre"]);
        $clave = mysqli_real_escape_string($conexion, $_POST["Clave"]);

        // Consulta preparada
        $sql = $conexion->prepare("SELECT * FROM empleados WHERE Nombre = ? AND Clave = ?");
        $sql->bind_param("ss", $usuario, $clave);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['usuario'] = $usuario;
            // Al estar aquí arriba, el redireccionamiento funcionará perfecto y sin errores
            header("Location: Administradores.php");
            exit();
        } else {
            $error_msg = "El usuario o contraseña son incorrectos.";
        }
    }
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image/jpg" href="image/toro1.jpg">
</head>

<body class="login-container">

    <div class="login-box">

        <div style="text-align: center; margin-bottom: 25px;">
            <h1>GANADERÍA EL ROSARIO</h1>
            <p style="opacity: 0.8; font-size: 0.95rem;">Sistema de Gestión Ganadera</p>
        </div>

        <?php if (isset($error_msg)): ?>
            <div class="alert-danger">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="Login.php" style="box-shadow: none; padding: 0; border-radius: 0;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; gap: 15px;">
                <h2>Iniciar Sesión</h2>
                <a href="Inicio.html">
                    <button type="button" class="btn-secondary">Regresar</button>
                </a>
            </div>

            <label for="Nombre">Usuario</label>
            <input type="text" id="Nombre" name="Nombre" placeholder="Ingrese su usuario" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="Clave" placeholder="Ingrese su contraseña" required>

            <button type="submit" name="Boton" style="width: 100%;">Ingresar</button>

        </form>

    </div>

</body>
</html>