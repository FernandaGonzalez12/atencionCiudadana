<?php
      require_once("../Modelo/Usuario.php");
      $obj = new Usuario();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idusr = $tupla['idusr'];  
          $nom = $tupla['nomusr'];
          echo "<option value='$idusr'>$nom</option>";
      }
?>
