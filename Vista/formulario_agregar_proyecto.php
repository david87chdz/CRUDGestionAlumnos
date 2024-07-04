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
    header("Location: listar_proyecto.php?error=Como alumno no puedes agregar proyectos");
    exit();
}


$titulo = "Agregar Proyectos"; // Declarada antes de usar
$estilo= "css/estiloForm.css";
include("../Controlador/config/biblioteca.php");
include("encabezado.php");
?>
<a href="listar_proyecto.php"><button>Volver<br><img src="img/volver.png" width="20px"></button></a>
<a href="index_.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>

<form action="../Controlador/agregar_proyecto.php" method="post">
    <label for="titulo">
    <p>Titulo:</p><input type="text" name="titulo" id="titulo" required>
    </label>
    <label for="descripcion">
    <p>Descripción:</p> <input type="text" name="descripcion" id="descripcion" required>
    </label>
    <br>
    <label class="linea" for="ciclo">
    <p>Ciclo:</p>
     <select name="ciclo" id="ciclo" required>
           <?php
                for($i=0;$i<count($ciclos);$i++){
                    echo "<option value=$i>$ciclos[$i]</option>";
                }
           ?>
        </select>
    </label>
    <label class="linea" for="modulo1">
    <p>Módulo1:</p>
        <select name="modulo1" id="modulo1">
        <?php
                for($i=0;$i<count($modulos);$i++){
                    echo "<option value=$modulos[$i]>$modulos[$i]</option>";
                }
           ?>
        </select>
    </label>
    <label class="linea" for="modulo2">
    <p>Módulo2:</p>
        <select name="modulo2" id="modulo2">
        <?php
                for($i=0;$i<count($modulos);$i++){
                    echo "<option value=$modulos[$i]>$modulos[$i]</option>";
                }
           ?>
        </select>
    </label>
    <label class="linea" for="modulo3">
        <p>Módulo3:</p>
        <select name="modulo3" id="modulo3">
        <?php
                for($i=0;$i<count($modulos);$i++){
                    echo "<option value=$modulos[$i]>$modulos[$i]</option>";
                }
           ?>
        </select>
    </label>
    <br>
    <label class="linea" for="convocatoria">
    <p>Convocatoria:</p>
    Junio<input type="radio" name="convocatoria" id="conJunio" value="junio">
    Diciembre<input type="radio" name="convocatoria" id="conDiciembre" value="diciembre">
    </label>
    <label for="exposicion">
    <p>Fecha exposición</p><input type="date" name="exposicion" id="exposicion">
    </label>
    <label for="nota">
    <p>Nota:</p> <input type="number" name="nota" id="nota" min="0" max="10" value="Sin calificar">
    </label>
    <label for="alumno">
    <p>Alumno:</p> <select name="alumno" id="alumno">
    <?php
                $alumnos=buscarAlumnos();
                echo "<option value=''></option>";//El problema estaba poniendo fecht en vez de fectch all
                foreach($alumnos as $alumno){
                echo "<option value=$alumno->id_alumno>$alumno->nombre $alumno->apellido1 $alumno->apellido2</option>";
            }
   
    ?>
    </select>
    </label>
    <label for="tutor">
    <p>Tutor:</p> <select name="tutor" id="tutor">
    <?php
                $tutores=buscarTutores();
                echo "<option value=''></option>";//El problema estaba poniendo fecht en vez de fectch all
                foreach($tutores as $tutor){
                echo "<option value=$tutor->id_tutor>$tutor->nombre $tutor->apellido1 $tutor->apellido2</option>";
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