<?php
    require_once("../Modelo/Perfil.php");
    $obj = new Perfil();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
        $post['ido'] = isset($post['ido']) ? limpiarCadena($post['ido']):"";
        $post['idr'] = isset($post['idr']) ? limpiarCadena($post['idr']):"";
        
        $accion = $post["accion"];
        if ($accion == "Insertar") $result = $obj->insertarPerfil($post);
        if ($accion == "Eliminar") $result = $obj->eliminaPerfil($post);
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