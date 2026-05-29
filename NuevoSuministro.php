<!DOCTYPE html>
<html>
<head>
    <title>Registro Nuevo Suministro</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
    </div>
    <main>
        <section class="izquierda"></section>
        <section class="centro">
            <br><br>
            <div class="log">
                <div class="login">
                    <form method="POST" action="">
                        <br>
                        <div class="titulo">
                            <h2>Nuevo Suministro</h2>
                            <a href="InventarioAlmacen.php">
                                <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
                            </a>
                        </div>
                        <br>
                        <label for="Nombre">Nombre del suministro:</label>
                        <input type="text" name="nombre" id="Nombre" required>
                        <label for="Cantidad">Cantidad:</label>
                        <input type="text" name="cantidad" id="Cantidad" required>
                        <label for="Unidades">Unidades de medición:</label>
                        <input type="text" name="unidades" id="Unidades" required>
                        <label for="PrecioUnidad">Precio por cada unidad:</label>
                        <input type="text" name="PrecioPorUnidad" id="PrecioUnidad" required>
                        <label for="preciototal">Precio Total:</label>
                        <input type="text" name="PrecioTotal" id="preciototal" required>
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="Fecha" id="fecha" required>
                        <button type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </section>
        <section class="derecha"></section>
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
 
    $Nombre = $_POST['nombre'];
    $Cantidad = $_POST['cantidad'];
    $Unidades = $_POST['unidades'];
    $PrecioUnidad = $_POST['PrecioPorUnidad'];
    $PrecioTotal = $_POST['PrecioTotal'];
    $Fecha = $_POST['Fecha'];

   
    $stmt = $conexion->prepare("INSERT INTO Almacen (nombre, cantidad, unidades, PrecioPorUnidad, PrecioTotal, Fecha) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
      
        $stmt->bind_param("sissds", $Nombre, $Cantidad, $Unidades, $PrecioUnidad, $PrecioTotal, $Fecha);
        
        
        if ($stmt->execute()) {
            echo "Registro completo.";
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
        
        
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>
