<?php
// Configuración de la base de datos
require_once "conexion.php";



// Consulta de tablas
$consulta = "
    SELECT 
        c.N_Reemo, 
        c.Motivo,
        a.NumeroArete, 
        a.Sexo, 
        a.Meses, 
        a.Fierro,
        a.Clasificacion
    FROM animales a
    JOIN compraganado c ON a.idCompraGanado = c.idCompraGanado
";

// Ejecutar la consulta
$guardar = $conexion->query($consulta);

if (!$guardar) {
    die("Error en la consulta: " . $conexion->error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image/jpg" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
        <a href="ADMINISTRADORES.php">
            <img src="flechaatras.jpg" alt="Botón Atrás" class="boton-atras">
        </a>
    </div> 
    <main>
        <section class="container">
            <h3>Tabla de Datos de los Animales</h3>
            <div class="tabla">
                <div class="uno">
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>Reemo</th>
                                <th>Numero de Arete</th>
                                <th>Razon de estar en la granja</th>
                                <th>Sexo</th>
                                <th>Edad en Meses</th>
                                <th>Clasificacion</th>
                                <th>Fierros</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $guardar->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['N_Reemo']); ?></td>
                                <td><?php echo htmlspecialchars($row['NumeroArete']); ?></td>
                                <td><?php echo htmlspecialchars($row['Motivo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Sexo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Meses']); ?></td>
                                <td><?php echo htmlspecialchars($row['Clasificacion']); ?></td>
                                <td><?php echo htmlspecialchars($row['Fierro']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
