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
    $id=$_POST["id"];
    $dni=dni($_POST["dni"]);
    $nuevoDni=$_POST["nuevoDni"];
    if($nuevoDni!=""){
        $nuevoDni=limpiarDni($nuevoDni);
        if($nuevoDni===false){
            header("Location: ../Vista/listar_alumno.php?errorFormato=true");
            exit;
        }
        if (!verificarLetraDNI($nuevoDni)) {
            header("Location: ../Vista/listar_alumno.php?errorLetra=true");
            exit;
        }
    }
    $nombre=textOrdenado($_POST["nombre"]);
    $apellido1=textOrdenado($_POST["apellido1"]);
    $apellido2=textOrdenado($_POST["apellido2"]);
    $email=strtolower($_POST["email"]);
    $telefono=$_POST["telefono"];
    $curso=$_POST["curso"];

    if($nuevoDni==="" || $nuevoDni===$dni){
        try{
        $sql="update alumnos set
        nombre=:nombre, apellido1=:apellido1, apellido2=:apellido2, email=:email, telefono=:telefono, curso=:curso
        where id_alumno=:id_alumno";
        $consultaUpdate=$conexion->prepare($sql);
        $consultaUpdate=$conexion->prepare($sql);
        $consultaUpdate->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":email", $email, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":curso", $curso, PDO::PARAM_INT);
        $consultaUpdate->bindParam(":id_alumno", $id, PDO::PARAM_INT);
        $consultaUpdate->execute();
        }catch(PDOException $e){
            $e->getMessage();
        }
        header("Location: ../Vista/listar_alumno.php");
    }else{
        if(buscarDni("dni", "alumnos", $nuevoDni)){
            header("Location: ../Vista/errorDuplicado_alumno.php");
            exit;
        }else{
            $dni=$nuevoDni;
            try{
                $sql="update alumnos set dni=:dni,
                nombre=:nombre, apellido1=:apellido1, apellido2=:apellido2, email=:email, telefono=:telefono, curso=:curso
                where id_alumno=:id_alumno";
                $consultaUpdate=$conexion->prepare($sql);
                $consultaUpdate=$conexion->prepare($sql);
                $consultaUpdate->bindParam(":dni", $dni, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":email", $email, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":telefono", $telefono, PDO::PARAM_STR);
                $consultaUpdate->bindParam(":curso", $curso, PDO::PARAM_INT);
                $consultaUpdate->bindParam(":id_alumno", $id, PDO::PARAM_INT);
                $consultaUpdate->execute();
                }catch(PDOException $e){
                    $e->getMessage();
                }
            header("Location: ../Vista/listar_alumno.php");     
        }
    }
?>

    
    
