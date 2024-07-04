<?php
if(!$_SESSION){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}

?>
<?php

    include("config/conexionPDO.php");
    $conexion=conexion();

    $id=$_GET["id"];

    if(!isset($id)){
        exit("No hay id");
    }

    $consultaDelete=$conexion->prepare("delete from proyectos where id_proyecto=:id");
    $consultaDelete->bindParam(":id",$id, PDO::PARAM_INT);
    $consultaDelete->execute();
    
    header("Location: ../Vista/listar_proyecto.php");

    desconexion($conexion);
?>