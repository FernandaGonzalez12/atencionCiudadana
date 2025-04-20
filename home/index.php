<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atención Ciudadana</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f5f5;
      color: #333;
    }

    header {
      background-color: #083358;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      font-size: 1.8rem;
    }

    nav a {
      color: white;
      margin-left: 1.5rem;
      text-decoration: none;
      font-weight: bold;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .hero {
      background: url('https://www.celaya.gob.mx/portal/images/noticias/2024/banner_ciudadano.jpg') no-repeat center center/cover;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-shadow: 1px 1px 4px #000;
    }

    .hero h2 {
      font-size: 2.5rem;
      background-color: rgba(0,0,0,0.4);
      padding: 1rem 2rem;
      border-radius: 10px;
    }

    .menu-principal {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
      margin: 3rem auto;
      max-width: 1000px;
    }

    .menu-item {
      background-color: white;
      border: 1px solid #ccc;
      padding: 1.5rem;
      width: 200px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .menu-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .menu-item img {
      width: 50px;
      margin-bottom: 1rem;
    }

    footer {
      background-color: #083358;
      color: white;
      text-align: center;
      padding: 1rem;
      margin-top: 3rem;
    }
  </style>
</head>
<body>

  <header>
    <h1>Atención Ciudadana</h1>
    <nav>
      <a href="#">Inicio</a>
      <a href="#">Trámites</a>
      <a href="#">Dependencias</a>
      <a href="#">Transparencia</a>
      <a href="#">Contacto</a>
    </nav>
  </header>

  <section class="hero">
    <h2>Tu voz mejora tu comunidad</h2>
  </section>

  <section class="menu-principal">
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/2913/2913465.png" alt="Agua">
      <p>Falta de Agua</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/2913/2913464.png" alt="Luz">
      <p>Falta de Luz</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="Seguridad">
      <p>Seguridad</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/3601/3601027.png" alt="Vialidad">
      <p>Vialidad</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" alt="Pagos">
      <p>Pagos en línea</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/3524/3524659.png" alt="Trámites">
      <p>Trámites</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/1077/1077046.png" alt="Atención">
      <p>Atención</p>
    </div>
    <div class="menu-item">
      <img src="https://cdn-icons-png.flaticon.com/512/733/733609.png" alt="Wikipedia">
      <p><a href="https://es.wikipedia.org" target="_blank" style="text-decoration: none; color: #333;">Wikipedia</a></p>
    </div>
  </section>

  <footer>
    <p>© 2025 Atención Ciudadana. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
