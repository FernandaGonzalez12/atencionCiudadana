<?php
    require "../utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class Categoria
    {
        public function __construct()
        {

        }
        // Método insertar, recibe el arreglo asociativo post por referencia de manera 
        // que se modifica el idc colocando el idclasif que genero la base
        // de datos por ser autonumerico y regresa el arreglo post ya modificado
        public function Insertar(&$post)
        {
            $nom = $post['nomc'];
            $desc = $post['descc'];
            $sentencia = "Insert into categorias(nombre,descripcion) values ('$nom','$desc')";
            //var_dump($sentencia);
            //die("Murio");
            $post['idcla'] = EjecutaConsecutivo($sentencia);
            return $post['idcla'];
        }
        // Método actualizar, recibe el arreglo asociativo post por valor, el cual contiene
        // los nombres de las cajas de texto y sus valores
        public function Actualizar($post)
        {
            $idc = $post['idcla'];
            $nom = $post['nomc'];
            $desc = $post['descc'];
            $sentencia = "Update categorias set nombre='$nom',descripcion='$desc' Where id_categoria=$idc";
            return Ejecuta($sentencia);
        }
        // Método eliminar, recibe un arreglo asociativo con el idc a elimnar 
        public function Eliminar($post)
        {
            $idc = $post['idcla'];
            $sentencia = "Delete From categorias Where id_categoria=$idc";
            return Ejecuta($sentencia);
        }
        // Método consultar
        public function Consultar()
        {
            $query = "Select id_categoria,nombre,descripcion From categorias Order by nombre";
            return Consulta($query);
        }
    }
?>