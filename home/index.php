<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Atención Ciudadana</title>
<meta name="description" content="Portal de Atención Ciudadana. Reporta fallas, da seguimiento y mejora tu comunidad.">
<meta name="keywords" content="Atención Ciudadana, Reportes, Servicios Públicos, Gobierno, Ciudad">
          
<!-- Estilos -->
<link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
<link type="text/css" rel="stylesheet" href="../css/default.css"/>
<link type="text/css" rel="stylesheet" href="../css/home.css"/>
</head>
<style>
/* Modal tipo chat anclado a la esquina inferior derecha */
          #modalAyuda {
              position: fixed !important;
              bottom: 90px;
              right: 20px;
              width: 320px;
              height: 420px;
              margin: 0;
              border-radius: 15px;
              box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
              overflow: hidden;
              z-index: 9999;
          }

          #modalAyuda .modal-content {
              height: 330px;
              overflow-y: auto;
              padding: 15px;
          }

          #modalAyuda .modal-footer {
              padding: 10px;
              text-align: right;
          }

          /* Oculta el fondo oscuro del modal de Materialize */
          .modal-overlay {
              background-color: transparent !important;
          }
          .fixed-action-btn {
          position: fixed;
          right: 30px;
          bottom: 30px;
          z-index: 9999;
          }

          #menu-accesibilidad {
          position: fixed;
          right: 30px;
          bottom: 100px;
          width: 300px;
          background-color: #000;
          color: orange;
          display: none;
          border-radius: 12px;
          z-index: 10000;
          }

          #menu-accesibilidad h6 {
          margin: 0;
          background: #ffcc99;
          padding: 12px;
          font-weight: bold;
          color: black;
          }

          #menu-accesibilidad .row {
          margin: 0;
          padding: 10px;
          }

          #menu-accesibilidad p {
          margin: 5px 0;
          cursor: pointer;
          font-size: 14px;
          }

          .contraste-alto {
          filter: invert(1) hue-rotate(180deg);
          }

          .linea-lectura {
          border-top: 2px dashed orange;
          border-bottom: 2px dashed orange;
          padding: 10px 0;
          }
</style>
    <body>
    <?php include_once("../Resource/html/header.php");?>         
    <!-- Botón flotante -->
    <div class="fixed-action-btn">
      <a class="btn-floating btn-large orange darken-2 tooltipped" data-tooltip="Menú accesible" onclick="toggleMenu()">
        <i class="material-icons">accessibility</i>
      </a>
    </div>

    <!-- Menú accesibilidad -->
    <div id="menu-accesibilidad" class="card-panel z-depth-3">
      <h6>Menú Accesible (Ctrl + M)</h6>
      <div class="row">
        <div class="col s6"><p onclick="toggleContraste()">🌓 Contrastes</p></div>
        <div class="col s6"><p onclick="aumentarTexto()">🔠 Texto grande</p></div>
        <div class="col s6"><p onclick="resaltarLinks()">🔗 Resaltar links</p></div>
        <div class="col s6"><p onclick="toggleAnimaciones()">⏹ Sin animaciones</p></div>
        <div class="col s6"><p onclick="toggleLectura()">📖 Línea de lectura</p></div>
        <div class="col s6"><p onclick="resetAccesibilidad()">🔄 Reiniciar</p></div>
      </div>
    </div>

    <!-- Scripts -->
    <script>
      let contrasteActivo = false;
      let lecturaActiva = false;

      function toggleMenu() {
        const menu = document.getElementById("menu-accesibilidad");
        menu.style.display = menu.style.display === "none" ? "block" : "none";
      }

      function toggleContraste() {
        contrasteActivo = !contrasteActivo;
        document.body.classList.toggle("contraste-alto", contrasteActivo);
      }

      function aumentarTexto() {
        document.body.style.fontSize = "larger";
      }

      function resaltarLinks() {
        document.querySelectorAll("a").forEach(link => {
          link.style.backgroundColor = "yellow";
          link.style.color = "black";
          link.style.fontWeight = "bold";
        });
      }

      function toggleAnimaciones() {
        const style = document.createElement('style');
        style.innerHTML = `* { animation: none !important; transition: none !important; }`;
        document.head.appendChild(style);
      }

      function toggleLectura() {
        lecturaActiva = !lecturaActiva;
        document.querySelectorAll("p").forEach(p => {
          if (lecturaActiva) {
            p.classList.add("linea-lectura");
          } else {
            p.classList.remove("linea-lectura");
          }
        });
      }

      function resetAccesibilidad() {
        document.body.classList.remove("contraste-alto");
        document.body.style.fontSize = "";
        document.querySelectorAll("a").forEach(link => {
          link.style.backgroundColor = "";
          link.style.color = "";
          link.style.fontWeight = "";
        });
        document.querySelectorAll("p").forEach(p => {
          p.classList.remove("linea-lectura");
        });
      }

      // Acceso por teclado: Ctrl + M
      document.addEventListener("keydown", function(e) {
        if (e.ctrlKey && e.key.toLowerCase() === "m") {
          toggleMenu();
        }
      });
    </script>
    

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
          <section class="section center-align bienvenida">
          <div class="container">
              <h4 class="titulo center-align">
                <i class="material-icons medium blue-text" style="vertical-align: middle;">record_voice_over</i>
                &nbsp;¡Tu voz cuenta!&nbsp;
                <i class="material-icons medium blue-text" style="vertical-align: middle;">record_voice_over</i>
              </h4>
              <div class="divider blue lighten-2" style="margin: 10px auto 20px; width: 80px;"></div>
              <p class="flow-text descripcion">
              Bienvenido al portal de Atención Ciudadana. Aquí puedes reportar problemas en tu comunidad, dar seguimiento a tus reportes y ayudar a mejorar nuestra ciudad.
              </p>
          </div>
          </section>
          <!-- Carrusel de imágenes -->
          <section>
              <div class="carousel carousel-slider">
              <?php
                  require_once("../Modelo/Carousel.php"); 
                  $objCarousel = new Carousel();
                  $imagenes = $objCarousel->obtenerImagenes(); 

                  foreach ($imagenes as $img) {
                      echo "<a class='carousel-item' href='#!'><img src='" . $img['imagen'] . "' class='responsive-img'></a>";
                  }
              ?>
              </div>
          </section>
          <!--Seccion de apartados disponibles para mi home-->
          <section id="productos" class="container section">
              <h4 class="center">Nuestros Servicios</h4>
              <div class="row">
                <div class="col s12 m4">
                  <div class="card-panel white center" style="cursor: pointer;" onclick="location.href='../Reporte/registro.php';">
                      <i class="material-icons large blue-text">report_problem</i>
                      <p>Reporta</p>
                  </div>
              </div>
                  <div class="col s12 m4">
                  <div class="card-panel white center" style="cursor: pointer;" onclick="location.href='../Seguimiento';">
                          <i class="material-icons large green-text">visibility</i>
                          <p>Da seguimiento</p>
                      </div>
                  </div>
                  <div class="col s12 m4">
                      <div class="card-panel white center" style="cursor: pointer;" onclick="location.href='../Comentarios';">
                          <i class="material-icons large orange-text" >group</i>
                          <p>Participa</p>
                      </div>
                  </div>
              </div>
          </section>
          <!-- Sección: Ubicación de dependencias -->
          <div class="container">
          <h4 class="center-align">Ubicación de dependencias</h4>
          <div class="card">
              <div class="card-content">
              <div id="map" style="height: 400px; width: 100%;"></div>
              </div>
          </div>
          </div>
          <!-- Botón flotante de ayuda -->
          <div class="fixed-action-btn">
          <a class="btn-floating btn-large red modal-trigger tooltipped" href="#modalAyuda" data-tooltip="¿Necesitas ayuda?" data-position="left">
              <i class="material-icons">chat</i>
          </a>
          </div>

          <!-- Modal tipo chat -->
          <div id="modalAyuda" class="modal">
          <div class="modal-content">
              <h6><strong>Asistente Virtual</strong></h6>
              <div id="chatBox" style="height: 230px; overflow-y: auto; font-size: 0.9em;">
              <p><strong>Asistente:</strong> ¡Hola! ¿En qué puedo ayudarte?</p>
              </div>
              <div class="input-field" style="margin-top: 10px;">
              <input type="text" id="preguntaUsuario" placeholder="Escribe tu pregunta y presiona Enter">
              </div>
          </div>
          <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect btn-flat">Cerrar</a>
          </div>
          </div>

          <!-- CSS de Leaflet -->
          <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
          <!-- JS de Leaflet -->
          <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
          <!-- Script para inicializar el mapa -->
          <script>
          document.addEventListener('DOMContentLoaded', function () {
              var lat = 20.5234; // Coordenada simulada, puedes cambiarla
              var lng = -100.8113; // Coordenada simulada, puedes cambiarla

              var map = L.map('map').setView([lat, lng], 15); // Zoom 15 para enfoque urbano

              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; OpenStreetMap contributors'
              }).addTo(map);

              L.marker([lat, lng]).addTo(map)
              .bindPopup('Atencion Ciudadana.')
              .openPopup();
          });
          </script>
          <!-- Sección: Misión, Visión y Valores -->
          <div class="container section">
          <div class="row">
              <div class="col s12 m4">
              <div class="card-panel blue lighten-5 center-align">
                  <div class="icono-container">
                  <i class="material-icons large blue-text">flag</i>
                  </div>
                  <h5 class="center">Misión</h5>
                  <p style="text-align: justify;">
                  Proporcionar una plataforma confiable,accesible y moderna que permita a los ciudadanos reportar fallas,dar seguimiento a sus solicitudes y colaborar para mejorar la calidad.
                  </p>
              </div>
              </div>
              <div class="col s12 m4">
              <div class="card-panel green lighten-5 center-align">
                  <div class="icono-container">
                  <i class="material-icons large green-text">visibility</i>
                  </div>
                  <h5 class="center">Visión</h5>
                  <p style="text-align: justify;">
                  Convertirnos en el principal canal digital de atención ciudadana, destacando por la eficiencia, innovación y transparencia en la gestión de reportes, fortaleciendo así el vínculo entre ciudadanía y gobierno.
                  </p>
              </div>
              </div>
              <div class="col s12 m4">
              <div class="card-panel green lighten-5 center-align">
                  <div class="icono-container">
                  <i class="material-icons large orange-text">security</i>
                  </div>
                  <h5 class="center">Valores</h5>
                  <p style="text-align: justify;">
                  Transparencia,compromiso,responsabilidad social,empatía,innovación y trabajo en equipo son los pilares que guían cada acción de nuestro portal, asegurando una atención ciudadana digna y eficiente.
                  </p>
              </div>
              </div>
          </div>
          </div>
          <?php include_once("../Resource/html/footer.php");?>

      <!-- Scripts -->
      <script src="../js/jquery-3.0.0.min.js"></script>
      <script src="../js/materialize.min.js"></script>
      <script src="../js/jquery.dataTables.min.js"></script>
      <script src="../js/dataTables.materialize.js"></script>
      <script src="../js/jquery.validate.min.js"></script>
      <script src="./valida.js"></script>

      <!-- Inicialización Materialize -->
      <script>
      $(document).ready(function(){
          $('select').formSelect();
          $('.sidenav').sidenav();
          $(".dropdown-trigger").dropdown();
          $('.tooltipped').tooltip(); 

          var elems = document.querySelectorAll('.carousel');
          var carouselInstance = M.Carousel.init(elems, {
              fullWidth: true,
              indicators: true,
              duration: 300,
              noWrap: false
          });

          document.querySelectorAll('.carousel-item').forEach(item => {
              item.addEventListener('click', () => {
                  carouselInstance.next();
              });
          });
      });
      </script>
    <script>
  $(document).ready(function(){
    $('.modal').modal({
      dismissible: true,
      onOpenEnd: function() {
        $('#preguntaUsuario').focus();
      }
    });
    $('.tooltipped').tooltip();

    $('#preguntaUsuario').keypress(function(e) {
      if (e.which === 13) {
        let pregunta = $(this).val().toLowerCase();
        let respuesta = "<strong>Asistente:</strong> ";

        if (pregunta.includes("reporte")) {
          respuesta += "Para hacer un reporte, ve al formulario y completa todos los campos.";
        } else if (pregunta.includes("seguimiento")) {
          respuesta += "Puedes revisar el seguimiento en la sección 'Mis reportes'.";
        } else if (pregunta.includes("ubicación") || pregunta.includes("oficina")) {
          respuesta += "Estamos ubicados en el centro cívico, planta baja.";
        } else {
          respuesta += "No entendí tu pregunta. ¿Podrías reformularla?";
        }

        $('#chatBox').append(`<p><strong>Tú:</strong> ${pregunta}</p>`);
        $('#chatBox').append(`<p>${respuesta}</p>`);
        $('#preguntaUsuario').val('');
        $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
      }
    });
  });
  </script>

      <!-- Script del mapa -->
      <script>
      function initMap() {
          var latitudInicial = 20.580813;
          var longitudInicial = -100.825980;

          var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: latitudInicial, lng: longitudInicial},
              zoom: 12
          });

          function addMarker(lat, lon, nombre, direccion) {
              var marker = new google.maps.Marker({
                  position: {lat: lat, lng: lon},
                  map: map,
                  title: nombre
              });

              var infowindow = new google.maps.InfoWindow({
                  content: '<h5>' + nombre + '</h5><p>' + direccion + '</p>'
              });

              marker.addListener('click', function() {
                  infowindow.open(map, marker);
              });
          }

          <?php
          require_once("../Modelo/Sede.php");
          $obj = new Sede();
          $tuplas = $obj->Consultar();

          foreach ($tuplas as $tupla) {
              $lon = $tupla['longitud'];
              $lat = $tupla['latitud'];
              if (!empty($lon) && !empty($lat)) {
                  $nombre = $tupla['nomsede'];
                  $direccion = $tupla['domsede'];
                  if ($nombre != 'Todas las sedes') {
                      echo "addMarker($lat, $lon, '$nombre', '$direccion');";
                  }
              }
          }
          ?>
      }

      window.onload = initMap;
      </script>

      <!-- Carga de API de Google Maps (coloca tu clave) -->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=TU_CLAVE_AQUI&callback=initMap"></script>

      </body>
      </html>
