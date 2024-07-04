<?php
session_start();
include("Config/biblioteca.php");


if ($_SESSION['tipo_usuario'] === 'root') {
    $password=$_POST['password'];
    $usuario=$_POST['usuario'];
    $rol=$_POST["rol"];
    if(aniadirUsuarios($password, $usuario, $rol)){
        header("Location: ../Vista/introducir_usuarios.php?aceptado=true");
    }
}else{
    if(aniadirUsuarios("luis", "luis", "alumno")){
        header("Location: ../index.php?aceptado=true");
    };
}
?>