<!DOCTYPE html> 
<html>
<head>
    <title>Comprar Animal</title> 
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
                <form action="" method="POST">
                <br>
                        <div class="titulo">
                            <h2>Comprar Animal</h2>
                            <a href="menuTrabajadores.html">
                                <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
                            </a>
                        </div>
                        <br>
            <label for="N_Reemo">Reemo:</label>        
            <input type="text" name="N_Reemo" required>
            <label for="Motivo">Razon de compra</label>
            <select name="Motivo" id="motivo" required>
                            <option value="cria">Cría</option>
                            <option value="engorda">Engorda</option>
                            <option value="sacrificio">Sacrificio</option>
            </select>
            
            <label for="Fecha">Fecha de compra:</label>
            <input type="date" name="Fecha" id="Fecha" value="<?php echo date('Y-m-d'); ?>" required>
            <label for="NumeroArete">Numero de Arete:</label>
            <input type="text" name="NumeroArete" required pattern="\d+" title="Debe ser un número.">
            <label for="Sexo">Sexo del animal:</label>
            <select name="Sexo" required>
                <option value="" disabled selected>Seleccione el sexo</option>
                <option value="masculino">Macho</option>
                <option value="femenino">Hembra</option>
            </select>
            <label for="Meses">Edad en meses:</label>
            <input type="number" name="Meses" required min="0" title="Ingrese el número de meses.">
            <label for="Clasificacion">Clasificacion:</label>
                        <select name="Clasificacion" id="clasificacion" required>
                            <option value="becerro">Becerro</option>
                            <option value="becerra">Becerra</option>
                            <option value="torete">Torete</option>
                            <option value="vacona">Vacona</option>
                            <option value="toro">Toro</option>
                            <option value="vaca">Vaca</option>
                        </select>
            <label for="Fierro">Fierros marcados en el animal:</label>
            <input type="number" name="Fierro" required>
            <label for="Peso">Peso en kg:</label>
            <input type="number" name="Peso" required min="0" step="0.01" title="Ingrese el peso en kilogramos.">
            <label for="PrecioCompra">Precio por kg en pesos:</label>
            <input type="number" name="PrecioCompra" required min="0" step="0.01" title="Ingrese el precio en pesos.">
            <button type="submit">Comprar</button>
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
require_once "conexion.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $nReemo = $_POST['N_Reemo'];
    $motivo = $_POST['Motivo'];
    $fecha = $_POST['Fecha'];
    $numeroArete = $_POST['NumeroArete'];
    $sexo = $_POST['Sexo'];
    $meses = $_POST['Meses'];
    $clasificacion = $_POST['Clasificacion'];
    $fierro = $_POST['Fierro'];
    $peso = $_POST['Peso'];
    $precioCompra = $_POST['PrecioCompra'];

    
    $precioTotal = $precioCompra * $peso;

    
    $ganancia = $precioTotal;

    
    mysqli_begin_transaction($conexion);

    try {
        // Insertar datos en la tabla compraganado
        $stmtCompraganado = $conexion->prepare("INSERT INTO compraganado (N_Reemo, Motivo, Fecha) VALUES (?, ?, ?)");
        if ($stmtCompraganado) {
            $stmtCompraganado->bind_param("sss", $nReemo, $motivo, $fecha);
            $stmtCompraganado->execute();
            $idCompraGanado = $conexion->insert_id;
            $stmtCompraganado->close();
        } else {
            throw new Exception("Error al preparar la consulta para compraganado: " . $conexion->error);
        }

        // Insertar datos en la tabla animales
        $stmtAnimales = $conexion->prepare("INSERT INTO animales (NumeroArete, Sexo, Meses, Clasificacion, Fierro, Peso, PrecioCompra, PrecioTotal, Ganancia, idCompraGanado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmtAnimales) {
            $stmtAnimales->bind_param("ssissddddi", $numeroArete, $sexo, $meses, $clasificacion, $fierro, $peso, $precioCompra, $precioTotal, $ganancia, $idCompraGanado);
            $stmtAnimales->execute();
            $stmtAnimales->close();
        } else {
            throw new Exception("Error al preparar la consulta para animales: " . $conexion->error);
        }

        
        mysqli_commit($conexion);

        echo "Compra y animal registrados correctamente.";

    } catch (Exception $e) {
      
        mysqli_roll_back($conexion);
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "Por favor, complete el formulario.";
}

// Cerrar la conexión
$conexion->close();
?>
