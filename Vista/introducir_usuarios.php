<?php
$titulo = "Insertar usuarios"; // Declarada antes de usar
$estilo= "css/estiloForm.css";
include("encabezado.php");
?>

<a href="index_root.php"><button>Inicio <br><img src="img/hogar.png" width="20px"></button></a>
<a href="../Controlador/logout.php"><button id="desconectar">Desconectar<br><img src="img/cerrar-sesion.png" width="20px"></button></a>
<form action="../Controlador/script.php" method="post">
            <fieldset>
        <legend>Login</legend>
        <br>
        <label for="usuario">
        <p>Usuario</p>
            <input type="text" name="usuario">
        </label>
        <p>Password</p>
        <label for="password">
            <input type="password" name="password" id="">
        </label>
        <p>Rol</p>
        <label for="rol">
            <select name="rol" id="rol">
                <option value="alumno">Alumno</option>
                <option value="profesor">Profesor</option>
            </select>
        </label>
        <br>
        <br>
        <input type="submit" name="loggin" value="loggin">
        </fieldset>
        </form>
        <p>
<?php
    if(isset($_GET["aceptado"])){
        echo "<h3>Usuario introducido en la base de datos</h3>";
    }

    if(isset($_GET["loginEnIndex"])){
            echo "<h3>Haz login para entrar en esta página</h3>";
        }
?>

<?php
include("pie.html");
?>