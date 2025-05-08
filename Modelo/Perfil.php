<?php
    require "../Utilerias/conexion.php";

    class Perfil 
    {
        public function __construct()
        {

        }

        public function opcAsignadas($idrol)
        {
            $query = "select b.* from perfil a inner join opcmenu b on (a.idopcmenu = b.idopcmenu) where a.idrol=$idrol order by idopcmenu, iddropdown";
            return Consulta($query);
        }

        public function opcDisponibles($idrol)
        {
            $query = "select a.* from opcmenu a where a.idopcmenu not in (select b.idopcmenu from perfil b where b.idrol = $idrol)
            order by nomopcmenu";
            return Consulta($query);
        }

        public function eliminaPerfil($post){
            $idopc = $post['ido'];
            $idrol = $post['idr'];
            $sentencia = "DELETE FROM perfil WHERE idopcmenu=$idopc and idrol=$idrol";
            return Ejecuta($sentencia);
        }

        public function insertarPerfil($post){
            $idopc = $post['ido'];
            $idrol = $post['idr'];
            $sentencia = "INSERT INTO perfil(idrol,idopcmenu) values($idrol,$idopc)";
            return Ejecuta($sentencia);
        }
    }
?>