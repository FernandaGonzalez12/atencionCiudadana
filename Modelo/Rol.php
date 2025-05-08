<?php
    require "../Utilerias/conexion.php";

    class Rol 
    {
        public function __construct()
        {

        }

        public function Insertar(&$post)
        {
            $idr = $post['idr'];
            $nom = $post['nomr'];
            $sentencia = "INSERT INTO rol(nomrol) values('$nom')";
            $post['idr'] = EjecutaConsecutivo($sentencia);
            return $post['idr'];
        }

        public function Actualizar($post)
        {
            $idr = $post['idr'];
            $nom = $post['nomr'];
            $sentencia = "UPDATE rol SET nomrol='$nom' WHERE idrol=$idr";
            return Ejecuta($sentencia);
        }

        public function Eliminar($post)
        {
            $idr = $post['idr'];
            $sentencia = "DELETE FROM rol WHERE idrol=$idr";
            return Ejecuta($sentencia);
        }

        public function Buscar($idr)
        {
            $query = "Select idrol,nomrol from rol Where idrol=$idr";
            return Consulta($query);
        }

        public function Consultar()
        {
            $query = "Select idrol,nomrol from rol Order by nomrol";
            return Consulta($query);
        }
    }
?>