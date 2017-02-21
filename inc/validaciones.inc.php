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
function getFechaNac($fechaBD){
   // echo "La fecha del objeto-> ".$fecha;
    if($fechaBD!=NULL){
    $partes=  explode("-", $fechaBD);
    $fechaNac=$partes[2]."/".$partes[1]."/".$partes[0];

    }else{
        $fechaNac="00/00/0000";
    }
        return $fechaNac;
}
/**
 * La contraseña debe tener al entre 4 y 8 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.
 * NO puede tener otros símbolos.
 * @param type $pass
 */
function esContraseña($pass){
    if(preg_match("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,8}$/",$pass)){
        return true;
    }else{
        return false;
    }
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
    }elseif ($num==-204) {
        return $mensaje[EMAIL_REPE];
    }elseif ($num==-205) {
        return $mensaje[ERROR_FECHA_NACIMIENTO];
    }elseif ($num==-206) {
        return $mensaje[TFNO_INCORRECTO];
    }elseif ($num==-207) {
        return $mensaje[NOMBRE_INCORRECTO];
    }elseif ($num==-208) {
        return $mensaje[APELLIDO_INCORRECTO];
    }elseif ($num==-209) {
        return $mensaje[EMAIL_INCORRECTO];
    }elseif ($num==-210) {
        return $mensaje[PASS_DIFERENTES];
    }elseif ($num==-305) {
        return $mensaje[PASS_INCORRECTO];
    }  
        
}
/**
 * Un numero de telefono es valido si tiene 9 digitos
 * @param type $num
 * @return boolean
 */
function esTelefono($num){
    if(preg_match("/^[0-9]{9}$/",$num)){
        return true;
    }else{
        return false;
    }
}
/**
 * Un nombre ó apellido es válido si tiene un mímimo de 3 caracteres y un máximo de 20
 * Además, que no empiece por números,puede contener espacios en blanco y que no contenga caracteres especiales
 * @param type $nombre 
 * @return boolean true si se cumplen las reglas. False en caso contrario
 */
function esNombreValido($nombre) {
    if (strlen($nombre) < 3 && strlen($nombre) > 20) {
        return false;
    } else {
        //Que no empiece por números,puede contener espacios en blanco y que no contenga caracteres especiales
        if (preg_match("/^[A-Z \-áéíóúÁÉÍÓÚñÑ\\s]+[^\*=;:+.]*/i", $nombre)) {
            return true;
        } else {
           
            return false;
        }
    }
}
/**
 * Funcion a la que se le pasa un nombre simple ó compuesto y transforma la primera letra a Mayúsculas
 * @param type $nombre
 * @return string devuleve el nombre con la primera letra en mayúsculas
 */
function  ponerLetraEnMayuscula($nombre){
     $nombreCompuesto=  explode(" ", $nombre);
     $nombreConPrimeraletramayus="";
     for ($i = 0; $i < count($nombreCompuesto); $i++) {
       $letra= strtoupper(substr($nombreCompuesto[$i],0,1));
      $nombreCompuesto[$i]=$letra.substr($nombreCompuesto[$i],1);

     }
     for ($i = 0; $i < count($nombreCompuesto); $i++) {
          
          $nombreConPrimeraletramayus.=$nombreCompuesto[$i]." ";
     }
     return $nombreConPrimeraletramayus;
 }
 /**
  * Con un filtro validamos la direccion de correo electronico
  * @param type $mail 
  * @return boolean true si es valido. False en caso contrario
  */
 function esMailValido($mail){
     if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
         return true;
     return false;
 }
?>