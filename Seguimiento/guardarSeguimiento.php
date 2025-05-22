<?php
// Incluir conexión
require_once("../Utilerias/conexion.php"); // Ajusta según tu estructura


// Obtener y limpiar los datos del formulario
$id_reporte = limpiarCadena($_POST['id_reporte']);
$estatus_anterior = limpiarCadena($_POST['estatus_anterior']);
$estatus_nuevo = limpiarCadena($_POST['estatus_nuevo']);
$fecha_cambio = limpiarCadena($_POST['fecha_cambio']);
$observaciones = limpiarCadena($_POST['observaciones']);

// Validar que no estén vacíos
if (empty($id_reporte) || empty($estatus_anterior) || empty($estatus_nuevo) || empty($fecha_cambio) || empty($observaciones)) {
    die("Todos los campos son obligatorios.");
}

// Preparar e insertar datos con sentencia SQL
$sql = "INSERT INTO seguimiento (id_reporte, estatus_anterior, estatus_nuevo, fecha_cambio, observaciones)
        VALUES ('$id_reporte', '$estatus_anterior', '$estatus_nuevo', '$fecha_cambio', '$observaciones')";

$resultado = Ejecuta($sql);

// Verificar resultado
if ($resultado == 1) {
    echo "<script>alert('Seguimiento registrado correctamente.'); window.location.href = 'seguimientos.php';</script>";
} else {
    echo "<script>alert('Error al registrar el seguimiento.'); window.history.back();</script>";
}
?>
