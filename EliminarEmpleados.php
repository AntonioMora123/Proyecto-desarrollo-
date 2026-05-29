<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Empleado</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
    </div>
    <main>
        <section class="izquierda">
        </section>
        <section class="centro">
            <br><br>
            <div class="log">
                <div class="login">
                    <form method="POST" action="">
                        <br>
                        <div class="titulo">
                            <h2>Eliminar Empleado</h2>
                            <a href="Empleados.php">
                                <img src="flechaatras.jpg" alt="Botón Atrás" class="boton-atras">
                            </a>
                        </div>
                        <br>
                        <label for="IdEmpleado">ID del Empleado:</label>
                        <input type="text" name="IdEmpleado" id="IdEmpleado" required>
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        </section>
        <section class="derecha">
        </section>
    </main>
</body>
</html>

<?php 
// Configuración de la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "Ganaderia";

// Crear conexión
$conexion = new mysqli($server, $user, $pass, $db);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $IdEmpleado = $_POST['IdEmpleado'];

    
    $stmt = $conexion->prepare("DELETE FROM Empleados WHERE IdEmpleado = ?");
    if ($stmt) {
       
        $stmt->bind_param("i", $IdEmpleado);

        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Empleado eliminado exitosamente.');</script>";
            } else {
                echo "<script>alert('No se encontró un empleado con ese ID.');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar el empleado: " . $stmt->error . "');</script>";
        }

        
        $stmt->close();
    } else {
        echo "<script>alert('Error al preparar la consulta: " . $conexion->error . "');</script>";
    }
}

// Cerrar la conexión
$conexion->close();
?>
