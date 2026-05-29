<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro nuevo empleado</title> 
    <link rel="stylesheet" href="styles/global.css"> 
    <link rel="icon" type="image/jpg" href="toro1.jpg">
</head>
<body>
    <div class="titulin">
        <h1>GANADERIA EL ROSARIO</h1>
    </div>
    <main>
        <section class="izquierda">
        </section>
        <section class="centro">
            <div class="log">
                <div class="login">
                    <form method="POST" action="REGISTRO.php">
                        <div class="titulo">
                            <h2>Nuevo empleado</h2>
                            <a href="INICIO.html">
                                <img src="flechaatras.jpg" alt="Botón Atrás" class="boton-atras">
                            </a>
                        </div>
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" name="Nombre" id="nombre" required>
                        
                        <label for="apellidoP">Apellido Paterno:</label>
                        <input type="text" name="ApellidoP" id="apellidoP" required>
                        
                        <label for="apellidoM">Apellido Materno:</label>
                        <input type="text" name="ApellidoM" id="apellidoM">

                        <label for="sexo">Género:</label>
                        <select name="Sexo" id="sexo" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="Telefono" id="telefono" required>
                        
                        <label for="puesto">Puesto:</label>
                        <select name="Puesto" id="puesto" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Obrero">Obrero</option>
                            <option value="Dueño">Dueño</option>
                        </select>
                        
                        <label for="salario">Salario:</label>
                        <input type="number" name="Salario" id="salario" required>

                        <label for="apellidoM">Nueva Contrasena:</label>
                        <input type="text" name="Clave" id="clave">
                        
                        <button type="submit">Registrar</button>
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
    
    $nombre = $_POST['Nombre']; 
    $apellidop = $_POST['ApellidoP'];
    $apellidom = $_POST['ApellidoM'];
    $sexo = $_POST['Sexo'];
    $telefono = $_POST['Telefono'];
    $puesto = $_POST['Puesto'];
    $salario = $_POST['Salario'];
    $clave = $_POST['Clave'];

    
    $stmt = $conexion->prepare("INSERT INTO Empleados (Nombre, ApellidoP, ApellidoM, Sexo, Telefono, Puesto, Salario, Clave) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
       
        $stmt->bind_param("ssssssis", $nombre, $apellidop, $apellidom, $sexo, $telefono, $puesto, $salario, $clave);
        
        
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
