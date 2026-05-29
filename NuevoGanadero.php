<!DOCTYPE html>
<html>
<head>
    <title>Registro Nuevo Socio</title>
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
                            <h2>Nuevo Socio</h2>
                            <a href="Ganaderos.php">
                                <img src="flechaatras.jpg" alt="Botón Atrás" class="boton-atras">
                            </a>
                        </div>
                        <br>
                        <label for="Idganado">Id compra de ganado:</label>
                        <input type="text" name="IdCompraGanado" id="Idganado" required>
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" name="Nombre" id="nombre" required>
                        <label for="razonsocial">Nombre de Ganadería:</label>
                        <input type="text" name="RazonSocial" id="razonsocial" required>
                        <label for="domicilio">Domicilio:</label>
                        <input type="text" name="Domicilio" id="domicilio" required>
                        <label for="localidad">Localidad:</label>
                        <input type="text" name="Localidad" id="localidad" required>
                        <label for="municipio">Municipio:</label>
                        <input type="text" name="Municipio" id="municipio" required>
                        <label for="estado">Estado:</label>
                        <input type="text" name="Estado" id="estado" required>
                        <button type="submit">Registrar</button>
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
    $nombre = $_POST['Nombre'];
    $razonsocial = $_POST['RazonSocial'];
    $domicilio = $_POST['Domicilio'];
    $localidad = $_POST['Localidad'];
    $municipio = $_POST['Municipio'];
    $estado = $_POST['Estado'];


    $stmt = $conexion->prepare("INSERT INTO Ganaderos (IdCompraGanado, Nombre, RazonSocial, Domicilio, Localidad, Municipio, Estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {

        $stmt->bind_param("sssssss", $Idganado, $nombre, $razonsocial, $domicilio, $localidad, $municipio, $estado);
        
       
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso');</script>";
        } else {
            echo "<script>alert('Error al registrar: " . $stmt->error . "');</script>";
        }
        
      
        $stmt->close();
    } else {
        echo "<script>alert('Error al preparar la consulta: " . $conexion->error . "');</script>";
    }
}

// Cerrar la conexión
$conexion->close();
?>
