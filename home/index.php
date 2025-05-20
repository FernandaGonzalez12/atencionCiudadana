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
    <link type="text/css" rel="stylesheet" href="../css/carousel.css"/>
        <link type="text/css" rel="stylesheet" href="../css/home.css"/>

</head>

<body>
<?php include_once("../Resource/html/header.php");?>

<!-- Sección Hero -->
<section class="section center-align bienvenida">
  <div class="container">
    <h4 class="titulo">¡Tu voz cuenta!</h4>
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

<!-- Íconos de servicios -->
<div class="container">
  <div class="row center">
    <div class="col s12 m4">
      <i class="material-icons large blue-text">report_problem</i>
      <h5>Reporta</h5>
      <p>Registra fallas en servicios como alumbrado, basura, fugas, etc.</p>
    </div>
    <div class="col s12 m4">
      <i class="material-icons large green-text">visibility</i>
      <h5>Da seguimiento</h5>
      <p>Consulta el estado de tus reportes en tiempo real.</p>
    </div>
    <div class="col s12 m4">
      <i class="material-icons large orange-text">groups</i>
      <h5>Participa</h5>
      <p>Colabora con tu comunidad y mejora tu entorno.</p>
    </div>
  </div>
</div>

<!-- Mapa de ubicaciones -->
<section class="section grey lighten-4">
  <div class="container">
    <h5 class="center blue-text">Ubicación de Dependencias</h5>
    <div id="map" style="width: 100%; height: 400px;"></div>
  </div>
</section>

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
