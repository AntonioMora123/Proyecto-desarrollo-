<!DOCTYPE html> 
<html>
<head>
    <title>Login</title> 
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
                    <form method="POST" action="Login.php"> 
                        <div class = "titulo">
                            <h2>Iniciar sesion</h2>
                            <a href="INICIO.html">
                            <img src="flechaatras.jpg" alt="Boton Atras" class="boton-atras">
                            </a>
                        </div>
                        <label for="Nombre">Nombre:</label>
                        <input type="text" id="Nombre" name="Nombre" placeholder="Ingrese su Usuario(nombre)" required>
                        <label for="password">Contrasena:</label>
                       <input type="password" id="password" name="Clave" placeholder="Ingrese su contrasena"required>
                       
                       <button type="submit" name="Boton" class="login-bulogitton">Siguiente</button> 
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la base de datos
  require_once "conexion.php";


    
    if (isset($_POST["Boton"])) {
        
        if (empty($_POST["Nombre"]) || empty($_POST["Clave"])) {
            echo "Los campos están vacíos";
        } else {
            
            $usuario = mysqli_real_escape_string($conexion, $_POST["Nombre"]);
            $clave = mysqli_real_escape_string($conexion, $_POST["Clave"]);

           
            $sql = $conexion->prepare("SELECT * FROM empleados WHERE Nombre=? AND Clave=?");
            $sql->bind_param("ss", $usuario, $clave);
            $sql->execute();
            $result = $sql->get_result();

            
            if ($result->num_rows > 0) {
                
                header("Location: Administradores.php");
                exit();
            } else {
                
                echo "El nombre o contraseña son incorrectos";
            }
        }
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

