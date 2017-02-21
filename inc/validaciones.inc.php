<?php
require_once 'defines.inc.php';
/**
 * El usuario introduce una fecha con formato en español y me lo devuelve para ser introducido en 
 * formato de base de datos
 * @param type $fecha le paso la variable fecha (se supone que en formato español dd/mm/aaaa)
 * @return string devuelve la fecha en formato para ser introducido en la base de datos(aaaa-mm-dd)
 */
function validarFechaNac($fecha){
    //if(preg_match('/\//', $fecha)){     
    if(preg_match("/^[0-9]{2}\/{1}[0-9]{2}\/{1}[0-9]{4}$/",$fecha)){
    $partes=  explode("/", $fecha);
    $fechaNac=$partes[2]."-".$partes[1]."-".$partes[0];
        return $fechaNac;
    }
}
/**
 * Método que nos dice si una fecha de nacimiento está correctamente introducidoa en formato
 * dd/mm/aaaa que es como el usuario español debe intrucirla por teclado
 * @param type $fecha
 * @return boolean
 */
function esFechaNac($fecha){
    if(preg_match("/^[0-9]{2}\/{1}[0-9]{2}\/{1}[0-9]{4}$/",$fecha)){
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
   // echo "La fecha del objeto-> ".$fecha;
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
/**
 * 
 * @param type $passNueva
 * @param type $passRep
 * @return boolean
 */
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
function esTelefono($num){
    if(preg_match("/^[0-9]{9}/",$num)){
        return true;
    }else{
        return false;
    }
}

?>