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
 * @return string la fecha de nacimiento en formato español
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
 * @param type $pass contraseña que introdce el usuario por formlario
 * @return true si cumple con los requisitos
 */
function esContraseña($pass){
    if(preg_match("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,8}$/",$pass)){
        return true;
    }else{
        return false;
   }
}
/**
 * Función que compara la dos contraseñas que introduce el usuario por el formulario cuando tiene la opción de 
 * modificar la contraseña
 * @param type $passNueva contraseña nueva
 * @param type $passRep repetición de la contraseña nueva
 * @return boolean true si ambas coinciden. False si la contraseña repetida no es igual que la contraseña nueva
 */
function validarContrasena($passNueva,$passRep){
    if($passNueva==$passRep){
        return true;
    }else{
        return false;
    }
}
/**
 * Definimos los mensajes de error para darles un texto comprensible por el usuario
 * @global type $mensaje
 * @param type $num
 * @return type
 */
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
    }elseif ($num==-211) {
        return $mensaje[NICK_INCORRECTO];
    }elseif ($num==-212) {
        return $mensaje[ADMIN_NO_PERMISOS];
    }    
        
}
/**
 * Un numero de telefono es valido si tiene 9 digitos
 * @param type $num
 * @return boolean true si cumple la expresión regular
 */
function esTelefono($num){
    if(preg_match("/^[0-9]{9}$/",$num)){
        return true;
    }else{
        return false;
    }
}
/** 
 * Se valida el nick que tiene que tener de 4 a 8 caracteres, letras ó números
 * @param type $nick
 */
function esNick($nick){
    if(preg_match("/^[A-Z \-áéíóúÁÉÍÓÚñÑ0-9.]{4,8}$/i",$nick)){
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
       /**
         * Que no empiece por números,puede contener espacios en blanco y que no contenga caracteres especiales,
        * un mímimo de 3 caracteres y un máximo de 20
         */
        if (preg_match("/^[A-Z \-áéíóúÁÉÍÓÚñÑ\\s]{3,20}/i", $nombre)) {
            return true;
        } else {
           
            return false;
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