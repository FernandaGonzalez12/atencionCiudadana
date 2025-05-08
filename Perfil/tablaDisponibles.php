<?php
      require_once("../Modelo/Perfil.php");
      $idrol = $_GET["idr"];
      $obj = new Perfil();
      $tuplas = $obj->opcDisponibles($idrol);
      echo "<table id='disp' class='highlight bordered dataTable'>
      <thead>
          <tr><th>Identificador</th><th>Nombre Menu</th><th>Clic para agregar</th><th></th></tr>
      </thead>
      <tbody>
";
      foreach ($tuplas as $tupla){
          $idopcmenu = $tupla['idopcmenu'];  
          $idmenu = $tupla['opcmenu'];
          $nommenu = $tupla['nomopcmenu'];
          echo "<tr id='$idopcmenu'><td>$idmenu</td><td>$nommenu</td><td>
<i class='material-icons inserta' data-idopc='$idopcmenu' data-idmenu='$idmenu' data-nommenu='$nommenu'>check</i></td></tr>";
      }
      echo "</table>";
?>