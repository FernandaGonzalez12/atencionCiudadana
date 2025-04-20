<?php
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = new mysqli("localhost", "root", "", "atencion_ciudadana");

  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";

  if ($conn->query($sql) === TRUE) {
    $mensaje = "✅ Registro exitoso. ¡Ya puedes iniciar sesión!";
  } else {
    $mensaje = "❌ Error: Este correo ya está registrado.";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; }
    .form-container {
      width: 400px;
      margin: 5rem auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input { width: 100%; padding: 1rem; margin-bottom: 1rem; }
    button { width: 100%; padding: 1rem; background: #083358; color: white; border: none; }
    .mensaje { text-align: center; margin-bottom: 1rem; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Registro de Usuario</h2>
    <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
    <form method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="correo" placeholder="Correo electrónico" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <button type="submit">Registrarse</button>
    </form>
  </div>
</body>
</html>
