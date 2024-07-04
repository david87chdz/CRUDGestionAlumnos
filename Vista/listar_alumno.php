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
if (isset($_GET['errorLetra'])) {
    echo "<script>alert('La letra del DNI no es correcta.');</script>";
}

if (isset($_GET['errorFormato'])) {
    echo "<script>alert('El formato del DNI no es correcto.');</script>";
}

$titulo = "Listado alumnos"; // Declarada antes de usar
$estilo= "css/estiloListar.css";
include("encabezado.php");
include("../Controlador/Config/biblioteca.php"); 
        ?>
        <a href="index_.php"><button id="inicio">Inicio <br><img src="img/hogar.png" width="20px"></button></a>
        <a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
        <?php
   
        $sentencia=listarAlumnos();

        $numfilas= $sentencia-> rowCount();
        ?>
        
        <h2>El número de registros de esta tabla es: <?=$numfilas?></h2>
        <a href="formulario_agregar_alumno.php">
        <button id="insertar">Insertar</button>
        </a>
    <table>
        <thead>
            <tr>
                <th>Id_alumno</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Curso</th>
                <th>Proyecto</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if($numfilas>0){
                while($alumno= $sentencia->fetch()){?>
            <tr>
                <td><?= $alumno->id_alumno?></td>
                <td><?= $alumno->dni?></td>
                <td><?= $alumno->nombre?></td>
                <td><?= $alumno->apellido1?></td>
                <td><?= $alumno->apellido2?></td>
                <td><?= $alumno->email?></td>
                <td><?= $alumno->telefono?></td>
                <td><?= $alumno->curso?></td>
                <td><a href="proyectos_alumno.php?id=<?= $alumno->id_alumno ?>">
                            <button>Proyectos</button>
                        </a></td>
                <td><a href="formulario_modificar_alumno.php?id=<?= $alumno->id_alumno ?>">
                            <button>Modificar</button>
                        </a></td>
                <td><a href="confirmacionEliminar_alumno.php?id=<?= $alumno->id_alumno ?>">
                            <button>Borrar</button>
                        </a></td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
            <a href="../Controlador/Ficheros/pdf_alumnos.php"><button>Informe de alumnos en PDF</button></a>
            <a href="../Controlador/Ficheros/txt_alumnos.php"><button>Informe de alumnos en TXT</button></a>
       <?php
                if(isset($_GET["message"])){
                    echo "<h3>TXT generado</h3>";
                }
            ?>
<?php
include("pie.html");
?>