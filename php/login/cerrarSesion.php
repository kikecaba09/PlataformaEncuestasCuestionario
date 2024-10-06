<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión en el servidor
session_destroy();

// Redirigir al usuario a la página de inicio o inicio de sesión
header("Location: ../html/login.html");
exit();
?>
