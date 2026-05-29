<?php
// Configuración de la base de datos
require_once "conexion.php";


// Consulta para obtener datos de ambas tablas
$consulta = "
    SELECT 
        a.idAnimal, 
        a.idCompraGanado, 
        a.NumeroArete, 
        a.Peso, 
        a.PrecioCompra, 
        a.PrecioTotal, 
        a.Ganancia,
        c.idCompraGanado AS CompraId,
        c.N_Reemo, 
        c.Motivo, 
        c.Fecha
    FROM animales a
    JOIN compraganado c ON a.idCompraGanado = c.idCompraGanado
";
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
    <title>Reportes Compras de Animales</title>
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
            <h3>Reportes de Compras de Animales</h3>
            <div class="tabla">
                <table border="1" class="table">
                    <thead>
                        <tr>
                            <th>Id Animal</th>
                            <th>Id Compra Ganado</th>
                            <th>Numero de Reemo</th>
                            <th>Razon de Compra</th>
                            <th>Fecha</th>
                            <th>Numero de Arete</th>
                            <th>Peso</th>
                            <th>Precio de Compra</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $guardar->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idAnimal']); ?></td>
                                <td><?php echo htmlspecialchars($row['CompraId']); ?></td>
                                <td><?php echo htmlspecialchars($row['N_Reemo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Motivo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Fecha']); ?></td>
                                <td><?php echo htmlspecialchars($row['NumeroArete']); ?></td>
                                <td><?php echo htmlspecialchars($row['Peso']); ?></td>
                                <td><?php echo htmlspecialchars($row['PrecioCompra']); ?></td>
                                <td><?php echo htmlspecialchars($row['PrecioTotal']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
