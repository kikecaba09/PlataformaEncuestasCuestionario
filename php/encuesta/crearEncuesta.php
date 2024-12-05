<?php
// Incluir la conexión a la base de datos
include '../conexion.php'; // Incluye el archivo donde está la conexión a la base de datos

// Iniciar la sesión para acceder a las variables de sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    // Si no está logueado, redirigir o mostrar mensaje de error
    echo "Debes iniciar sesión para crear una encuesta.";
    exit;
}

// Obtener el usuario_id de la sesión
$usuario_id = $_SESSION['usuario_id'];

// Verificar si se enviaron datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $titulo = $_POST['surveyTitle'];
    $descripcion = $_POST['surveyDescription'];

    // Generar un link único para la encuesta
    $unique_link = "https://tuplataforma.com/encuesta/" . bin2hex(random_bytes(8));

    // Insertar la encuesta en la base de datos
    $stmt = $pdo->prepare("INSERT INTO Encuesta (titulo, descripcion, link_unico, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $unique_link, $usuario_id]);

    // Obtener el ID de la encuesta recién creada
    $encuesta_id = $pdo->lastInsertId();

    // Insertar preguntas
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'questionText_') !== false) {
            $questionId = str_replace('questionText_', '', $key);
            $questionText = $value;
            $questionType = $_POST["questionType_$questionId"];

            // Insertar la pregunta
            $stmt = $pdo->prepare("INSERT INTO Pregunta (encuesta_id, texto_pregunta, tipo_pregunta) VALUES (?, ?, ?)");
            $stmt->execute([$encuesta_id, $questionText, $questionType]);

            $question_id = $pdo->lastInsertId();

            // Insertar opciones si es necesario
            if ($questionType == 'opcion_unica' || $questionType == 'opcion_multiple') {
                if (isset($_POST["option_$questionId"])) {
                    foreach ($_POST["option_$questionId"] as $option) {
                        if (!empty($option)) {
                            $stmt = $pdo->prepare("INSERT INTO Opcion (pregunta_id, texto_opcion) VALUES (?, ?)");
                            $stmt->execute([$question_id, $option]);
                        }
                    }
                }
            }
        }
    }

    // Mostrar el link único para compartir
    echo "<div class='alert alert-success'>Encuesta creada con éxito! Puedes compartirla con este link: <a href='$unique_link' target='_blank'>$unique_link</a></div>";
}
?>
