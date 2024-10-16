<?php
// Conexión a la base de datos
require_once '../conexion.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consultar el nombre del usuario
$sql = "SELECT nombreUsuario FROM Usuario WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$usuario = $result->fetch_assoc();
echo json_encode($usuario);
?>
