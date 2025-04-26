<?php
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = new mysqli("localhost", "root", "", "atencion_ciudadana");

  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  $correo = $_POST['correo'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
  $resultado = $conn->query($sql);

  if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($contrasena, $usuario['contrasena'])) {
      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_nombre'] = $usuario['nombre'];
      header("Location: formulario.php");
      exit();
    } else {
      $mensaje = "❌ Contraseña incorrecta.";
    }
  } else {
    $mensaje = "❌ El correo no está registrado.";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
    <form method="POST">
      <input type="email" name="correo" placeholder="Correo electrónico" required>
      <input type="password" name="contrasena" placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
