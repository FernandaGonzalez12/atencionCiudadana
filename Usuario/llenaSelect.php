<?php
    require_once("../Modelo/Rol.php");
    $obj = new Rol();
    $tuplas = $obj->Consultar();
    foreach ($tuplas as $tupla){
        $id = $tupla['idrol'];
        $nom = $tupla['nomrol'];
        echo "<option value='$id'>$nom</option>";
    }
?>
