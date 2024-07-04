<?php
    session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}

include("../Config/biblioteca.php");
$conexion = conexion(); 

$consulta = "select p.*, a.nombre as nombre_alumno, a.apellido1 as apellido1_alumno,
a.apellido2 as apellido2_alumno, t.nombre as nombre_tutor, t.apellido1 as apellido1_tutor,
t.apellido2 as apellido2_tutor from proyectos p left outer join alumnos a on p.alumno=a.id_alumno 
LEFT OUTER JOIN tutores t ON p.tutor = t.id_tutor;";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();

$listaPersonas = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$rutaArchivo = "Txt/Proyectos.txt";

$archivo = fopen($rutaArchivo, "w");

if ($archivo) {
    foreach ($listaPersonas as $persona) {
        fwrite($archivo, "PROYECTO:\n");
        fwrite($archivo, "Id_proyecto: {$persona['id_proyecto']}\n");
        fwrite($archivo, "Título: {$persona['titulo']}\n");
        fwrite($archivo, "Descripción: {$persona['descripcion']}\n");
        fwrite($archivo, "Ciclo: {$persona['ciclo']}\n");
        fwrite($archivo, "Modulo1: {$persona['modulo1']}\n");
        fwrite($archivo, "Modulo2: {$persona['modulo2']}\n");
        fwrite($archivo, "Modulo3: {$persona['modulo3']}\n");
        fwrite($archivo, "Convocatoria: {$persona['convocatoria']}\n");
        fwrite($archivo, "Fecha exposición: {$persona['fecha_exposicion']}\n");
        fwrite($archivo, "Nota: {$persona['nota']}\n");
        fwrite($archivo, "Alumno: {$persona['nombre_alumno']} {$persona['apellido1_alumno']} {$persona['apellido2_alumno']}\n");
        fwrite($archivo, "Tutor: {$persona['nombre_tutor']} {$persona['apellido1_tutor']} {$persona['apellido2_tutor']}\n\n");
    }

    fclose($archivo);
    header("Location: ../../Vista/listar_proyecto.php?message=true");
} else {
    echo "Error al abrir el archivo: $rutaArchivo";
}

$sentencia = null;
desconexion($conexion);
?>

