<?php
// Configuración de la base de datos
require_once "conexion.php";



$medicamentos = [];
$query = "SELECT Nombre, Cantidad, PrecioPorUnidad FROM almacen WHERE unidades = 'Ml'";
$resultado = mysqli_query($conexion, $query);
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $medicamentos[] = $fila;
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Tratar Animal</title> 
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
            <br>
            <br>
            <div class="log">
                <div class="login">
                    <form method="POST">
                        <br>
                        <div class="titulo">
                            <h2>Tratar Animal</h2>
                            <a href="menuTrabajadores.html">
                                <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
                            </a>
                        </div>
                        <br>
                                              
                        <label>Numero de Arete:</label>
                        <input type="text" name="NumArete" required>
                        
                        <label>Id del trabajador:</label>
                        <input type="text" name="idempleado" required>
                        
                        <h3>Seleccione un medicamento:</h3>
                        <?php if (!empty($medicamentos)): ?>
                            <?php foreach ($medicamentos as $medicamento): ?>
                                <div class="medicamento-option">
                                    <label>
                                        <input type="radio" name="medicamento" value="<?= $medicamento['Nombre']; ?>" required>
                                        <?= $medicamento['Nombre']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No hay medicamentos disponibles con unidad de medida en Ml.</p>
                        <?php endif; ?>
                        
                        <button type="submit" class="submit-button">Tratar</button> 
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idEmpleado = $_POST['idempleado'];
    $numeroArete = $_POST['NumArete'];
    $nombreMedicamento = $_POST['medicamento'];


    $query = "SELECT * FROM empleados WHERE idEmpleado = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idEmpleado);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "<div class='Mensaje'>El empleado no existe en la base de datos.</div>";
        exit;
    }
    $stmt->close();

 
    $query = "SELECT * FROM animales WHERE NumeroArete = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $numeroArete);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "<div class='Mensaje'>El número de arete no existe en la base de datos.</div>";
        exit;
    }
    $stmt->close();


    $query = "SELECT Cantidad, PrecioPorUnidad FROM almacen WHERE Nombre = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $nombreMedicamento);
    $stmt->execute();
    $stmt->bind_result($cantidadDisponible, $precioUnidad);
    $stmt->fetch();
    $stmt->close();


    if ($cantidadDisponible < 5) {
        echo "<div class='Mensaje'>No hay suficiente cantidad del medicamento seleccionado.</div>";
        exit;
    }


    $costoTotal = $precioUnidad * 5;

    // Descontar el medicamento
    $nuevaCantidad = $cantidadDisponible - 5;
    $query = "UPDATE almacen SET Cantidad = ? WHERE Nombre = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("is", $nuevaCantidad, $nombreMedicamento);
    if (!$stmt->execute()) {
        echo "<div class='Mensaje'>Error al actualizar el medicamento: " . $stmt->error . "</div>";
        exit;
    }
    $stmt->close();

    
    $gananciaActual = 0;
    $query = "SELECT Ganancia FROM animales WHERE NumeroArete = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $numeroArete);
    $stmt->execute();
    $stmt->bind_result($gananciaActual);
    $stmt->fetch();
    $stmt->close();

   
    $nuevaGanancia = $gananciaActual + $costoTotal;

    
    $query = "UPDATE animales SET Ganancia = ? WHERE NumeroArete = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("di", $nuevaGanancia, $numeroArete);
    if ($stmt->execute()) {
        echo "<div class='Mensaje'>El medicamento fue aplicado correctamente</div>";
    } else {
        echo "<div class='Mensaje'>Error al actualizar la ganancia del animal: " . $stmt->error . "</div>";
    }
    $stmt->close();

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
