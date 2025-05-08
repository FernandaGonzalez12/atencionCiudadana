<?php
      require_once("../Modelo/Usuario.php");
      $obj = new Usuario();
      $post = $_POST;
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post['usr'] = limpiarCadena($post['usr']);
            $post['contra'] = limpiarCadena($post['contra']);
            if  (!isset($_SESSION))
                  session_start();
            $idSess = session_id();
      
            //echo "Validando";
            //die("AAAAAAAAAAA");
            $result = $obj->ValidaUsr($post,$idSess,$idrol);
            if ($result){
                  $_SESSION["correo"]=$post["usr"];
                  $_SESSION["rol"]=$idrol;
                  $response['status']=1;
                  $response['data']=$post;
            }
            else{
                  $response['status']=0;
                  $response['data']=$post;
            }
      }
      else
       {
            $response['status']=0; 
            $response['data']=$post; 
       }
      echo json_encode($response);    
?>