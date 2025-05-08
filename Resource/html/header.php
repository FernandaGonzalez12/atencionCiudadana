<?php 
    if  (!isset($_SESSION)){
      session_start();
      $corr = "";
    }
    $corr = isset($_SESSION["correo"])?$_SESSION["correo"]:"";
    $idrol = isset($_SESSION["rol"])?$_SESSION["rol"]:"";
    $img = isset($_SESSION["imagen"])?$_SESSION["imagen"]:"";
    $idSess = session_id();
?>
<header>
<?php
    if ($idrol == "")
    {
      //<!-- Dropdown Structure 1-->
      //<!-- Dropdown Structure 2-->
      echo "<ul id='dropdown1' class='dropdown-content'>
            </ul>
            <ul id='dropdown2' class='dropdown-content'>
            </ul>";
    }
    else
    {
      require_once("../Modelo/Perfil.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new Perfil();
      $tuplas = $obj->opcAsignadas($idrol);
      $idDD = 1;
     // var_dump($tuplas);
     // die('Murio');
      foreach ($tuplas as $tupla){
          $idopcm = $tupla['idopcmenu'];   
          $opcm = $tupla['opcmenu'];  
          $nomopcm = $tupla['nomopcmenu'];
          $iddd = $tupla['iddropdown'];
          if ($iddd == 1){
            if ($idDD == 1){
              echo "<ul id='dropdown1' class='dropdown-content'>";
              $idDD = 2;
            }
            echo "<li><a href='../$nomopcm/'>$nomopcm</a></li>";
          }
          else{
            if ($iddd == 2){
              if ($idDD == 2){
                echo "</ul>";
                echo "<ul id='dropdown2' class='dropdown-content'>";
                $idDD = 3;
              }
              echo "<li><a href='../$nomopcm/'>$nomopcm</a></li>";
            }
          }
      }// fin del foreach
      echo "</ul>";
    }
?>
  <!-- Dropdown Structure: Reportes -->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="#">Falta de Agua</a></li>
    <li><a href="#">Falta de Luz</a></li>
    <li><a href="#">Seguridad</a></li>
    <li><a href="#">Vialidad</a></li>
  </ul>

  <!-- Dropdown Structure: Servicios -->
  <ul id="dropdown2" class="dropdown-content">
    <li><a href="#">Pagos en Línea</a></li>
    <li><a href="#">Trámites</a></li>
    <li><a href="#">Atención</a></li>
    <li><a href="https://es.wikipedia.org" target="_blank">Wikipedia</a></li>
  </ul>

  <!-- Barra de navegación -->
  <nav class="indigo darken-4">
    <div class="nav-wrapper">
      <a href="../Home/" class="brand-logo">Atención Ciudadana</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Reportes<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Servicios<i class="material-icons right">arrow_drop_down</i></a></li>
        <?php
          if ($corr == "")
             echo "<li><a href='../Acceso/''>Iniciar sesión</a></li>";
          else
             echo "<li><a href='../Acceso/destruir.php''>$corr(Cerrar)</a></li>";
        ?>
      </ul>
    </div>
  </nav>

  <!-- Menú lateral -->
  <ul id="slide-out" class="sidenav">
    <li>
      <div class="user-view">
      <?php
                if ($img == "")
                    echo "<a href='#user'><img class='circle' src='../Imagenes/logo1.png'></a>";
                else
                    echo "<a href='#user'><img class='circle' src='$img'></a>";
                echo "<a href='#name'><span class='black-text name'>Atencion Ciudadana</span></a>
                <a href='#email'><span class='black-text email'>$corr</span></a>";
              ?>
    </div>
  </li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Reportes</a></li>
    <li><a href="../Categorias">Falta de Agua</a></li>
    <li><a href="#">Falta de Luz</a></li>
    <li><a href="#">Seguridad</a></li>
    <li><a href="#">Vialidad</a></li>
    <li class="divider"></li>
    <li><a class="subheader">Servicios</a></li>
    <li><a href="#">Pagos en Línea</a></li>
    <li><a href="#">Trámites</a></li>
    <li><a href="#">Atención</a></li>
    <li><a href="https://es.wikipedia.org" target="_blank">Wikipedia</a></li>
    <?php
        $idDD = 1;
        foreach ($tuplas as $tupla){
            $idopcm = $tupla['idopcmenu'];   
            $opcm = $tupla['opcmenu'];  
            $nomopcm = $tupla['nomopcmenu'];
            $iddd = $tupla['iddropdown'];
            if ($iddd == 1){
              if ($idDD == 1){
                echo "<li><div class='divider'></div></li>
                      <li><a class='subheader'>Control de accesos</a></li>";        
                $idDD = 2;
              }
              echo "<li><a href='../$opcm/'>$opcm</a></li>";
            }
            else{
              if ($iddd == 2){
                if ($idDD == 2){
                  echo "<li class='divider'></li>";
                  $idDD = 3;
                }
                echo "<li><a href='../$opcm/'>$opcm</a></li>";
              }
            }
        }// fin del foreach
        echo "</ul>";
    ?>
  </ul>

  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
</header>
<style>
   .sidenav-trigger i {
            color:  rgba(249, 244, 244, 0.99) !important;
        }
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
  </style>