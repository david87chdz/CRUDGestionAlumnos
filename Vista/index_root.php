<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}

$titulo = "Inicio"; 
$estilo= "css/estiloGeneral.css";
include("encabezado.php");
$usuario=$_SESSION["usuario"];
?>
<h1>Bienvenid@ <?=$usuario?></h1>
<a href="introducir_usuarios.php"><button>Crear usuarios</button></a>
<a href="listar_alumno.php"><button>Tabla alumnos</button></a>
<a href="listar_profesor.php"><button>Tabla tutores</button></a>
<a href="listar_proyecto.php"><button>Tabla proyectos</button></a>
<br>
<a href="../Controlador/logout.php"><button id="desconectar"><img src="img/cerrar-sesion.png" width="30px"><br>Desconectar</button></a>
<?php
include("pie.html");
?>