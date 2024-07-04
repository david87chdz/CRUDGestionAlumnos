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
    header("Location: listar_profesor.php?error=Como alumno no puedes agregar tutor");
    exit();
}

//Para mstrar error en caso de que la letra del dni no sea correcta
if (isset($_GET['errorLetra'])) {
    echo "<script>alert('La letra del DNI no es correcta.');</script>";
}

$titulo = "Agregar tutores"; 
$estilo= "css/estiloForm.css";
include("encabezado.php");
?>

<a href="listar_profesor.php"><button>Volver<br><img src="img/volver.png" width="20px"></button></a>
<a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
<h1><?= $titulo ?></h1>
<form action="../Controlador/agregar_profesor.php" method="post">
    <label for="dni">
    <p>Numero DNI:</p><input type="text" name="dni" id="dni" required>
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
    <label for="enviar">
        <p><input type="submit" value="Enviar"></p>
    </label>
</form>

<?php
include("pie.html");
?>