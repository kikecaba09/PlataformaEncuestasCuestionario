<?php

$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$baseDeDatos = 'PlataformaEncuestas';
$puerto = 3306;

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $baseDeDatos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos '$baseDeDatos'";
}

?>