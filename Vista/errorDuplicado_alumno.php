<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}
$titulo = "Ya existe un usuario con ese DNI"; // Declarada antes de usar
$estilo= "css/estiloMensajes.css";
include("encabezado.php");
?>
<a href="listar_alumno.php"><button>Volver<br><img src="img/volver.png" width="20px"></button></a>
<a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>

<?php
include("pie.html");
?>