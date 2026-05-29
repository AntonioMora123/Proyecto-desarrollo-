<?php
// Configuración de la base de datos
require_once "conexion.php";


// Consultar datos
$consulta = "SELECT * FROM Empleados";
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
    <title>Trabajadores</title>
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
            <h3>Tabla de Trabajadores</h3>
            <div class="tabla">
                <div class="uno">
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>Id de Empleado</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Genero</th>
                                <th>Teléfono</th>
                                <th>Puesto</th>
                                <th>Salario</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $guardar->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
                                <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['ApellidoP']); ?></td>
                                <td><?php echo htmlspecialchars($row['ApellidoM']); ?></td>
                                <td><?php echo htmlspecialchars($row['Sexo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Telefono']); ?></td>
                                <td><?php echo htmlspecialchars($row['Puesto']); ?></td>
                                <td><?php echo htmlspecialchars($row['Salario']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="dos">
                <a href="EliminarEmpleados.php">
                    <img src="eliminar.jpg" alt="borrar" class="eliminar" style="width: 30px; height: 30px;">
                </a>
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
