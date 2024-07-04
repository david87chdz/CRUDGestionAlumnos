<?php

if(!$_SESSION){
    session_start();
}
if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}
?>
<?php
$titulo = "Pagina Principal"; // Declarada antes de usar
$estilo= "css/estiloListar.css";
include("encabezado.php");
include("../Controlador/Config/biblioteca.php"); 
        ?>
        <h1><?php $conexion=conexion();?></h1>
        <?php
        $id=$_GET["id"];
        $sentencia=proyectosAlumno($id);
        $numfilas= $sentencia-> rowCount();
    
       if($numfilas==0){
        echo "<h2>El alumno Seleccionado no tiene ningun proyecto</h2>";
       }else{
        ?>
        <a href="formulario_agregar_alumno.php">
        <button id="Volver"><a href="listar_alumno.php">Volver</a></button>
        </a>
    <table>
        <thead>
            <tr>
                <th>Id_alumno</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Id_Proyecto</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Ciclo</th>
                <th>Módulo1</th>
                <th>Módulo2</th>
                <th>Módulo3</th>
                <th>Convocatoria</th>
                <th>Fecha_exposición</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($alumno= $sentencia->fetch()){?>
            <tr>
                <td><?= $id?></td>
                <td><?= $alumno->nombre?></td>
                <td><?= $alumno->apellido1?></td>
                <td><?= $alumno->apellido2?></td>
                <td><?= $alumno->id_proyecto?></td>
                <td><?= $alumno->titulo?></td>
                <td><?= $alumno->descripcion?></td>
                <td><?= $alumno->ciclo?></td>
                <td><?= $alumno->modulo1?></td>
                <td><?= $alumno->modulo2?></td>
                <td><?= $alumno->modulo3?></td>
                <td><?= $alumno->convocatoria?></td>
                <td><?= $alumno->fecha_exposicion?></td>
                <td><?= $alumno->nota?></td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
<h3><?=desconexion($conexion);?></h3>
<?php
include("pie.html");
?>

