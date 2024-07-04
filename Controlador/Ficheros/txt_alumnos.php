<?php
    session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php?loginEnIndex=true");
}
?>
<?php
include("../Config/biblioteca.php");
$conexion = conexion(); 

$consulta = "SELECT * FROM alumnos a LEFT OUTER JOIN proyectos p ON a.id_alumno=p.alumno";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();

$listaPersonas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$nombreArchivo = "Txt/Alumnos.txt";

$archivo = fopen($nombreArchivo, "w");

if ($archivo) {
    foreach ($listaPersonas as $persona) {
        // Escribe los datos en el archivo de texto
        fwrite($archivo, "TUTOR:\n");
        fwrite($archivo, "Id_alumno: {$persona['id_tutor']}\n");
        fwrite($archivo, "DNI: {$persona['dni']}\n");
        fwrite($archivo, "Apellido1: {$persona['apellido1']}\n");
        fwrite($archivo, "Apellido2: {$persona['apellido2']}\n");
        fwrite($archivo, "Email: {$persona['email']}\n");
        fwrite($archivo, "Telefono: {$persona['telefono']}\n");
        fwrite($archivo, "Título proyecto: {$persona['titulo']}\n");
        fwrite($archivo, "Descripción proyecto: {$persona['descripcion']}\n\n");
    }

    // Cierra el archivo
    fclose($archivo);
    header("Location: ../../Vista/listar_alumno.php?message=true");
    
} else {
    echo "Error al abrir el archivo: $nombreArchivo";
}

$sentencia = null;
desconexion($conexion);
?>
