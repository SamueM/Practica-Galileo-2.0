<!--
Editado por Miguel Costa 14/02/2017 13:00
-->

<?php
require_once '../inc/defines.inc.php';
require_once '../inc/validaciones.inc.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Formulario de Inicio de sesión</title>
        <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
        <link rel="stylesheet" href="../css/main.css" />
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div class='formulario' id='formularioSesion'>
            <h2>Inicio de Sesión</h2>
            <div id='errores'>
                 <?php
                if(isset($_REQUEST['num'])){
                   $num=$_REQUEST['num'];
                   $mensaje=  validacionExisteUsuario($num);
                   echo $mensaje;
                }
            ?>
            </div>
            <form  action="logueo_header.php" method="post" enctype="application/x-www-form-urlencoded" id="formAcceso">
                <p><label class="icon">Nick</label>
                <input type="text" name="nick" placeholder="Nick" required/></p>
                        
                <p><label class="icon" class='contrasena'>Contraseña</label>
                <input type="password" name="contrasena" placeholder="Contraseña" required/></p>
                <div class='centrado'><input type="submit" name="loguear" value="Acceder" class='botonFormulario'/></div>
            </form>

            </div>
        </div>
        <div id='inicio' class='centrado'>
            <h2><a class='enlace' href="../index.php">Volver al inicio</a></h2>
        </div>
      
     
    </body>
</html>
