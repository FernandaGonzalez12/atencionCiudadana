<?php
    require_once("../Modelo/Menu.php");
    $obj = new Menu();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
        $post['idopc'] = isset($post['idopc']) ? limpiarCadena($post['idopc']):"";
        $post['idm'] = isset($post['idm']) ? limpiarCadena($post['idm']):"";
        $post['nomm'] = isset($post['nomm']) ? limpiarCadena($post['nomm']):"";

        $accion = $post["accion"];
        if ($accion == "Insertar") $result = $obj->Insertar($post);
        if ($accion == "Actualizar") $result = $obj->Actualizar($post);
        if ($accion == "Eliminar") $result = $obj->Eliminar($post);
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