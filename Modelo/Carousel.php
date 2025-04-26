<?php
require_once("../Utilerias/conexion.php"); // 

class Carousel {
    private $cn;

    public function __construct() {
        global $Cn; // Se obtiene la conexión global
        $this->cn = $Cn; // Se asigna la conexión a la propiedad de la clase
    }

    public function obtenerImagenes() {
        try {
            $sql = "SELECT imagen FROM Carousel"; 
            $stmt = $this->cn->prepare($sql); 
            $stmt->execute(); 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error en obtenerImagenes: " . $e->getMessage()); 
        }
    }
}
?>