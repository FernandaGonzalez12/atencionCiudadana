<?php
      require_once("../Modelo/Categorias.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new Categoria();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idc = $tupla['id_categoria'];  
          $nomc = $tupla['nombre'];
          echo "<option value='$idc'>$nomc</option>";
      }
?>