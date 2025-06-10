<?php
header('Content-Type: application/json; charset=utf-8');

include_once("../Utilerias/conexion.php"); // Aquí incluyes tu conexión PDO

try {
    // Usamos tu función Consulta para obtener resultados como arreglo asociativo
    $comentarios = Consulta("SELECT comentario, fecha_comentario, anonimo FROM comentarios ORDER BY fecha_comentario DESC LIMIT 20");

    // Preparamos el arreglo para el JSON
    $resultados = [];
    foreach ($comentarios as $fila) {
        $resultados[] = [
            'comentario' => $fila['comentario'],
            'fecha' => $fila['fecha_comentario'],
            'autor' => $fila['anonimo'] == 1 ? 'Anónimo' : 'Usuario'
        ];
    }

    echo json_encode($resultados);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
