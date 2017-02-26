<?php
// Validación del registro del curso
define("CURS_EXIST",-400);  //El curso ya existe
define("CURS_ERR",-401);  //No se pudo añadir correctamente el curso
define("CURS_ADD",-402);  //Curso creado con exito
define("VERERR_CURS",-403); //No hay ningun curso que mostrar
//Validación de añadir un curso
define("ART_ADD",-410);       //Se ha añadido correctamente el articulo";
define("ART_ERR",-411);       //No se pudo añadir correctamente al curso;
define("ART_EXIST",-412);   //Error: Ya existe este articulo
         
$mensaje[CURS_EXIST]="El curso ya existe";
$mensaje[CURS_ERR]="No se pudo añadir correctamente el curso";
$mensaje[CURS_ADD]="Curso creado con exito";

$mensaje[ART_EXIST]="Error: Ya existe este articulo";
$mensaje[ART_ERR]="No se pudo añadir correctamente al curso";
$mensaje[ART_ADD]="Se ha añadido correctamente al curso";
?>