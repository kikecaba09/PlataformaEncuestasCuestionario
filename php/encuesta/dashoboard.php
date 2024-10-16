<?php
// Conexión a la base de datos
require_once 'conexion.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consultar las encuestas del usuario autenticado
$sql = "SELECT encuesta_id, titulo, activa FROM Encuesta WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$encuestas = [];
while ($row = $result->fetch_assoc()) {
    $encuestas[] = $row;
}

echo json_encode($encuestas);
?>
