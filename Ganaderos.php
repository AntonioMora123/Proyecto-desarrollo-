<?php
// Configuración de la base de datos
require_once "conexion.php";



// Consultar datos
$consulta = "SELECT * FROM Ganaderos";
$guardar = $conexion->query($consulta);

if (!$guardar) {
    die("Error en la consulta: " . $conexion->error);
}
?>


<!DOCTYPE html> 
<html>
<head>
    <title>Ganaderias Socias</title> 
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image" href="toro1.jpg">
</head>
<body>
        <div class = "titulin">
            <h1>GANADERIA EL ROSARIO</h1>
            <a href="ADMINISTRADORES.php">
            <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
            </a>
        </div> 
        <main>
            <section class = "container">
                <h3>Ganaderias Socias</h3>
                <div class = "tabla">
                    <div class="tres"></div>
                    <div class="uno">
                        <table border="1" class="table">
                            <thead class="headtable">
                                <tr>
                                <th>Id Ganaderos</th>
                                <th>Id Compra Ganado</th>
                                <th>Nombre del Socio</th>
                                <th>Nombre de la Ganaderia</th>
                                <th>Domicilio</th>
                                <th>Localidad</th>
                                <th>Municipio</th>
                                <th>Estado de la Republica</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $guardar->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['IdGanadero']; ?></td>
                                <td><?php echo $row['IdCompraGanado']; ?></td>
                                <td><?php echo $row['Nombre']; ?></td>
                                <td><?php echo $row['RazonSocial']; ?></td>
                                <td><?php echo $row['Domicilio']; ?></td>
                                <td><?php echo $row['Localidad']; ?></td>
                                <td><?php echo $row['Municipio']; ?></td>
                                <td><?php echo $row['Estado']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="dos">
                 <a href="EliminarGanadero.php">
                  <img src="eliminar.jpg" alt="borrar" class="eliminar">
                </a>
                <a href="NuevoGanadero.php">
                    <img src="agregar.jpg" alt="agregar" class="nuevo" style="width: 30px; height: 30px;">
                </a>
                </div>
                </div>
            </section>
        </main>
</body>
</html>