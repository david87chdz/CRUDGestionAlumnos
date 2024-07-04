<?php
include("config/biblioteca.php");

if (isset($_POST['loggin'])) {
    $usuario = textOrdenado($_POST["nombre"]);
    $password = strtolower($_POST["contrasenia"]);

    function buscarUsuario($usuario)
    {
        try {
            $sql = "SELECT id_usuario, password, rol FROM usuarios WHERE usuario = :usuario";
            $conexion = conexion();
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $sentencia->execute();

            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    $usuarioEncontrado = buscarUsuario($usuario);

    if ($usuarioEncontrado && password_verify($password, $usuarioEncontrado['password'])) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipo_usuario"] = $usuarioEncontrado['rol'];

        //Creo una cookie
        setcookie("user_name", $usuario, time() + 36000);
        if($usuarioEncontrado['rol']==='root'){
            header("Location: ../Vista/index_root.php");
            exit();
        }else{
            header("Location: ../Vista/index_.php");
            exit();
        }
    } else {
        $error = "Usuario o contraseña no válidos";
        header("Location: ../index.php?error=$error");
    }
}
?>