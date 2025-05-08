<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />
</head>
<body>
<?php
       require_once("../Modelo/Usuario.php");
       $idopc = "opcPerfil";
       $obj = new Usuario();
       $res = $obj->ValidaOpcion($idopc);
       if ($res == "")
            header("location:../Acceso/");
       else    
            include_once("../Resource/html/header.php");        
?>

<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <select name="idrol" id="idrol">
                <?php include_once("./llenaSelect.php"); ?>
            </select>
            <label for="idrol">Rol de Seguridad:</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Opciones Asignadas al Rol del Usuario</span>
                    <div id="asignadas">     
        
                    </div>  
                </div>
            </div>        
        </div>
    </div>    

    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Opciones Disponibles del Menu</span>
                    <div id="disponibles">
                    
                    </div>    
                </div>
            </div>
        </div>
    </div>  
</div>    
<?php include_once("../Resource/html/footer.php"); ?>

<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script> 
    <script type="text/javascript" src="./ValidaPerfil.js"></script>    
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').formSelect();
            $('.sidenav').sidenav();
            $(".dropdown-trigger").dropdown();
        });
        
    </script> 
</body>
</html>