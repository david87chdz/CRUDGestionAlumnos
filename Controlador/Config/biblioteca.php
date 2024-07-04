<?php
//Función para realizar la conexion a la base de datos
function conexion(){
    $conexion=null;
    $servidor='mysql:dbname=gestion_alumnos;host=localhost';
    $usuario='root';
    $pw="";
    try{
        $conexion = new PDO($servidor,$usuario,$pw);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /* echo "Conexion OK Bienvenid@"; */
    }catch(PDOException $e){
        echo "Fallo la conexión: " .$e->getMessage();
        $conexion=null;
    }
    //Debemos devolver la conexion si no nos da muchos problemas
    return $conexion;
}

//Función para desconectar de la base de datos
function desconexion($conexion){
    $conexion=null;
    /* echo "Desconectad@ con exito"; */
    //return $conexion;
}


?>
<?php
//Funcion para buscar si existe un alumno o profesor con ese dni para la verificación de campo único
function buscarDni($campo, $tabla, $valor){
    $conexion=conexion();
    $sql="select $campo from $tabla where dni=:dni";
    $consultaSelect=$conexion->prepare($sql);
    $consultaSelect->bindParam(":dni",$valor, PDO::PARAM_STR);
    if($consultaSelect->execute()){
        $usuario=$consultaSelect->fetch(PDO::FETCH_ASSOC);
        if ($usuario){
            return true;
        }else{ 
            return false;
        }
    }
    }
    
//Funcion para buscar si existe un proyecto con ese titulo
function buscarTitulo($campo, $valor){
    $conexion=conexion();
    $sql="select $campo from proyectos where titulo=:titulo";
    $consultaSelect=$conexion->prepare($sql);
    $consultaSelect->bindParam(":titulo",$valor, PDO::PARAM_STR);
    if($consultaSelect->execute()){
        $usuario=$consultaSelect->fetch(PDO::FETCH_ASSOC);
        if ($usuario){
            return true;
        }else{ 
            return false;
        }
    }
    }

//Función para los nombres y apellidos que limpia el texto y se lo envia a la siguiente función
function textOrdenado($campo){
    $campo=trim($campo);
    $palabras=str_word_count($campo);
    if($palabras>1){
        $campo=explode(" ",$campo);
        foreach($campo as &$palabra){
            $palabra=priMayus($palabra);
        }
        $campo=implode(" ",$campo);
    }else{
        $campo=priMayus($campo);
    }
   $campo=cambiarAcentos($campo);
return $campo;
};

//Función que pone la primera letra en mayúsculas
function priMayus($campo){
    $campo=str_split($campo);
for($i=0;$i<count($campo);$i++){
    if($i==0){
        $campo[$i]=strtoupper($campo[$i]);
    }else{
        $campo[$i]=strtolower($campo[$i]);
    }
}
$campo=implode($campo);
return $campo;
}

//Función para cambiar los acentos de mayúsculas a minúsculas
function cambiarAcentos($frase)    {
    $sinAcento = array("ñ","á", "é", "í", "ó", "ú");
    $conAcento = array("Ñ", "Á", "É", "Í", "Ó", "Ú");
    $frase=str_replace($conAcento,$sinAcento, $frase);
    return $frase;
};

//Función para rellenar un dni con 0 y asignarle la letra(Deprecated....)
function dni($cadena){
    $letras=["T","R","W","A","G","M","Y","F","P","D","X","B",
    "N","J","Z","S","Q","V","H","L","C","K","E"];
    $cadena=str_split($cadena);
    $cadena=array_pad($cadena, -8, 0);
    $cadena=implode($cadena);
    $letra=$letras[$cadena%23];
    $cadena.=$letra;
    return $cadena;
};

//Funciòn para mostrar los alumnos para asignar al select
function buscarAlumnos(){
    $conexion=conexion();
    try{
        $sql="select nombre,apellido1,apellido2,id_alumno from alumnos";
        $sentencia= $conexion-> prepare($sql);
        $sentencia->setFetchMode(PDO::FETCH_OBJ);
        if($sentencia->execute()){
            $alumnos=$sentencia->fetchAll();
            return $alumnos;
        }
     }catch(PDOException $e){
        $e->getMessage();
     }
     desconexion($conexion);
}

//Funciónn para mostrar los tutores para asignar al select
function buscarTutores(){
    $conexion=conexion();
    try{
        $sql="select nombre,apellido1,apellido2,id_tutor from tutores";
        $sentencia= $conexion-> prepare($sql);
        $sentencia->setFetchMode(PDO::FETCH_OBJ);
        if($sentencia->execute()){
            $tutores=$sentencia->fetchAll();//El problema estaba poniendo fecht en vez de fectch all
            return $tutores;
        }
     }catch(PDOException $e){
        $e->getMessage();
     }
     desconexion($conexion);
}


//Funcnion para comprobar la fecha que no sea anterior a la actual
function fechaAntigua($fechaComparar) {
    $fechaActual = new DateTime();

    $fechaComparar = new DateTime($fechaComparar);
    if($fechaActual<$fechaComparar){
        return true;
    }else{
        return false;
    }
}

//Pone la primera en mayuscula y las que esten tras un punto para la descripción
function limpiarTexto($texto) {
    $texto=trim($texto);
    //respeta los acentos así
    $texto = mb_strtolower($texto);

    $oraciones = explode('.', $texto);

    foreach ($oraciones as &$oracion) {
        $oracion = ucfirst(trim($oracion));
    }

    return implode('. ', $oraciones);
}



//Función para limpiar el dni y poner la letra en mayúsculas
function limpiarDni($dni) {
    $dniLimpio = trim($dni);
    if (!preg_match('/^[0-9]{8}[a-zA-Z]$/', $dniLimpio)) {
        return false; 
    }
    $dniLimpio = strtoupper($dniLimpio);
    return $dniLimpio;
}

//Función que verifica si la letra del dni es correcta
function verificarLetraDNI($dni) {
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    $resto = $dni % 23;
    $letraCalculada = $letras[$resto];
    return strtoupper($letraCalculada) === strtoupper(substr($dni, 8, 1));
}

//Función para mostrar los proyectos en los que esta ese profesor
function proyectosProfesor($id){
    $conexion=conexion();
    try{
        //$sql select * from alumnos; Si ponemos este debemos modificar el formulario
        $sql = "SELECT p.*, t.nombre,t.apellido1, t.apellido2
        FROM proyectos p
        LEFT JOIN tutores t ON p.tutor = t.id_tutor
        WHERE t.id_tutor = $id";
        //preparamos la consulta
        $sentencia= $conexion-> prepare($sql);
        $sentencia->setFetchMode(PDO::FETCH_OBJ);
        //ejecutamos
        $sentencia->execute();
        return $sentencia;
    }catch (PDOException $e){
        return $e;
    }
}

//Función para mostrar los proyectos de un determinado alumno
function proyectosAlumno($id){
try{
    $conexion=conexion();
    $sql = "SELECT p.*, a.nombre, a.apellido1, a.apellido2
    FROM proyectos p
    LEFT JOIN alumnos a ON p.alumno = a.id_alumno
    WHERE a.id_alumno = $id";
    //preparamos la consulta
    $sentencia= $conexion-> prepare($sql);
    $sentencia->setFetchMode(PDO::FETCH_OBJ);
    //ejecutamos
    $sentencia->execute();
    return $sentencia;
}catch(PDOException $e){
    return $e;
}
}

//Función para mostrar los datos de un determinado proyecto
function datosProyectos($id){
    try{
        $conexion=conexion();
        $sql="select * from proyectos where id_proyecto=:id";
        $sentencia=$conexion->prepare($sql);            
        $sentencia->bindParam(":id", $id, PDO::PARAM_INT);

        if($sentencia->execute()){
        $proyecto=$sentencia->fetch(PDO::FETCH_ASSOC);
        if (!$proyecto){
            exit("No hay resultados para este id");
        }else{
            
            return $proyecto;
        }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

//Función para mostrar los datos de un determinado alumno
function datosAlumnos ($id){
    try{
        $conexion=conexion();
        $sql="select * from alumnos where id_alumno=:id";
        $sentencia=$conexion->prepare($sql);            
        $sentencia->bindParam(":id", $id, PDO::PARAM_INT);

        if($sentencia->execute()){
        $usuario=$sentencia->fetch(PDO::FETCH_ASSOC);
        if (!$usuario){
            exit("No hay resultados para este id");
        }else{
            return $usuario;
        }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

//Función para mostrar los datos de un determinado profesor
function datosProfesores ($id){
    try{
        $conexion=conexion();
        $sql="select * from tutores where id_tutor=:id";
        $sentencia=$conexion->prepare($sql);            
        $sentencia->bindParam(":id", $id, PDO::PARAM_INT);

        if($sentencia->execute()){
        $usuario=$sentencia->fetch(PDO::FETCH_ASSOC);
        if (!$usuario){
            exit("No hay resultados para este id");
        }else{
            return $usuario;
        }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
        
}


//Función para listar los alumnos
function listarAlumnos(){
    try{
    $conexion=conexion();
    $sql="select * from alumnos a left outer join proyectos p on a.id_alumno=p.alumno";
    $sentencia= $conexion-> prepare($sql);
    $sentencia->setFetchMode(PDO::FETCH_OBJ);
    $sentencia->execute();
        return $sentencia;
    }catch(PDOExcption $e){
        return $e;
    }
}

//Función para listar los profesores
function listarProfesores(){
    try{
        $conexion=conexion();
        $sql="select * from tutores t left outer join proyectos p on t.id_tutor=p.tutor";
        $sentencia= $conexion-> prepare($sql);
        $sentencia->setFetchMode(PDO::FETCH_OBJ);
        $sentencia->execute();
            return $sentencia;
        }catch(PDOExcption $e){
            return $e;
        }
}

//Función para listar los proyectos
function listarProyectos(){
    try{
        $conexion=conexion();
        $sql="select p.*, a.nombre as nombre_alumno, a.apellido1 as apellido1_alumno,
        a.apellido2 as apellido2_alumno, t.nombre as nombre_tutor, t.apellido1 as apellido1_tutor,
        t.apellido2 as apellido2_tutor from proyectos p left outer join alumnos a on p.alumno=a.id_alumno 
        LEFT OUTER JOIN tutores t ON p.tutor = t.id_tutor;";
        $sentencia= $conexion-> prepare($sql);
        $sentencia->setFetchMode(PDO::FETCH_OBJ);
        $sentencia->execute();
            return $sentencia;
        }catch(PDOExcption $e){
            return $e;
        }
}
//Funcion para añadir usuarios
function aniadirUsuarios($password, $usuario, $rol){
    $password=password_hash(strtolower($password), PASSWORD_DEFAULT);
    $usuario=textOrdenado($usuario);
try{
    $conexion=conexion();
    $sql="insert into usuarios(password, usuario, rol) 
    values(:password,:usuario,:rol)";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindParam(":password", $password, PDO::PARAM_STR);
    $sentencia->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $sentencia->bindParam(":rol", $rol, PDO::PARAM_STR);
    if ($sentencia->execute()) {
        return true;
    } else {

        echo "Error, No hay datos que mostrar";
    }
    }catch (PDOException $e){
        echo $e->getMessage();
    }
    desconexion($conexion);
}
?>

<?php

$ciclos=["DAW","DAM","ASIR"];
$modulos=["","DAWES", "DAWEC", "DIW", "DASW", "EMPRESA"];

?>