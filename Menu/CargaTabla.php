<?php
      require_once("../Modelo/Menu.php");
      $obj = new Menu();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idopcmenu = $tupla['idopcmenu'];  
          $idmenu = $tupla['opcmenu'];
          $nommenu = $tupla['nomopcmenu'];
          echo "<tr id='$idopcmenu'><td>$idmenu</td><td>$nommenu</td><td>
<i class='material-icons edit' data-idopc='$idopcmenu' data-idmenu='$idmenu' data-nommenu='$nommenu'>create</i>
<i class='material-icons delete' data-idopc='$idopcmenu'>delete_forever</i></td></tr>";
      }
?>
