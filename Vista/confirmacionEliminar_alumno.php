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
    header("Location: listar_alumno.php?error=Como alumno no puedes borrar");
    exit();
}

$titulo = "Página de confirmación";
$estilo= "css/estiloMensajes.css";
include("encabezado.php");

$id=$_GET["id"];
?>
        <h2>¿Estas seguro de eliminar el alumno con id: <?= $id ?>?</h2>
        <a href="listar_alumno.php">
            <button>No</button>
        </a>
        <a href="../Controlador/eliminar_alumno.php?id=<?= $id ?>">
            <button>Si</button>
        </a>
<?php
include("pie.html");
?>