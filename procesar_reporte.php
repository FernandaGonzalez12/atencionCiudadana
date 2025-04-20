<?php
$servername = "localhost"; // Cambia esto si usas un host diferente
$username = "root"; // Tu usuario de MySQL
$password = ""; // Tu contraseña de MySQL
$dbname = "atencion_ciudadana"; // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$ubicacion = $_POST['ubicacion'];

// Insertar el reporte en la base de datos
$sql = "INSERT INTO reportes (categoria, descripcion, ubicacion) 
        VALUES ('$categoria', '$descripcion', '$ubicacion')";

if ($conn->query($sql) === TRUE) {
  echo "Reporte enviado con éxito";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
