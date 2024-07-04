<?php
function conexion(){
    $conexion=null;
    $servidor='mysql:dbname=gestion_alumnos;host=localhost';
    $usuario='root';
    $pw="";
    try{
        $conexion = new PDO($servidor,$usuario,$pw);
        //PDO::ATTR_ERRMODE indicándole a PHP que queremos un reporte de errores.
        //PDO::ERRMODE_EXCEPTION con este atributo obligamos a que lance excepciones.
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexion OK <br>";
    }catch(PDOException $e){
        echo "Fallo la conexión: " .$e->getMessage();
        $conexion=null;
    }
    echo "Bienvenid@";
    //Debemos devolver la conexion si no nos da muchos problemas
    return $conexion;
}


function desconexion($conexion){
    $conexion=null;
    echo "Desconectad@ con exito";
    //return $conexion;
}
?>