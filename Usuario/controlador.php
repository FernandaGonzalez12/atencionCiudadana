<?php
    require_once("../Modelo/Usuario.php");
    $obj = new Usuario();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
        $post['idusr'] = isset($post['idusr'])?limpiarCadena($post['idusr']):"";
        $post['corr'] = isset($post['corr'])?limpiarCadena($post['corr']):"";
        $post['nom']= isset($post['nom'])?limpiarCadena($post['nom']):"";
        $post['contra'] = isset($post['contra'])?limpiarCadena($post['contra']):"";
        $post['idrol'] = isset($post['idrol'])?limpiarCadena($post['idrol']):"";
       
        $accion = $post["accion"];
        if ($accion == "Ins") $result = $obj->Insertar($post);
        if ($accion == "Act")  $result = $obj->Actualizar($post);
        if ($accion == "Eli") $result = $obj->Eliminar($post);
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