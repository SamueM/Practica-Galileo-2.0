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

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formulario de Inicio de sesión</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css" />
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
		    <link rel="stylesheet" href="../css/formulario/css/form-elements.css">
        <link rel="stylesheet" href="../css/formulario/css/style.css">

    </head>
    <body>


                <div class="container">
                    <div class="form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h2>Inicia sesión para entrar en nuestro sitio</h2>
                              <div id='errores'>
                                   <?php
                                  if(isset($_REQUEST['num'])){
                                     $num=$_REQUEST['num'];
                                     $mensaje=  validacionExisteUsuario($num);
                                     echo $mensaje;
                                  }
                              ?>
                              </div>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="logueo_header.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label>Nick</label>
			                        	<input type="text" name="nick" placeholder="Nick..."/>
			                      </div>
			                      <div class="form-group">
			                        	<label >Contraseña</label>
			                        	<input type="password" name="contrasena" placeholder="Contraseña..."/>
			                      </div>
                            <div class="botones">
			                        <button type="submit" name='loguear' class="btn">¡Inicia sesión!</button>
                              <button type="button" onclick=" location.href='../index.php' " class="btn">Volver a Inicio</button>
                            </div>
			                    </form>
		                    </div>
                        </div>
                    </div>



    </body>
</html>
