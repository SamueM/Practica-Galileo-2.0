<!--
Editado por Miguel Costa 14/02/2017 13:00
-->

<?php
require_once '../inc/defines.inc.php';
require_once '../inc/validaciones.inc.php';
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formulario de Registro</title>
        <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
        <link rel="stylesheet" href="../css/main.css" />
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
    </head>
    <body>
            
           <div class='formulario' id='registroNuevo'>
               <h2>Registro de Usuario</h2>
               <div id='usuarioOk'>
                   <?php 
       
                      if(isset($_REQUEST['nuevoUsuario'])){
                           $strNuevoUsuario=  urldecode($_REQUEST['nuevoUsuario']);
                           $nuevoUsuario=  unserialize ($strNuevoUsuario);
                           print_r($nuevoUsuario);
                       }
                  ?>
               </div>
                <form enctype="multipart/form-data" action="grabar_registro_header.php" method="POST" autocomplete="off">
    		
                        <p><label class="icon">Nick</label>
                    <input type="text" name="nick" placeholder="Nick" autofocus="autofocus" required="required"/><span style="color:red">*</span></p>
                        <p><label class="icon">Nombre</label>
                    <input type="text" name="nombre" placeholder="Nombre" required="required"/><span style="color:red">*</span></p>
                        <p><label class="icon">Apellidos</label>
                    <input type="text" name="ape" placeholder="Apellidos"/></p>
                        <p><label class="icon">Teléfono</label>
                    <input type="number" name="tfn" placeholder="Teléfono"/></p>
                        <p><label class="icon">Email</label>
                    <input type="email" name="mail" placeholder="Email" required="required"/><span style="color:red">*</span></p> 
                        <p><label class="icon">Contraseña</label>
                    <input type="password" name="pass" placeholder="Contraseña" required="required"/><span style="color:red">*</span></p>
                        <p><label class="icon">Dirección</label>
                    <input type="text" name="dir" placeholder="Dirección"/></p>
                        <p><label class="icon" >Fecha de Nacimiento</label>
                    <input type="date" name="fec_nac" /></p>
                        <p><label class="icon">Añade una foto</label>
                    <input type="file" name="foto" /><input type="hidden" name="lim_tamano" value="120000"/></p>
                        <p><label class="icon" class='editor'>¿Quieres ser EDITOR?</label>
                    <input type="radio" name="editor" value="no" checked="checked"/><label>No</label>
                    <input type="radio" name="editor" value="si" /><label>Si</label></p>	
                    <div class='centrado'>
                        <input type="submit" class='botonFormulario' name="enviar" value="Enviar"/><input type="reset" class='botonFormulario' value="Borrar"/>			
        		    </div>    
    	        </form>
                <div id='errores'></div>
            </div>
        
        <div id='inicio' class='centrado'>
            <h2><a class='enlace' href="../index.php">Volver al inicio</a></h2>
        </div>
    </body>
</html>
