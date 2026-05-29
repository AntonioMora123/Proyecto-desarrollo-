<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar Alimento</title>
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <div class="titulin">
        <h1>GANADERÍA EL ROSARIO</h1>
    </div>
    <main>
        <section class="izquierda"></section>
        <section class="centro">
            <div class="log">
                <div class="login">
                    <form action="DarComida.php" method="POST">
                        <div class="titulo">
                            <h2>Dar Alimento</h2>
                            <a href="menuTrabajadores.html">
                                <img src="flechaatras.jpg" alt="Botón Atrás" class="boton-atras">
                            </a>
                        </div>
                        
                        <label for="arete">Número de Arete del Animal:</label>
                        <input type="text" id="arete" name="NumeroArete" required>
                        
                        <label for="idEmpleado">ID del Trabajador:</label>
                        <input type="text" id="idEmpleado" name="idEmpleado" required>
                        
                        <div class="comida-option">
                            <label><input type="radio" name="Opcion" value="comida1" required> Abasto</label>
                        </div>
                        <div class="comida-option">
                            <label><input type="radio" name="Opcion" value="comida2"> Inicio</label>
                        </div>
                        <div class="comida-option">
                            <label><input type="radio" name="Opcion" value="comida3"> Desarrollo</label>
                        </div>
                        <div class="comida-option">
                            <label><input type="radio" name="Opcion" value="comida4"> Engorda</label>
                        </div>
                        <div class="comida-option">
                            <label><input type="radio" name="Opcion" value="comida5"> Finalización</label>
                        </div>
                        
                        <button type="submit">Alimentar</button>
                    </form>
                </div>
            </div>
        </section>
        <section class="derecha"></section>
    </main>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la base de datos
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "Ganaderia";

    // Crear conexión
    $conexion = new mysqli($server, $user, $pass, $db);

    // Comprobar conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener los valores del formulario
    $idEmpleado = filter_input(INPUT_POST, 'idEmpleado', FILTER_SANITIZE_STRING);
    $idAnimal = filter_input(INPUT_POST, 'NumeroArete', FILTER_SANITIZE_STRING);
    $tipoAlimento = filter_input(INPUT_POST, 'Opcion', FILTER_SANITIZE_STRING);

  

 
    if (empty($idEmpleado) || empty($idAnimal) || empty($tipoAlimento)) {
        echo "<div class='mensaje'>Por favor, complete todos los campos.</div>";
        exit;
    }

    
    $opcionesValidas = ['comida1', 'comida2', 'comida3', 'comida4', 'comida5'];
    if (!in_array($tipoAlimento, $opcionesValidas)) {
        echo "<div class='mensaje'>Opción de alimento no válida.</div>";
        exit;
    }

    
    function verificarExistencia($conexion, $tabla, $columna, $valor) {
        $query = "SELECT $columna FROM $tabla WHERE $columna = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $valor);
        $stmt->execute();
        $stmt->store_result();
        $existe = $stmt->num_rows > 0;
        $stmt->close();
        return $existe;
    }

    
    if (!verificarExistencia($conexion, "empleados", "idEmpleado", $idEmpleado)) {
        echo "<div class='mensaje'>El empleado no existe.</div>";
        exit;
    }
    if (!verificarExistencia($conexion, "animales", "NumeroArete", $idAnimal)) {
        echo "<div class='mensaje'>El número de arete no existe.</div>";
        exit;
    }

    
    $alimentos = [
        'comida1' => ['Rastrojo' => 9.35, 'Maiz' => 1.1, 'Sal' => 0.44, 'Electrolitos' => 0.11],
        'comida2' => ['Rastrojo' => 2.6829, 'Maiz Roaldo' => 2.1463, 'Soya' => 1.0731],
        'comida3' => ['Rastrojo' => 2.1463, 'Maiz Roaldo' => 2.1463, 'Soya' => 1.0731],
        'comida4' => ['Rastrojo' => 2.1890, 'Maiz Roaldo' => 3.2835, 'Soya' => 1.0945],
        'comida5' => ['Rastrojo' => 2.189, 'Maiz Roaldo' => 3.2835, 'Zilpaterol' => 0.0013],
    ];

    $gananciaTotal = 0;

    foreach ($alimentos[$tipoAlimento] as $nombre => $cantidad) {
        

        $query = "SELECT PrecioPorUnidad FROM almacen WHERE nombre = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->bind_result($precioUnidad);
        $stmt->fetch();
        $stmt->close();

     

        if ($precioUnidad !== null) {
            $gananciaTotal += $cantidad * $precioUnidad;
        }

        $query = "UPDATE Almacen SET Cantidad = Cantidad - ? WHERE Nombre = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ds", $cantidad, $nombre);
        $stmt->execute();
        $stmt->close();
    }

    

    $query = "UPDATE animales SET Ganancia = Ganancia + ? WHERE NumeroArete = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ds", $gananciaTotal, $idAnimal);
    $stmt->execute();
    $stmt->close();

    echo "<div class='mensaje'>El animal ha sido alimentado correctamente.</div>";

    // Cerrar la conexión
    $conexion->close();
}
?>
