<?php
if(!$_SESSION){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}
?>
<?php

include("Config/biblioteca.php");

$conexion = conexion();

$dni=$_POST["dni"];

$dni=limpiarDni($dni);

if($dni===false){
    header("Location: {$_SERVER['HTTP_REFERER']}?errorFormato=true");
    exit;
};

if (!verificarLetraDNI($dni)) {
    header("Location: {$_SERVER['HTTP_REFERER']}?errorLetra=true");
    exit;
};
$nombre=textOrdenado($_POST["nombre"]);
$apellido1=textOrdenado($_POST["apellido1"]);
$apellido2=textOrdenado($_POST["apellido2"]);
$email =strtolower($_POST["email"]);
$telefono = $_POST["telefono"];



if (!buscarDni($conexion, "dni", "tutores", $dni)) {
    try{

    $sql="insert into tutores(dni, nombre, apellido1, 
    apellido2, email, telefono) values(:dni,:nombre,:apellido1,:apellido2,:email,:telefono)";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindParam(":dni", $dni, PDO::PARAM_STR);
    $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $sentencia->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
    $sentencia->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
    $sentencia->bindParam(":email", $email, PDO::PARAM_STR);
    $sentencia->bindParam(":telefono", $telefono, PDO::PARAM_STR);


    if ($sentencia->execute()) {
        header("Location: ../Vista/listar_profesor.php");
    } else {

        echo "Error, No hay datos que mostrar";
    }
    }catch (PDOException $e){
        echo $e->getMessage();
    }

} else {
    header("Location: ../Vista/errorDuplicado_profesor.php");
}

desconexion($conexion);
