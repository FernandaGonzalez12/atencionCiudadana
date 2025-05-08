<?php
    require "../Utilerias/conexion.php";

    class Usuario 
    {
        public function __construct()
        {

        }

        public function Insertar(&$post)
        {
            if  (!isset($_SESSION))
                session_start();
            $corr = $post['corr'];
            $nom = $post['nom'];
            $contra = $post['contra'];
            $pwdEnc = password_hash($contra, PASSWORD_DEFAULT);
            $idrol = $post['idrol'];
            $sentencia = "INSERT INTO usuario(corrusr,nomusr,contrasena,idrol) values('$corr','$nom','$pwdEnc','$idrol')";
        
            $id = EjecutaConsecutivo($sentencia);
            $post['idusr']=$id;
            $post['contra']=$pwdEnc;
            return $id;
        }

        public function Actualizar(&$post)
        {
            $idusr = $post['idusr'];
            $corr = $post['corr'];
            $nom = $post['nom'];
            $contra = $post['contra'];
            $idrol = $post['idrol'];
            if (strlen($contra) <= 40){
                $pwdEnc = password_hash($contra, PASSWORD_DEFAULT);
                $sentencia = "UPDATE usuario SET nomusr='$nom', contrasena='$pwdEnc', idrol=$idrol, corrusr='$corr' WHERE idusr=$idusr";
                $post['contra'] = $pwdEnc;
            }
            else{
                $sentencia = "UPDATE usuario SET nomusr='$nom', contrasena='$contra', idrol=$idrol, corrusr='$corr' WHERE idusr=$idusr";
            }
            
            //$sentencia = "UPDATE usuario SET nomusr='$nom', contrasena='$contra', idrol=$idrol, corrusr='$corr', idsede='$idsede' WHERE idusr=$idusr";
            return Ejecuta($sentencia);
        }

        public function Eliminar($post)
        {
            $idusr = $post['idusr'];
            $sentencia = "DELETE FROM usuario WHERE idusr=$idusr";
            return Ejecuta($sentencia);
        }

        public function Consultar()
        {
            if  (!isset($_SESSION))
                session_start();
            $query = "SELECT idusr,corrusr,nomusr,contrasena,A.idrol,nomrol FROM usuario A Inner Join rol B on (A.idrol = B.idrol) ORDER BY nomusr";    
            return Consulta($query);
        }

        public function ValidaOpcion($idopc){
            if  (!isset($_SESSION))
                session_start();
            $ip = $_SERVER['REMOTE_ADDR'];
            $idSess = session_id() . $ip;
            $corr = $_SESSION["correo"];
            $query = "SELECT  opcmenu FROM usuario A inner Join perfil B On (A.idrol = B.idrol) 
                 Inner Join opcmenu C On (B.idopcmenu = C.idopcmenu)
            WHERE corrusr='$corr' and session= '$idSess' and C.opcmenu='$idopc'";
            //var_dump($query);
            //die("Muere");
            $res = Consulta($query);
            $opc = "";
            foreach ($res as $tupla)
            {
                $opc = $tupla["opcmenu"];
            }
            return $opc;
        }
        
        public function ValidaUsr($post, $ids, &$idrol){
            $corr = $post['usr'];
            $contra = $post['contra'];
            $query = "SELECT idusr,corrusr,nomusr,contrasena,idrol   
            FROM usuario Where corrusr= '$corr'";
            //var_dump($query);
            //die("Murio");
            $res =  Consulta($query);
            $pwdEnc = "";
            foreach ($res as $tupla)
            {
                $pwdEnc = $tupla['contrasena'];
                $idrol = $tupla['idrol'];
            }
            if (password_verify($contra, $pwdEnc) ){ 
                if  (!isset($_SESSION))
                    session_start(); 
                $ip = $_SERVER['REMOTE_ADDR'];
                $sentencia = "Update usuario set session='{$ids}{$ip}' where corrusr= '$corr'";
                return Ejecuta($sentencia);
            }
            else{
                return 0;   
            }
        }
    }
?>