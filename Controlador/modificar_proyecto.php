<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php?loginEnIndex=true");
}

include("Config/biblioteca.php");
$conexion=conexion();
$id = $_POST["id"];
$titulo = $_POST["titulo"];
$nuevoTitulo = limpiarTexto(trim($_POST["nuevoTitulo"]));
$descripcion = limpiarTexto(trim($_POST["descripcion"]));
$ciclo = $_POST["ciclo"];
$modulo1 = $_POST["modulo1"];
$modulo2 = $_POST["modulo2"];
$modulo3 = $_POST["modulo3"];
if (!isset($_POST["convocatoria"])) {
    $convocatoria = "";
} else {
    $convocatoria = $_POST["convocatoria"];
}
$exposicion = $_POST["exposicion"];
$nota = $_POST["nota"];
$alumno = $_POST["alumno"];
$tutor=$_POST["tutor"];
if ($nuevoTitulo == "") {
    try {
        $sql = "UPDATE proyectos SET
        descripcion = :descripcion, ciclo = :ciclo, modulo1 = :modulo1, modulo2 = :modulo2, modulo3 = :modulo3,
        convocatoria = :convocatoria, fecha_exposicion = :fecha_exposicion, nota = :nota, alumno = :alumno,
        tutor= :tutor
        WHERE id_proyecto = :id";
        $consultaUpdate = $conexion->prepare($sql);
        $consultaUpdate->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":ciclo", $ciclo, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":modulo1", $modulo1, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":modulo2", $modulo2, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":modulo3", $modulo3, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":convocatoria", $convocatoria, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":fecha_exposicion", $exposicion, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":nota", $nota, PDO::PARAM_INT);
        $consultaUpdate->bindParam(":alumno", $alumno, PDO::PARAM_INT);
        $consultaUpdate->bindParam(":tutor", $tutor, PDO::PARAM_INT);
        $consultaUpdate->bindParam(":id", $id, PDO::PARAM_INT);
        $consultaUpdate->execute();

            header("Location: ../Vista/listar_proyecto.php");
            exit;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    desconexion($conexion);
} else {
    if (buscarTitulo("titulo", $nuevoTitulo)) {
        header("Location: ../Vista/errorDuplicado_proyecto.php");
        exit;
    } else {
        $titulo = $nuevoTitulo;
        try {
            $sql = "UPDATE proyectos SET titulo = :titulo,
                descripcion = :descripcion, ciclo = :ciclo, modulo1 = :modulo1, modulo2 = :modulo2, modulo3 = :modulo3,
                convocatoria = :convocatoria, fecha_exposicion = :fecha_exposicion, nota = :nota, alumno = :alumno, tutor= :tutor
                WHERE id_proyecto = :id";
            $consultaUpdate = $conexion->prepare($sql);
            $consultaUpdate->bindParam(":titulo", $titulo, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":ciclo", $ciclo, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":modulo1", $modulo1, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":modulo2", $modulo2, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":modulo3", $modulo3, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":convocatoria", $convocatoria, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":fecha_exposicion", $exposicion, PDO::PARAM_STR);
            $consultaUpdate->bindParam(":nota", $nota, PDO::PARAM_INT);
            $consultaUpdate->bindParam(":alumno", $alumno, PDO::PARAM_INT);
            $consultaUpdate->bindParam(":tutor", $tutor, PDO::PARAM_INT);
            $consultaUpdate->bindParam(":id", $id, PDO::PARAM_INT);
            $consultaUpdate->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        header("Location: ../Vista/listar_proyecto.php");
        exit;
    }
}
?>
