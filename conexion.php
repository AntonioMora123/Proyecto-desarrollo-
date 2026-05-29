<?php

$server = "mysql";
$user   = "root";
$pass   = "root";
$db     = "Ganaderia";

// Crear conexión
$conexion = mysqli_connect(
    $server,
    $user,
    $pass,
    $db
);

// Validar conexión
if (!$conexion) {
    die(
        "Error al conectar con MySQL: "
        . mysqli_connect_error()
    );
}

// Configurar caracteres
mysqli_set_charset(
    $conexion,
    "utf8mb4"
);

?>