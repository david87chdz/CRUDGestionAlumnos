<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}

include("config/biblioteca.php");
$conexion=conexion();
 
$id=$_GET["id"];

if(!isset($id)){
    exit("No hay id");
}

    $consultaDelete=$conexion->prepare("delete from alumnos where id_alumno=:id");
    $consultaDelete->bindParam(":id",$id,PDO::PARAM_INT);
    $consultaDelete->execute();
    
    header("Location: ../Vista/listar_alumno.php");

    desconexion($conexion);
?>