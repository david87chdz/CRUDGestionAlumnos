<?php
    session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}

if (isset($_GET['error'])) {
    $error_message = $_GET['error'];
    echo "<script>alert('$error_message');</script>";
}
?>
<?php
$titulo = "Listado proyectos"; // Declarada antes de usar
$estilo= "css/estiloListar.css";
include("encabezado.php");
include("../Controlador/Config/biblioteca.php"); 
        ?>
        <?php
        $sentencia=listarProyectos();

        $numfilas= $sentencia-> rowCount();

        ?>
        <a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
        <a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
        <h2>El número de registros de esta tabla es: <?=$numfilas?></h2>
        <a href="formulario_agregar_proyecto.php">
        <button id="insertar">Insertar</button>
        </a>
    <table>
        <thead>
            <tr>
                <th>Id_proyecto</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Ciclo</th>
                <th>Módulo1</th>
                <th>Módulo2</th>
                <th>Módulo3</th>
                <th>Convocatoria</th>
                <th>Fecha_exposición</th>
                <th>Nota</th>
                <th>Alumno</th>
                <th>Tutor</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if($numfilas>0){
                while($proyecto= $sentencia->fetch()){?>
            <tr>
                <td><?= $proyecto->id_proyecto?></td>
                <td><?= $proyecto->titulo?></td>
                <td><?= $proyecto->descripcion?></td>
                <td><?= $proyecto->ciclo?></td>
                <td><?= $proyecto->modulo1?></td>
                <td><?= $proyecto->modulo2?></td>
                <td><?= $proyecto->modulo3?></td>
                <td><?= $proyecto->convocatoria?></td>
                <td><?= $proyecto->fecha_exposicion?></td>
                <td><?= $proyecto->nota?></td>
                <td><?= $proyecto->nombre_alumno." ".$proyecto->apellido1_alumno." ".$proyecto->apellido2_alumno?></td>
                <td><?= $proyecto->nombre_tutor." ".$proyecto->apellido1_tutor." ".$proyecto->apellido2_tutor?></td>
                <td><a href="formulario_modificar_proyecto.php?id=<?= $proyecto->id_proyecto?>">
                            <button>Modificar</button>
                        </a></td>
                <td><a href="confirmacionEliminar_proyecto.php?id=<?= $proyecto->id_proyecto?>">
                            <button>Borrar</button>
                        </a></td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
<a href="../Controlador/Ficheros/pdf_proyectos.php"><button>Todos los proyectos en PDF</button></a>
<a href="../Controlador/Ficheros/pdf_proyectos_fecha.php"><button>Proyectos en PDF pendientes</button></a>
<a href="../Controlador/Ficheros/txt_proyectos.php"><button>Todos los proyectos en TXT</button></a>

<?php
    if(isset($_GET["message"])){
        echo "<h3>TXT generado</h3>";
    }
?>
<?php
include("pie.html");
?>