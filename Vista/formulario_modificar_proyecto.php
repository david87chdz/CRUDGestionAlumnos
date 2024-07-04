<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario'])) {
    // No hay sesión, redirige a la página de inicio
    header("Location: ../index.php?loginEnIndex=true");
    exit();
}

if ($_SESSION['tipo_usuario'] === 'alumno') {
    // El tipo de usuario es "alumno", redirige a una página de acceso no permitido o a la página de inicio
    header("Location: listar_proyecto.php?error=Como alumno no puedes modificar");
    exit();
}

$titulo = "Actualizar proyecto"; // Declarada antes de usar
$estilo= "css/estiloForm.css";
include("encabezado.php");
include("../Controlador/Config/biblioteca.php");
           
$id = $_GET["id"];
$proyecto=datosProyectos($id);
?>
<a href="listar_proyecto.php"><button>Volver<br><img src="img/volver.png" width="20px"></button></a>
<a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
<form action="../Controlador/modificar_proyecto.php" method="post">
     <label for="id">
        <input type="hidden" name="id" value="<?= $_GET["id"]?>" >
     </label>  
     <label for="titulo">
        <input type="hidden" id="titulo" name="titulo" value="<?=$proyecto["titulo"]?>">
        <p id="primero">Título actual: <?=$proyecto["titulo"]?></p>
     </label>
     <br>     
    <label for="nuevoTitulo">
    <p>Nuevo Título (Solo si se desea cambiar):</p><input type="text" name="nuevoTitulo" id="nuevoTitulo"  value="">
    </label>
    <label for="descripcion">
    <p>Descripción:</p> <input type="text" name="descripcion" id="descripcion" value="<?=$proyecto["descripcion"]?>">
    </label>
    <br>
    <label class="linea" for="ciclo">
    <p>Ciclo: </p>
    <select name="ciclo" id="ciclo">
            <option value="sin"></option>
            <option value="daw" <?= ($proyecto["ciclo"] == "daw") ? "selected" : ""; ?>>DAW</option>
            <option value="dam" <?= ($proyecto["ciclo"] == "dam") ? "selected" : ""; ?>>DAM</option>
            <option value="asir" <?= ($proyecto["ciclo"] == "asir") ? "selected" : ""; ?>>ASIR</option>
        </select>
    </label>
    <label class="linea" for="modulo1">
    <p>Módulo1: </p>
    <select name="modulo1" id="modulo1">
        <?php
        foreach ($modulos as $modulo) {
            echo "<option value='$modulo'" . (($proyecto["modulo1"] == $modulo) ? " selected" : "") . ">$modulo</option>";
        }
        ?>
    </select>
    </label>
    <label class="linea" for="modulo2">
        <p>Módulo2: </p>
        <select name="modulo2" id="modulo2">
            <?php
            foreach ($modulos as $modulo) {
                echo "<option value='$modulo'" . (($proyecto["modulo2"] == $modulo) ? " selected" : "") . ">$modulo</option>";
            }
            ?>
        </select>
    </label>
    <label class="linea" for="modulo3">
        <p>Módulo3:</p>
        <select name="modulo3" id="modulo3">
            <?php
            foreach ($modulos as $modulo) {
                echo "<option value='$modulo'" . (($proyecto["modulo3"] == $modulo) ? " selected" : "") . ">$modulo</option>";
            }
            ?>
        </select>
    </label>
    <br>
    <label class="linea" for="convocatoria">
            <!-- Como coger el value -->
            <p>Convocatoria:</p>
            Junio<input type="radio" name="convocatoria" id="convJunio" value="junio">
            Diciembre<input type="radio" name="convocatoria" id="convDiciembre" value="diciembre">
    </label>
    </label>
    <label for="exposicion">
    <p>Fecha exposición</p><input type="date" name="exposicion" id="exposicion" value="<?=$proyecto["fecha_exposicion"]?>" >
    </label>
    <label for="nota">
    <p>Nota:</p> <input type="number" name="nota" id="nota" min="0" max="10" value="<?=$proyecto["nota"]?>">
    </label>
    <label for="alumno">
    <p>Alumno:</p> 
    <select name="alumno" id="alumno">
    <?php
    $alumnos = buscarAlumnos();

    foreach ($alumnos as $alumno) {
        $selected = ($proyecto["alumno"] == $alumno->id_alumno) ? "selected" : "";
        echo "<option value={$alumno->id_alumno} $selected>$alumno->nombre $alumno->apellido1 $alumno->apellido2</option>";
    }
    ?>
</select>
<label for="profesor">
    <p>Tutor:</p> 
    <select name="tutor" id="tutor">
    <?php
    $tutores = buscarTutores();

    foreach ($tutores as $tutor) {
        $selected = ($proyecto["tutor"] == $tutor->id_tutor) ? "selected" : "";
        echo "<option value={$tutor->id_tutor} $selected>$tutor->nombre $tutor->apellido1 $tutor->apellido2 </option>";
    }
    ?>
</select>
    </label>
    <label for="enviar">
        <p><input type="submit" value="Enviar"></p>
    </label>
   
</form>

<?php
include("pie.html");
?>