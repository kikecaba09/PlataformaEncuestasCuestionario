<?php
require_once '../conexion.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['nombreUsuario'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];

    // Escapar caracteres especiales para prevenir inyecciones SQL
    $nombreUsuario = $conexion->real_escape_string($nombreUsuario);
    $contrasena = $conexion->real_escape_string($contrasena);
    $email = $conexion->real_escape_string($email);

    // Verificar si el nombre de usuario o el email ya existen
    $verificacion = "SELECT * FROM Usuario WHERE nombreUsuario = '$nombreUsuario' OR email = '$email'";
    $resultadoVerificacion = $conexion->query($verificacion);

    if ($resultadoVerificacion->num_rows > 0) {
        echo "El nombre de usuario o correo ya están registrados.";
    } else {
        $consulta = "INSERT INTO Usuario (nombreUsuario, contrasena, email) VALUES ('$nombreUsuario', '$contrasena', '$email')";
        if ($conexion->query($consulta) === TRUE) {
            echo "Registro exitoso.";
            header("Location: ../../html/login.html"); 
            exit();
        } else {
            echo "Error: " . $consulta . "<br>" . $conexion->error;
        }
    }
}
?>
