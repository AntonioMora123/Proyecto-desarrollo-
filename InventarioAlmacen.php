<?php
// Configuración de la base de datos
require_once "conexion.php";


// Consultar datos
$consulta = "SELECT * FROM almacen";
$guardar = $conexion->query($consulta);

if (!$guardar) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html> 
<html>
<head>
    <title>Inventario del Almacen</title> 
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
        <a href="ADMINISTRADORES.php">
            <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
        </a>
    </div> 
    <main>
        <section class="container">
            <h3>Inventario Almacen</h3>
            <div class="tabla">
                <div class="tres"></div>
                <div class="uno">
                    <table border="1" class="table">
                        <thead class="headtable">
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Unidad de Medida</th>
                                <th>Precio por Unidad</th>
                                <th>Precio Total</th>
                                <th>Fecha de Compra</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $guardar->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td><?php echo $row['unidades']; ?></td>
                                <td><?php echo $row['PrecioPorUnidad']; ?></td>
                                <td><?php echo $row['PrecioTotal']; ?></td>
                                <td><?php echo $row['Fecha']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="dos">
                <a href="NuevoSuministro.php">
                    <img src="agregar.jpg" alt="agregar" class="nuevo" style="width: 50px; height: 50px;">
                </a>
                </div>


            </div>
        </section>
    </main>
</body>
</html>
