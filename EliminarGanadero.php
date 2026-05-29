<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Ganaderia</title>
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
                            <h2>Eliminar Ganaderia Socia</h2>
                            <a href="Ganaderos.php">
                                <img src="flechaatras.jpg" alt="Botón Atrás" class="boton-atras">
                            </a>
                        </div>
                        <br>
                        <label for="Idganado">Id compra de ganado:</label>
                        <input type="text" name="IdCompraGanado" id="Idganado" required>
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
    
    $Idganado = $_POST['IdCompraGanado'];

    
    $stmt = $conexion->prepare("DELETE FROM Ganaderos WHERE IdCompraGanado = ?");
    if ($stmt) {
        
        $stmt->bind_param("s", $Idganado);

        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Registro eliminado exitosamente.');</script>";
            } else {
                echo "<script>alert('No se encontró un registro con ese IdCompraGanado.');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar el registro: " . $stmt->error . "');</script>";
        }

        
        $stmt->close();
    } else {
        echo "<script>alert('Error al preparar la consulta: " . $conexion->error . "');</script>";
    }
}

// Cerrar la conexión
$conexion->close();
?>
