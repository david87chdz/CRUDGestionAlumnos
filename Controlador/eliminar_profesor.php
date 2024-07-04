<?php

    session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}
?>
<?php
    include("config/biblioteca.php");
    $conexion=conexion();
 
    $id=$_GET["id"];

    if(!isset($id)){
        exit("No hay id");
    }

    $consultaDelete=$conexion->prepare("delete from tutores where id_tutor=:id");
    $consultaDelete->bindParam(":id",$id,PDO::PARAM_INT);
    $consultaDelete->execute();
    
    header("Location: ../Vista/listar_profesor.php");

    desconexion($conexion);
?>