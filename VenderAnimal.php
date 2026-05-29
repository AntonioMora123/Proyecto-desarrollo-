<?php
// Obtener la fecha actual en formato YYYY-MM-DD
$fecha_actual = date("Y-m-d");
?>

<!DOCTYPE html> 
<html>
<head>
    <title>Vender Animal</title> 
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" type="image" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
    </div>
        <main>
            <section class = "izquierda">
            </section>
            <section class = "centro">
                    <br>
                    <br>
                <div class = "log">
                    <div class = "login">
                    <form action="" method="POST">
                        <br>
                       <div class = "titulo">
                            <h2>Vender Animal</h2>
                            <a href="menuTrabajadores.html">
                            <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
                            </a>
                        </div>
                       <br>
                       <label for="NumeroArete">Numero de Arete:</label>
                       <input type="text" id="NumeroArete" name="NumeroArete" required>
                       <label for="Destino">Destino:</label>
                       <input type="text" id="Destino" name="Destino" required>
                       <label for="PesoVenta">Peso del animal en kg:</label>
                       <input type="number" id="PesoVenta" name="PesoVenta" required min="0" step="0.01">
                       <label for="PrecioVenta">Precio de Venta ($)</label>
                       <input type="number" id="PrecioVenta" name="PrecioVenta" required min="0" step="0.01">
                       <label for="FechaVenta">Fecha de Venta</label>
                       <input type="date" id="FechaVenta" name="FechaVenta" value="<?php echo $fecha_actual; ?>" required>
                       
                       <label for="TipoVenta">Tipo de Venta</label>
                        <select id="TipoVenta" name="TipoVenta" required>
                            <option value="" disabled selected>Seleccione el tipo de venta</option>
                            <option value="engorda">Engorda</option>
                            <option value="cria">Cría</option>
                            <option value="sacrificio">Sacrificio</option>
                        </select>

                       <button type="submit">Vender</button> 
                    </form>
                    </div>
                </div>
            </section>
            <section class = "derecha">
            </section>
        </main>
</body>
</html>

<?php
// Configuración de la base de datos
require_once "conexion.php";


$fecha_actual = date("Y-m-d");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener datos del formulario
    $numeroArete = $_POST['NumeroArete'];
    $destino = $_POST['Destino'];
    $tipoVenta = $_POST['TipoVenta'];
    $pesoVenta = $_POST['PesoVenta'];
    $precioVenta = $_POST['PrecioVenta'];
    $fechaVenta = $_POST['FechaVenta'];

    
    $precioTotal = $precioVenta * $pesoVenta;

    
    $consultaDatos = "SELECT c.N_Reemo, a.Ganancia FROM compraganado c INNER JOIN animales a ON c.idCompraGanado = a.idCompraGanado WHERE a.NumeroArete = ?";

   
    $stmtDatos = $conexion->prepare($consultaDatos);
    if ($stmtDatos === false) {
       
        die("Error al preparar la consulta: " . $conexion->error);
    }

   
    $stmtDatos->bind_param("i", $numeroArete); 
    $stmtDatos->execute();
    $stmtDatos->bind_result($nReemo, $ganancia);
    $stmtDatos->fetch();
    $stmtDatos->close();

    
    if ($nReemo !== null && $ganancia !== null) {
        
        $gananciaTotal = $precioTotal - $ganancia;

        
        $stmtVenta = $conexion->prepare("INSERT INTO ventaganado (N_Reemo, Destino, TipoVenta, PesoVenta, PrecioVenta, FechaVenta, Ganancia) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmtVenta === false) {
            
            die("Error al preparar la consulta para la venta: " . $conexion->error);
        }

       
        $stmtVenta->bind_param("issiisi", $nReemo, $destino, $tipoVenta, $pesoVenta, $precioVenta, $fechaVenta, $gananciaTotal);

        
        if ($stmtVenta->execute()) {
            echo "Venta registrada correctamente. Ganancia Total calculada: $gananciaTotal";
        } else {
            echo "Error al registrar la venta: " . $stmtVenta->error;
        }

        
        $stmtVenta->close();
    } else {
        echo "No se encontró N_Reemo ni ganancia para el NumeroArete proporcionado.";
    }
} else {
    echo "Por favor, complete el formulario.";
}

// Cerrar la conexión
$conexion->close();
?>
