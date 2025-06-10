<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comentarios</title>
    <!-- Importa librerias de estilos de Materialize, DataTable e Iconos -->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/tecnm.ico" />
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<style>
  .floating-comment {
  position: relative;
  animation: floatIn 0.6s ease-out;
  margin-bottom: 10px;
  padding: 12px 16px;
  background: #e3f2fd;
  border-left: 4px solid #2196f3;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  transition: transform 0.3s ease, opacity 0.3s ease;
}

@keyframes floatIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
<body>
  
<?php include_once("../Resource/html/header.php"); ?>
<div class="container">
 <div class="container" style="max-width:600px; margin-top:40px;">
  <h5>Sección para agregar algun comentario o reporte anonimo</h5>
  
  <form id="comentarioForm" method="POST" action="guardar_comentario.php">
    <div class="input-field">
      <textarea id="comentario" name="comentario" class="materialize-textarea" required></textarea>
      <label for="comentario">Escribe tu comentario aquí</label>
    </div>

    <p>
      <label>
        <input type="checkbox" name="anonimo" id="anonimoCheckbox" value="1" />
        <span>Comentar de forma anónima</span>
      </label>
    </p>

    <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="action">Enviar<i class="material-icons right">send</i>
    </button>
  </form>
   <div id="comentariosRecientes" style="margin-top:40px;">
    <h5>Comentarios recientes</h5>
    <hr style="border: 1px solid #ccc; margin-top: 5px; margin-bottom: 15px;">
    <ul class="collection" id="listaComentarios">
      <!-- Comentarios dinámicos aquí -->
    </ul>
  </div>


  <!-- Aquí aparecerán los mensajes de éxito o error -->
  <div id="mensajeFeedback" style="margin-top:20px;"></div>
</div>

<script>
  function cargarComentarios() {
  fetch('obtener_comentarios.php')
    .then(response => response.json())
    .then(data => {
      const lista = document.getElementById('listaComentarios');
      lista.innerHTML = ''; // limpia lista antes de cargar nuevos

      data.forEach(item => {
        const li = document.createElement('li');
        li.className = 'floating-comment'; // clase para flotante
        li.innerHTML = `
          <strong>${item.autor}</strong><br>
          <p>${item.comentario}</p>
          <small class="grey-text">${item.fecha}</small>
        `;
        lista.appendChild(li);
      });
    });
}
  // Cargar comentarios al iniciar
  document.addEventListener('DOMContentLoaded', cargarComentarios);

  // Cargar comentarios cada 5 segundos
  setInterval(cargarComentarios, 5000);

  // Modifica el submit para refrescar comentarios al enviar
  document.getElementById('comentarioForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const comentario = document.getElementById('comentario').value.trim();
    const anonimo = document.getElementById('anonimoCheckbox').checked ? 1 : 0;
    const mensajeFeedback = document.getElementById('mensajeFeedback');

    if (comentario === '') {
      mensajeFeedback.innerHTML = '<span class="red-text">El comentario no puede estar vacío.</span>';
      return;
    }

    fetch('guardar_comentario.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `comentario=${encodeURIComponent(comentario)}&anonimo=${anonimo}`
    })
    .then(res => res.text())
    .then(data => {
      mensajeFeedback.innerHTML = `<span class="green-text">${data}</span>`;
      document.getElementById('comentario').value = '';
      document.getElementById('anonimoCheckbox').checked = false;
      M.textareaAutoResize(document.getElementById('comentario'));
      cargarComentarios(); // ← recarga los comentarios al instante
    })
    .catch(() => {
      mensajeFeedback.innerHTML = `<span class="red-text">Error al enviar el comentario.</span>`;
    });
  });
</script>


</div>

<?php include_once("../Resource/html/footer.php") ?>
<!-- Importa librerias de JavaScript de Jquery, Jaquery Validate, DataTable
     y Materialize                                                       -->
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>     
    <script type="text/javascript" src="./valida.js"></script>     
    <script type="text/javascript">
     $(document).ready(function(){
        $('select').formSelect();
        $('.sidenav').sidenav();
        $(".dropdown-trigger").dropdown();
        $('.tooltipped').tooltip(); 
     });
   
</script>     
</body>
</html>