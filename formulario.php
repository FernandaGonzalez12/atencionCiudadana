<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}
?>

<?php
$mensaje = "";
//esto es un comentario para probar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "atencion_ciudadana";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  $categoria = $_POST['categoria'];
  $descripcion = $_POST['descripcion'];
  $ubicacion = $_POST['ubicacion'];

  $sql = "INSERT INTO reportes (categoria, descripcion, ubicacion) 
          VALUES ('$categoria', '$descripcion', '$ubicacion')";

  if ($conn->query($sql) === TRUE) {
    $mensaje = "✅ Tu reporte fue enviado exitosamente. ¡Gracias por tu colaboración!";
  } else {
    $mensaje = "❌ Ocurrió un error al enviar tu reporte.";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Levantar Reporte</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 100%;
      max-width: 600px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 2rem;
    }

    label {
      font-weight: bold;
      margin-bottom: 0.5rem;
      display: block;
    }

    input, textarea, select {
      width: 100%;
      padding: 1rem;
      margin: 0.5rem 0 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 1rem;
      background-color: #083358;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1.2rem;
      cursor: pointer;
    }

    button:hover {
      background-color: #071f2a;
    }

    .mensaje {
      background-color: #dff0d8;
      color: #3c763d;
      border: 1px solid #d6e9c6;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 5px;
      text-align: center;
    }

    .error {
      background-color: #f2dede;
      color: #a94442;
      border: 1px solid #ebccd1;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Levanta tu Reporte</h2>

    <?php if (!empty($mensaje)): ?>
      <div class="mensaje <?php echo strpos($mensaje, '❌') !== false ? 'error' : ''; ?>">
        <?php echo $mensaje; ?>
      </div>
    <?php endif; ?>

    <form action="formulario.php" method="POST">
      <label for="categoria">Categoría del Reporte:</label>
      <select name="categoria" id="categoria" required>
        <option value="Falta de Agua">Falta de Agua</option>
        <option value="Falta de Luz">Falta de Luz</option>
        <option value="Seguridad">Seguridad</option>
        <option value="Vialidad">Vialidad</option>
        <option value="Otro">Otro</option>
      </select>

      <label for="descripcion">Descripción del Reporte:</label>
      <textarea name="descripcion" id="descripcion" rows="4" required></textarea>

      <label for="ubicacion">Ubicación:</label>
      <input type="text" name="ubicacion" id="ubicacion" required>

      <button type="submit">Enviar Reporte</button>
    </form>
  </div>

</body>
</html>
