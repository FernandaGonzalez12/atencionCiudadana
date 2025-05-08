<?php
      require_once("../Modelo/Categorias.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new Categoria();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idc = $tupla['id_categoria'];  
          $nomc = $tupla['nombre'];
          $descc = $tupla['descripcion'];
          echo "<tr id='$idc'><td>$nomc</td><td>$descc</td><td>
<i class='material-icons edit' data-idc='$idc' data-nomc='$nomc' data-descc='$descc'>create</i>
<i class='material-icons delete' data-idc='$idc'>delete_forever</i></td></tr>";
      }
?>