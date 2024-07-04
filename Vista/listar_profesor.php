<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}
//Para mostrar error de acceso
if (isset($_GET['error'])) {
    $error_message = $_GET['error'];
    echo "<script>alert('$error_message');</script>";
}
//Para mostrar error letra dni
if (isset($_GET['errorLetra'])) {
    echo "<script>alert('La letra del DNI no es correcta.');</script>";
}

if (isset($_GET['errorFormato'])) {
    echo "<script>alert('El formato del DNI no es correcto.');</script>";
}
?>
<?php
$titulo = "Listado tutores"; // Declarada antes de usar
$estilo= "css/estiloListar.css";
include("encabezado.php");
include("../Controlador/Config/biblioteca.php"); 
        ?>
        <a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
        <a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
        <?php
       
        $sentencia=listarProfesores();

        $numfilas= $sentencia-> rowCount();
        ?>
        
        <h2>El número de registros de esta tabla es: <?=$numfilas?></h2>
        <a href="formulario_agregar_profesor.php">
        <button id="insertar">Insertar</button>
        </a>
    <table>
        <thead>
            <tr>
                <th>Id_tutor</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Proyecto</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if($numfilas>0){
                while($profesor= $sentencia->fetch()){?>
            <tr>
                <td><?= $profesor->id_tutor?></td>
                <td><?= $profesor->dni?></td>
                <td><?= $profesor->nombre?></td>
                <td><?= $profesor->apellido1?></td>
                <td><?= $profesor->apellido2?></td>
                <td><?= $profesor->email?></td>
                <td><?= $profesor->telefono?></td>
                <td><a href="proyectos_profesor.php?id=<?= $profesor->id_tutor ?>">
                            <button>Proyectos</button>
                        </a></td>
                <td><a href="formulario_modificar_profesor.php?id=<?= $profesor->id_tutor ?>">
                            <button>Modificar</button>
                        </a></td>
                <td><a href="confirmacionEliminar_profesor.php?id=<?= $profesor->id_tutor ?>">
                            <button>Borrar</button>
                        </a></td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
<a href="../Controlador/Ficheros/pdf_profesores.php"><button>Todos los tutores en PDF</button></a>
<a href="../Controlador/Ficheros/pdf_profesores.php"><button>Todos los tutores con proyectos pendientes PDF </button></a>
<a href="../Controlador/Ficheros/txt_profesores.php"><button>Todos los tutores en TXT</button></a>
<?php
    if(isset($_GET["message"])){
        echo "<h3>TXT generado</h3>";
    }
?>
<?php
include("pie.html");
?>