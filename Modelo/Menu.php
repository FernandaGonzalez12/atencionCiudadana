<?php
    require "../Utilerias/conexion.php";

    class Menu 
    {
        public function __construct()
        {

        }

        public function Insertar(&$post)
        {
            $idm = $post['idm'];
            $nomm = $post['nomm'];
            $sentencia = "INSERT INTO opcmenu(opcmenu,nomopcmenu) values ('$idm','$nomm')";
            $post['idopc'] = EjecutaConsecutivo($sentencia);
            return $post['idopc'];
        }

        public function Actualizar($post)
        {
            $idopc = $post['idopc'];
            $idm = $post['idm'];
            $nomm = $post['nomm'];
            $sentencia = "UPDATE opcmenu SET opcmenu='$idm', nomopcmenu='$nomm'WHERE idopcmenu=$idopc";
            return Ejecuta($sentencia);
        }

        public function Eliminar($post)
        {
            $idopc = $post['idopc'];
            $sentencia = "DELETE FROM opcmenu WHERE idopcmenu=$idopc";
            return Ejecuta($sentencia);
        }

        public function Consultar()
        {
            $query = "SELECT idopcmenu,opcmenu,nomopcmenu FROM opcmenu ORDER BY nomopcmenu";
            return Consulta($query);
        }
    }
?>