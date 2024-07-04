<?php
if(!$_SESSION){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}
?>
<?php
    //Conectamos a la base de datos
    //include("../Config/conexionPDO.php");
    include("Config/biblioteca.php");
    $id=$_POST["id"];
    //$dni=dni($_POST["dni"]);
    $dni=$_POST["dni"];
    $nuevoDni=$_POST["nuevoDni"];
    if($nuevoDni!=""){
        $nuevoDni=limpiarDni($nuevoDni);
        if($nuevoDni===false){
            header("Location: ../Vista/listar_profesor.php?errorFormato=true");
            exit;
        }
        if (!verificarLetraDNI($nuevoDni)) {
            header("Location: ../Vista/listar_profesor.php?errorLetra=true");
            exit;
        }
    }
    $nombre=textOrdenado($_POST["nombre"]);
    $apellido1=textOrdenado($_POST["apellido1"]);
    $apellido2=textOrdenado($_POST["apellido2"]);
    $email=strtolower($_POST["email"]);
    $telefono=$_POST["telefono"];

    if($nuevoDni==""){
        try{
        $sql="update tutores set
        nombre=:nombre, apellido1=:apellido1, apellido2=:apellido2, email=:email, telefono=:telefono
        where id_tutor=:id_tutor";
        $consultaUpdate=$conexion->prepare($sql);
        $consultaUpdate=$conexion->prepare($sql);
        $consultaUpdate->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":email", $email, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":id_tutor", $id, PDO::PARAM_INT);
        $consultaUpdate->execute();
        }catch(PDOException $e){
            $e->getMessage();
        }
        header("Location: ../Vista/listar_profesor.php");
    }else{
        if(buscarDni("dni","profesores",$nuevoDni)){
            header("Location: ../Vista/errorDuplicado_profesor.php");
            exit;
        }else{
            $dni=$nuevoDni;
            try{
                $sql="update tutores set dni=:dni,
                nombre=:nombre, apellido1=:apellido1, apellido2=:apellido2, email=:email, telefono=:telefono
                where id_tutor=:id_tutor";
                $consultaUpdate=$conexion->prepare($sql);
                $consultaUpdate=$conexion->prepare($sql);
                $consultaUpdate->bindParam(":dni", $dni, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":email", $email, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":telefono", $telefono, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":id_tutor", $id, PDO::PARAM_INT);
                $consultaUpdate->execute();
                }catch(PDOException $e){
                    $e->getMessage();
                }
            header("Location: ../Vista/listar_profesor.php");     
        }
    }
?>

    
    
