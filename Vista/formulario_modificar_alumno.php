<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario'])) {
    // No hay sesión, redirige a la página de inicio
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}

if ($_SESSION['tipo_usuario'] === 'alumno') {
    // El tipo de usuario es "alumno", redirige a una página de acceso no permitido o a la página de inicio
    header("Location: listar_alumno.php?error=Como alumno no puedes modificar");
    exit();
}


$titulo = "Actualizar alumno"; // Declarada antes de usar
$estilo= "css/estiloForm.css";
include("encabezado.php");
include("../Controlador/Config/biblioteca.php");


?>
<h1><?= $titulo ?></h1>
<?php
            $id = $_GET["id"];
            $usuario=datosAlumnos($id);
            
        ?>
<a href="listar_alumno.php"><button>Volver<br><img src="img/volver.png" width="20px"></button></a>
<a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
<form action="../Controlador/modificar_alumno.php" method="post">
     <label for="id">
        <input type="hidden" name="id" value="<?= $_GET["id"]?>" >
     </label>  
     <label for="dni">
        <input type="hidden" name="dni" value="<?=$usuario["dni"]?>">
        <p id="primero">DNI actual: <?=$usuario["dni"]?></p>
     </label>     
    <label for="nuevoDni">
    <p>Numero DNI (Solo si se desea cambiar):</p><input type="text"  name="nuevoDni" id="nuevoDni">
    </label>
    <label for="nombre">
    <p>Nombre:</p> <input type="text" name="nombre" id="nombre" value="<?=$usuario["nombre"]?>" required>
    </label>
    <label for="apellido">
    <p>Apellido1: </p><input type="text" name="apellido1" id="apellido1" value="<?=$usuario["apellido1"]?>" required>
    </label>
    <label for="apellido2">
    <p>Apellido2: </p><input type="text" name="apellido2" id="apellido2" value="<?=$usuario["apellido2"]?>" >
    </label>
    <label for="email">
    <p>Email: </p><input type="email" name="email" id="email" value="<?=$usuario["email"]?>" >
    </label>
    <label for="telefono">
    <p>Telefono: </p><input type="text" name="telefono" id="telefono" value="<?=$usuario["telefono"]?>">
    </label>
    <label for="curso">
    <p>Curso:</p> <input type="number" name="curso" id="curso" value="<?=$usuario["curso"]?>" > 
    </label>
    <label for="enviar">
        <p><input type="submit" value="Enviar"></p>
    </label>
   
</form>

<?php
include("pie.html");
?>