<?php
//---------------------------------------------------------------------
// Acceso a Bases de Dato
// Nombre: Fernanda Gonzalez
// Enero 2025
//---------------------------------------------------------------------
require_once("global.php"); // Importamos variables BD
try{
    $Cn = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $Cn->exec("SET CHARACTER SET " . DB_ENCODE);  // MYSQL
}catch(Exception $e){ 
    die("Error: " . $e->GetMessage());
}

// Si No Existe la función Consulta, creamos todas las funciones
// por que no existen
if (! function_exists('Consulta'))
{
    // Esta función recibe una consulta y la manda ejecutar a la base de datos
    // regresando un arreglo asociativo con las tuplas resultantes
    function Consulta($query)
    {
        global $Cn;
        try{    
            //var_dump($query);
            $result =$Cn->query($query);
            $resultado = $result->fetchAll(PDO::FETCH_ASSOC); 
            $result->closeCursor();
            return $resultado;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }
    }

    // Función que recibe un insert y regresa el consecutivo que le genero
    // en la llave primaria Autonumerica
    // por ejemplo: Insert Into clasif (nomclasif) values ('Articulo en Extenso') 
    // retorna autonumerico en el id;
    function EjecutaConsecutivo($sentencia){
        global $Cn;
        try {
            $result = $Cn->query($sentencia);
            $id = $Cn->lastInsertId(); // Regresa el valor autonumerico asignado al insertar
            $result->closeCursor();
            return $id;
        } catch (Exception $e) {
            die("Error en la linea: " + $e->getLine() + " MSG: " + $e->GetMessage());
            return 0;
        }
    }

    // Sirve para ejecutar una sentencia INSERT, UPDATE O DELETE
    function Ejecuta ($sentencia){
        global $Cn;
        try {
            $result = $Cn->query($sentencia);
            $result->closeCursor();
            return 1; // Exito  
        } catch (Exception $e) {
            //die("Error en la linea: " + $e->getLine() + " MSG: " + $e->GetMessage());
            return 0; // Fallo
        }
    }
    // Función para limpiar un string de caracteres especiales y palabras reservadas
    function limpiarCadena($str)
    {
        global $Cn;
        $data = trim($str);
        $data = str_replace("'", "", $data);
        $data = str_replace(" or ", "", $data);
        $data = str_replace(" OR ", "", $data);
        $data = str_replace(" select ", "", $data);
        $data = str_replace(" SELECT ", "", $data);
        $data = str_replace(" Select ", "", $data);
        $data = str_replace(" drop ", "", $data);
        $data = str_replace(" DROP ", "", $data);
        $data = str_replace(" Drop ", "", $data);
        $data = str_replace(" update ", "", $data);
        $data = str_replace(" UPDATE ", "", $data);
        $data = str_replace(" delete ", "", $data);
        $data = str_replace(" DELETE ", "", $data);
        $data = str_replace(" Delete ", "", $data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>