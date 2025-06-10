<?php
require_once("../Utilerias/conexion.php");
header('Content-Type: text/plain; charset=utf-8');

$comentario = isset($_POST['comentario']) ? limpiarCadena(trim($_POST['comentario'])) : '';
$anonimo = (isset($_POST['anonimo']) && $_POST['anonimo'] == '1') ? 1 : 0;

if ($comentario === '') {
    http_response_code(400);
    echo "El comentario no puede estar vacío.";
    exit;
}

$sql = "INSERT INTO comentarios (comentario, anonimo) VALUES ('$comentario', $anonimo)";

if (Ejecuta($sql)) {
    echo "Comentario guardado correctamente.";
} else {
    http_response_code(500);
    echo "Error al guardar el comentario.";
}

?>
