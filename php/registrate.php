<!--
Editado por Miguel Costa 14/02/2017 13:00
-->

<?php
require_once '../inc/defines.inc.php';
require_once '../inc/validaciones.inc.php';
require_once '../clases/Usuario.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formulario de Registro</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css" />
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="../formulario/font-awesome/css/font-awesome.min.css">
		    <link rel="stylesheet" href="../formulario/css/form-elements.css">
        <link rel="stylesheet" href="../formulario/css/style.css">
        <link rel="shortcut icon" href="../formulario/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../formulario/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../formulario/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../formulario/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../formulario/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>
            <div class="container1">

                        <div class="form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h2>Regístrate para entrar en nuestro sitio</h2>
                              <div id='errores'>
                                   <?php
                                       if(isset($_REQUEST['error'])){

                                           $error=  urldecode($_REQUEST['error']);
                                           $errores=  unserialize($error);
                                           foreach ($errores as $key => $value) {
                                               echo '<p style="color:red">'.($key+1).".".validacionExisteUsuario($value)."</p>";
                                           }
                                       }
                                       ?>
                              </div>
                        		</div>
                          </div>
                          <div class="form-bottom">
			                    <form enctype="multipart/form-data" role="form" action="grabar_registro_header.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label>Nick</label>
			                        	<input type="text" name="nick" placeholder="de 4 a 8 caracteres - sólo letras y números" required="required"/>
			                      </div>
                            <div class="form-group">
			                        	<label>Contraseña</label>
			                        	<input type="password" name="pass" placeholder="de 4 a 8 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula" required="required"/>
			                      </div>
                            <div class="form-group">
			                    		<label>Nombre</label>
			                        	<input type="text" name="nombre" placeholder="de 3 a 20 caracteres" required="required"/>
			                      </div>
                            <div class="form-group">
			                    		<label>Apellidos</label>
			                        	<input type="text" name="apellidos" placeholder="de 3 a 20 caracteres" required="required"/>
			                      </div>
                            <div class="form-group">
			                    		<label>Email</label>
			                        	<input type="email" name="mail" placeholder="Email..." required="required"/>
			                      </div>
                            <div class="form-group">
			                    		<label>Teléfono</label>
			                        	<input type="text" name="tfno" placeholder="máximo 9 dígitos">
			                      </div>
                            <div class="form-group">
			                    		<label>Fecha de nacimiento(dd/mm/aaaa)</label>
			                        	<input type="text" name="fecha_nac" placeholder="dd/mm/aaaa">
			                      </div>
                            <div class="form-group">
			                    		<label>Foto de perfil</label>
			                        	<input type="file" name="foto"><input type="hidden" name="lim_tamano" value="120000"/>
			                      </div>
                            <div class="form-group">
			                    		<label>¿Quieres ser editor?</label>
			                        	<input type="radio" name="editor" value="no" checked/>  No
                                <input type="radio" name="editor" value="si"/>  Si
                            </div>
                            <div class="botones">

			                        <button type="submit" name='enviar' class="btn">¡Regístrate!</button>
                              <button type="reset" class='btn'>Borrar</button>
                              <button type="button" onclick=" location.href='../index.php' " class="btn">Volver a Inicio</button>
                            </div>
			                    </form>
		                    </div>
                      </div>

                  </div>

    </body>

</html>
