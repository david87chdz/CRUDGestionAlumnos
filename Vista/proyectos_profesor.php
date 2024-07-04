<?php
session_start();

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
        $sentencia=proyectosProfesor($id);
        $numfilas= $sentencia-> rowCount();
    if($numfilas==0){
        echo "<h2>El tutor seleccionado no tiene ningun proyecto</h2>";
       }else{
        ?>
        <a href="formulario_agregar_profesor.php">
        <button id="Volver"><a href="listar_profesor.php">Volver</a></button>
        </a>
    <table>
        <thead>
            <tr>
                <th>Id_tutor</th>
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
                while($profesor= $sentencia->fetch()){?>
            <tr>
                <td><?= $id?></td>
                <td><?= $profesor->nombre?></td>
                <td><?= $profesor->apellido1?></td>
                <td><?= $profesor->apellido2?></td>
                <td><?= $profesor->id_proyecto?></td>
                <td><?= $profesor->titulo?></td>
                <td><?= $profesor->descripcion?></td>
                <td><?= $profesor->ciclo?></td>
                <td><?= $profesor->modulo1?></td>
                <td><?= $profesor->modulo2?></td>
                <td><?= $profesor->modulo3?></td>
                <td><?= $profesor->convocatoria?></td>
                <td><?= $profesor->fecha_exposicion?></td>
                <td><?= $profesor->nota?></td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
  
<h3><?=desconexion($conexion);?></h3>
<?php
include("pie.html");
?>

