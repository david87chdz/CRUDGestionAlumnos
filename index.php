<?php
$titulo = "Inserta tus datos para acceder"; // Declarada antes de usar
$estilo= "Vista/css/estiloLogin.css";
include("Vista/encabezado.php");
?>


<form action="Controlador/login.php" method="post">
            <fieldset>
        <legend>Login</legend>
        <br>
        <label for="usuario">
        Usuario
            <input type="text" name="nombre">
        </label>
        Password
        <label for="password">
            <input type="password" name="contrasenia" id="">
        </label>
        <input type="submit" name="loggin" value="loggin">
        </fieldset>
        </form>
        <p>
            <?php
                if(isset($_GET["error"])){
                    echo "<h3>Acceso no permitido</h3>";
                }
            ?>
        </p>
        <p>
            <?php
                if(isset($_GET["loginEnIndex"])){
                    echo "<h3>Haz login para entrar en esta página</h3>";
                }
                if(isset($_GET["aceptado"])){
                    echo "<h3>Nuevo usuario añadido</h3>";
                }
            ?>
        </p>
<?php
include("Vista/pie.html");
?>