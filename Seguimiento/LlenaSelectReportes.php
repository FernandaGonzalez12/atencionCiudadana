
<?php
require_once("../Utilerias/conexion.php"); // Ajusta según tu estructura


$query = "SELECT id_reporte, titulo, estatus FROM reportes";
$reportes = Consulta($query);

foreach ($reportes as $reporte) {
    echo '<option value="' . $reporte['id_reporte'] . '" data-estatus="' . $reporte['estatus'] . '">' . $reporte['titulo'] . '</option>';
}
?>

