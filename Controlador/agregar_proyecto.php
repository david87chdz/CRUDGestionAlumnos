<?php
if(!$_SESSION){
    session_start();
}
if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}

include("Config/biblioteca.php");

$conexion = conexion();
$titulo=limpiarTexto(trim($_POST["titulo"]));
$descripcion=limpiarTexto(trim($_POST["descripcion"]));
$ciclo=$_POST["ciclo"];
$modulo1=$_POST["modulo1"];
$modulo2=$_POST["modulo2"];
$modulo3=$_POST["modulo3"];
if(!isset($_POST["convocatoria"])){
    $convocatoria="";
}else{
    $convocatoria=$_POST["convocatoria"];
}
$exposicion=$_POST["exposicion"];
$nota=$_POST["nota"];
$alumno = $_POST["alumno"];
$campo="titulo";


if (!buscarTitulo("titulo", $titulo)) {
    try{

    $sql="insert into proyectos (titulo, descripcion, ciclo, 
    modulo1, modulo2, modulo3, convocatoria, fecha_exposicion, nota, alumno) 
    values(:titulo,:descripcion,:ciclo,:modulo1,:modulo2,:modulo3,:convocatoria
     ,:fecha_exposicion,:nota, :alumno)";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindParam(":titulo", $titulo, PDO::PARAM_STR);
    $sentencia->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
    $sentencia->bindParam(":ciclo", $ciclo,PDO::PARAM_STR);
    $sentencia->bindParam(":modulo1", $modulo1, PDO::PARAM_STR);
    $sentencia->bindParam(":modulo2", $modulo2, PDO::PARAM_STR);
    $sentencia->bindParam(":modulo3", $modulo3, PDO::PARAM_STR);
    $sentencia->bindParam(":convocatoria", $convocatoria, PDO::PARAM_STR);
    $sentencia->bindParam(":fecha_exposicion", $exposicion, PDO::PARAM_STR);
    $sentencia->bindParam(":nota", $nota, PDO::PARAM_INT);
    $sentencia->bindParam(":alumno", $alumno, PDO::PARAM_INT);

    if ($sentencia->execute()) {
        header("Location: ../Vista/listar_proyecto.php");
    } else {

        echo "Error, No hay datos que mostrar";
    }
    }catch (PDOException $e){
        echo $e->getMessage();
    }

} else {
    header("Location: ../Vista/errorDuplicado_proyecto.php");
}

desconexion($conexion);
