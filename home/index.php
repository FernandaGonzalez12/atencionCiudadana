<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AtencionCiudadana</title>
    <!-- Importa librerias de estilos de Materialize, DataTable e Iconos -->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    
    <style>
           .carousel {
            height: 600px;
        }
        .carousel .carousel-item {
            width: 100%;
            height: 100%;
        }
        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
<?php include_once("../Resource/html/header.php");?>
<!-- Colocar su código a partir de este comentario -->
<!--Seccion del carousel consultando las imagenes directamente de la BD-->
<section>
    <div class="carousel carousel-slider">
    <?php
        require_once("../Modelo/Carousel.php"); 
        $objCarousel = new Carousel();
        $imagenes = $objCarousel->obtenerImagenes(); 

        foreach ($imagenes as $img) {
            echo "<a class='carousel-item' href='#!'><img src='" . $img['imagen'] . "'></a>";
        }
        ?>
    </div>
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
</div>
<?php include_once("../Resource/html/footer.php")?>
<!-- Script para carrusel -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.carousel');
        M.Carousel.init(elems, {
            fullWidth: true,
            indicators: true,
            duration: 300,
            noWrap: false
        });

        // Desplazar manualmente al hacer clic
        var carouselInstance = M.Carousel.getInstance(elems[0]);
        document.querySelectorAll('.carousel-item').forEach(item => {
            item.addEventListener('click', () => {
                carouselInstance.next(); // Avanza solo al hacer clic
            });
        });
    });
</script>

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
    <script>
        function initMap() {
            // Coordenadas del centro del mapa
            var latitudInicial = 20.580813;
            var longitudInicial = -100.825980;

            // Crea un nuevo mapa centrado en la ubicación inicial
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitudInicial, lng: longitudInicial},
                zoom: 12  // Ajusta el nivel de zoom según tus preferencias
            });

            // Función para agregar un marcador
            function addMarker(lat, lon, nombre, direccion) {
                var marker = new google.maps.Marker({
                    position: {lat: lat, lng: lon},
                    map: map,
                    title: nombre
                });

                // Crea una instancia de InfoWindow con el contenido del título
                var infowindow = new google.maps.InfoWindow({
                    content: '<h5>' + nombre + '</h5><p>' + direccion + '</p>'
                });

                // Abre el InfoWindow cuando se hace clic en el marcador
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            }

            <?php
            require_once("../Modelo/Sede.php");
            $obj = new Sede();
            $tuplas = $obj->Consultar();

            // Almacena las ubicaciones en un arreglo
            $ubicaciones = array();

            foreach ($tuplas as $tupla) {
                $lon = $tupla['longitud'];
                $lat = $tupla['latitud'];

                // Verifica si las coordenadas no están vacías
                if (!empty($lon) && !empty($lat)) {
                    $idsed = $tupla['idsede'];
                    $noms = $tupla['nomsede'];
                    $doms = $tupla['domsede'];

                    // Agrega los datos de ubicación al arreglo
                    $ubicaciones[] = array(
                        'lat' => $lat,
                        'lon' => $lon,
                        'nombre' => $noms,
                        'direccion' => $doms
                    );
                }
            }

            // Itera sobre las ubicaciones y llama a la función addMarker
            foreach ($ubicaciones as $ubicacion) {
                $lat = $ubicacion['lat'];
                $lon = $ubicacion['lon'];
                $nombre = $ubicacion['nombre'];
                $direccion = $ubicacion['direccion'];
                if ($nombre!='Todas las sedes')
                echo "addMarker($lat, $lon, '$nombre', '$direccion');";
            }
            ?>

        }

        // Inicializa el mapa cuando se carga la página
        window.onload = initMap;
    </script>
</body>
</html>