<?php
session_start();
require_once '../conexion.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['nombreUsuario'];
    $contrasena = $_POST['contrasena'];

    // Escapar caracteres especiales para prevenir inyecciones SQL
    $nombreUsuario = $conexion->real_escape_string($nombreUsuario);
    $contrasena = $conexion->real_escape_string($contrasena);

    // Consulta para verificar el nombre de usuario y la contraseña
    $consulta = "SELECT * FROM Usuario WHERE nombreUsuario = '$nombreUsuario' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        // Usuario y contraseña correctos
        $usuario = $resultado->fetch_assoc();
        $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
        $_SESSION['usuario_id'] = $usuario['usuario_id']; // Guardar ID de usuario en la sesión

        // Redirigir al usuario a su página personalizada
        header("Location: ../../html/encuesta/dashborardUsuario.html?nombreUsuario=" . $usuario['nombreUsuario']);
        exit();
    } else {
        // Usuario o contraseña incorrectos
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
