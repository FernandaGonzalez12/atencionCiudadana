<?php
include_once("../utilerias/conexion.php"); // Asegúrate de que esta ruta sea correcta

// Obtener los datos del formulario
$idusr = $_POST['idusr'];
$idc = $_POST['idc'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$ubicacion = $_POST['ubicacion'];
$fechar = $_POST['fechar'];
$fechac = $_POST['fechac'];

$imagen = '';

// Validar imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $tipoArchivo = mime_content_type($_FILES['imagen']['tmp_name']);

    if (in_array($tipoArchivo, $tiposPermitidos)) {
        $dir_subida = '../uploads/';
        if (!file_exists($dir_subida)) {
            mkdir($dir_subida, 0777, true);
        }

        $nombre_archivo = time() . '_' . basename($_FILES['imagen']['name']);
        $ruta_final = $dir_subida . $nombre_archivo;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_final)) {
            $imagen = $ruta_final;
        } else {
            echo "Error al guardar la imagen.";
            exit;
        }
    } else {
        echo "Archivo no válido. Debe ser una imagen.";
        exit;
    }
}

try {
    // Insertar en la base de datos con PDO
    $sql = "INSERT INTO reportes (id_usuario, id_categoria, titulo, descripcion, ubicacion, imagen, fecha_reporte, fecha_actualizacion)
            VALUES (:idusr, :idc, :titulo, :descripcion, :ubicacion, :imagen, :fechar, :fechac)";
    
    $stmt = $Cn->prepare($sql);
    
    $stmt->bindParam(':idusr', $idusr, PDO::PARAM_INT);
    $stmt->bindParam(':idc', $idc, PDO::PARAM_INT);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
    $stmt->bindParam(':fechar', $fechar, PDO::PARAM_STR);
    $stmt->bindParam(':fechac', $fechac, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<script>
                alert('Reporte registrado exitosamente');
                // Limpiar los campos del formulario
                document.getElementById('idusr').value = '';
                document.getElementById('idc').value = '';
                document.getElementById('titulo').value = '';
                document.getElementById('descripcion').value = '';
                document.getElementById('ubicacion').value = '';
                document.getElementById('fechar').value = '';
                document.getElementById('fechac').value = '';
                document.getElementById('imagen').value = '';
              </script>";
    } else {
        echo "<script>alert('Error al guardar el reporte');</script>";
    }

} catch (PDOException $e) {
    echo "<script>alert('Error en la base de datos: " . $e->getMessage() . "');</script>";
}
?>
