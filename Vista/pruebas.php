<?php
function capitalizarTexto($texto) {
    $palabras = explode(".", $texto);

    foreach ($palabras as &$palabra) {
        //Para mantener los acentos
        $palabra = mb_convert_case(trim($palabra), MB_CASE_TITLE, 'UTF-8');
    }

    return implode(". ", $palabras);
}

// Ejemplo de uso
$texto = "eJEMPLO DE tEXTO. oTRA fRASE con acentos: áéíóúñ ñ.";
$textoCapitalizado = capitalizarTexto($texto);

echo $textoCapitalizado;
?>