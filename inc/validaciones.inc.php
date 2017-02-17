<?php
require_once 'defines.inc.php';
/**
 * Introduzco una fecha con formato en español y me lo devuelve para ser introducido en 
 * formato de base de datos
 * @param type $fecha
 * @return string
 */
function validarFechaNac($fecha){
    if(preg_match('/\//', $fecha)){
    $partes=  explode("/", $fecha);
    $fechaNac=$partes[2]."-".$partes[1]."-".$partes[0];
        return $fechaNac;
    }
}
function esFechaNac($fecha){
    if(preg_match('/\//', $fecha)){
        return true;
    }else{
        return false;
    }
}
/**
 * Método que devuelve la fecha de nacimiento en formato español dd/mm/aaaa
 * @param type $fecha está en aaaa-mm-dd
 * @return string
 */
function getFechaNac($fecha){
    echo "La fecha del objeto-> ".$fecha;
    if($fecha!=NULL){
    $partes=  explode("-", $fecha);
    $fechaNac=$partes[2]."-".$partes[1]."-".$partes[0];
        if($fechaNac=='00-00-0000'){
        $fechaNac= "00/00/0000";
        }
    }else{
        $fechaNac= "00/00/0000";
    }
    return $fechaNac;
}
function validarContrasena($passNueva,$passRep){
    if($passNueva==$passRep){
        return true;
    }else{
        return false;
    }
}
function validacionExisteUsuario($num){
    global $mensaje;//importante la variable global para que reconozca $mensaje de 'defines.inc.php'
    if($num==-300){
        return $mensaje[USER_EXISTE];
    }elseif ($num==-303) {
          return $mensaje[USER_INCORRECTO];  
    }elseif ($num==-301) {
        return $mensaje[USER_CORRECTO];  
    }elseif ($num==-201) {
        return $mensaje[USER_NOEXIS];  
    }elseif ($num==-305) {
        return $mensaje[PASS_INCORRECTO];
    }elseif ($num==-205) {
        return $mensaje[ERROR_FECHA_NACIMIENTO];
    }   
        
}

?>