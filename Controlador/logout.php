<?php
//Nos unimos a la sesión
session_start();

//Borramos los datos
session_unset();

//Cerramos la sesión
session_destroy();

//Volvemos al index
header("Location: ../index.php")
?>