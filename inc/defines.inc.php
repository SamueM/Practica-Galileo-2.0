<?php
// Validación de los datos del Formulario
define("NIF_INCORR", -102);   // NIF no es válido
define("CLAVE_INCORR", -103);  // Clave no válida
define("CLAVE_NOREPE", -104);   // Las claves no coinciden
define("FOTO_SUPLIM", -105);   // El tamaño de la foto supera el límite
define("USER_NOEXIS", -201);   // El usuario no está registrado
define("CLAVE_NOEXIS", -202);  // La clave no está registrada
define("USER_EXIS", -203);  // El DNI del usuario ya está registrado
define("EMAIL_REPE", -204);  // El email esta repetido
define("ERROR_FECHA_NACIMIENTO", -205);  // Error al insertar la fecha dnacimientoe nacimiento
define("TFNO_INCORRECTO", -206);//El número de teléfono no es correcto
define("NOMBRE_INCORRECTO", -207);//El nombre no es correcto (No puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)
define("APELLIDO_INCORRECTO", -208);//El apellido no es correcto (No puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)
define("EMAIL_INCORRECTO", -209);//El email es incorrecto
define("PASS_DIFERENTES", -210);//Debe introducir las dos contraseñas iguales

define("USER_CORRECTO", -301); //usuario registrado correcto
define("MODIF_USER_CORRECTO", -304);//usuario modificado correcto
define("USER_INCORRECTO", -303); //usuario registrado incorrecto
define("SESION_INICIADA", -302); //usuario registrado correcto
define("PASS_INCORRECTO", -305);  // Contraseña incorrecta
define("USER_EXISTE", -300); //usuario que ya estaba registrado
define("MAX_PORTADA", 3); 	// mostrar un máx de cursos en Portada

$mensaje[NIF_INCORR] = "El NIF introducido no es válido.";
$mensaje[CLAVE_INCORR] = "La CLAVE introducida no es válida.";
$mensaje[CLAVE_NOREPE] = "Las claves no coinciden";
$mensaje[FOTO_SUPLIM] = "El tamaño de la foto supera el límite permitido";
$mensaje[ERROR_FECHA_NACIMIENTO]="Error al insertar la fecha de nacimiento";
$mensaje[TFNO_INCORRECTO]="El número de teléfono no es correcto";
$mensaje[NOMBRE_INCORRECTO]="El nombre no es correcto (No puede ser un campo vacío, no puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)";
$mensaje[APELLIDO_INCORRECTO]="El apellido no es correcto (No puede ser un campo vacío, no puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)";
$mensaje[EMAIL_REPE] = "Hay otro usuario con el mismo email.";
$mensaje[EMAIL_INCORRECTO] = "El email es incorrecto.";
$mensaje[PASS_DIFERENTES] = "Debe introducir las dos contraseñas iguales.";

$mensaje[USER_NOEXIS] = "El usuario no está registrado.";
$mensaje[CLAVE_NOEXIS] = "La clave no es la correcta para el usuario solicitado.";
$mensaje[USER_EXIS] = "El DNI del usuario ya está registrado.";


$mensaje[USER_CORRECTO] = "El usuario se ha registrado correctamente.";
$mensaje[MODIF_USER_CORRECTO] = "El usuario se ha modificado correctamente.";
$mensaje[USER_INCORRECTO] = "El usuario no se ha podido registrar.";
$mensaje[USER_EXISTE]= "El usuario ya estaba registrado previamente.";
$mensaje[SESION_INICIADA] = "Tienes otra sesión iniciada.";
$mensaje[PASS_INCORRECTO] = "Contraseña incorrecta.<br>&nbsp La contraseña debe tener entre 4 y 8 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.";
?>