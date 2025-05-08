<?php
    require_once("../Modelo/Rol.php");
    $rol = new Rol();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
        $post["idr"] = isset($post["idr"]) ? limpiarCadena($post["idr"]):"";
        $post["nomr"] = isset($post["nomr"]) ? limpiarCadena($post["nomr"]):"";
        
        $accion = $post["accion"];
        if ($accion == "Insertar") $result = $rol->Insertar($post);
        if ($accion == "Actualizar") $result = $rol->Actualizar($post);
        if ($accion == "Eliminar") $result = $rol->Eliminar($post);
        if ($result){
            $response['status']=1; 
            $response['data']=$post; 
        }
        else{
                $response['status']=0; 
                $response['data']=$post;
        }
    }
    else{
        $response['status']=0; 
        $response['data']=$post; 
   }
   echo json_encode($response);     
?>