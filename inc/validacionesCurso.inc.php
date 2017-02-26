<?php
require_once 'definesCurso.inc.php';

//Cristina 
/**
* Parametro=Numero para mostrar los mensajes
*  return: String
*/
function validacionAddCurso($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[CURS_EXIST];
    }elseif ($num==-401) {
          return $mensaje[CURS_ERR];  
    }elseif ($num==-402) {
        return $mensaje[CURS_ADD];  
    }
}
function validacionAddArti($num){
    global $mensaje;
    if($num==-410){
        return $mensaje[ART_ADD];
    }elseif ($num==-411) {
          return $mensaje[ART_ERR];  
    }elseif ($num==-412) {
        return $mensaje[ART_EXIST];  
    }
}
?>