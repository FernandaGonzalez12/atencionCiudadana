<?php
    require_once("../Modelo/Categorias.php");
    $obj = new Categoria();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      //  var_dump($post);
      //  die("Murio");
        $post['idcla'] = isset($post['idcla']) ? limpiarCadena($post['idcla']):"";
        $post['nomc'] = isset($post['nomc']) ? limpiarCadena($post['nomc']):"";
        $post['descc'] = isset($post['descc']) ? limpiarCadena($post['descc']):"";

        $accion = $post["accion"];
        if ($accion == "Ins") $result = $obj->Insertar($post);
        if ($accion == "Act") $result = $obj->Actualizar($post);
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