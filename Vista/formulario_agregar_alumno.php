<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario'])) {
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}

if ($_SESSION['tipo_usuario'] === 'alumno') {
    header("Location: listar_alumno.php?error=Como alumno no puedes agregar");
    exit();
}

if (isset($_GET['errorLetra'])) {
    echo "<script>alert('La letra del DNI no es correcta.');</script>";
}

if (isset($_GET['errorFormato'])) {
    echo "<script>alert('El formato del DNI no es correcto.');</script>";
}

$titulo = "Agregar alumnos"; 
$estilo= "css/estiloForm.css";
include("encabezado.php");

?>
<a href="listar_alumno.php"><button>Volver<br><img src="img/volver.png" width="20px"></button></a>
<a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>

<form action="../Controlador/agregar_alumno.php" method="post">
    <label for="dni">
    <p>Numero DNI:</p><input type="text" name="dni" required>
    </label>
    <label for="nombre">
    <p>Nombre:</p> <input type="text" name="nombre" id="nombre" required>
    </label>
    <label for="apellido">
    <p>Apellido1: </p><input type="text" name="apellido1" id="apellido1" required>
    </label>
    <label for="apellido2">
    <p>Apellido2: </p><input type="text" name="apellido2" id="apellido2">
    </label>
    <label for="email">
    <p>Email: </p><input type="email" name="email" id="email">
    </label>
    <label for="telefono">
    <p>Telefono: </p><input type="text" name="telefono" id="telefono">
    </label>
    <label for="curso">
    <p>Curso:</p> <input type="number" name="curso" id="curso" value="2023">
    </label>
    <label for="enviar">
        <p><input type="submit" value="Enviar"></p>
    </label>
</form>

<?php
include("pie.html");
?>