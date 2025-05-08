<?php
      require_once("../Modelo/Usuario.php");
      $obj = new Usuario();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idusr = $tupla['idusr'];  
          $corr = $tupla['corrusr'];
          $nom = $tupla['nomusr'];
          $pwd = $tupla['contrasena'];
          $contra = substr($tupla['contrasena'], 0,8);
          $nomrol = $tupla['nomrol'];
          $idrol = $tupla['idrol'];
          
          // el id del <tr es importante para el control del dataTable al
          // momento de eliminar y agregar
          echo "<tr id='$idusr'><td>$corr</td><td>$nom</td><td>$contra</td><td>$nomrol</td><td>
<i class='material-icons edit' data-idusr='$idusr' data-corr='$corr' data-nom='$nom' data-contra='$pwd' data-idrol='$idrol' >create</i>
<i class='material-icons delete' data-idusr='$idusr'>delete_forever</i></td></tr>";
      }
?>
