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
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
		    <link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Formulario de Registro</h1>
                              <div id='usuarioOk'>
                                   <?php
                                       if(isset($_REQUEST['error'])){
                                           ?>
                                             <h2>DATOS DEL REGISTRO:</h2>
                                             <?php
                                           $error=  urldecode($_REQUEST['error']);
                                           $errores=  unserialize($error);
                                           foreach ($errores as $key => $value) {
                                               echo '<p style="color:red">'.($key+1).")".validacionExisteUsuario($value)."</p>";
                                           }
                                       }
                                       ?>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Regístrate para entrar en nuestro sitio</h3>
                            		<p>Introduce tus datos:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                           <div class="form-bottom">
			                    <form enctype="multipart/form-data" role="form" action="grabar_registro_header.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="" for="form-username">Nick</label>
			                        	<input type="text" name="nick" placeholder="de 4 a 8 caracteres - sólo letras y números" class="form-username form-control" id="form-username">
			                      </div>
                            <div class="form-group">
			                    		<label class="" for="form-username">Nombre</label>
			                        	<input type="text" name="nombre" placeholder="de 3 a 20 caracteres" class="form-username form-control" id="form-username">
			                      </div>
                            <div class="form-group">
			                    		<label class="" for="form-username">Apellidos</label>
			                        	<input type="text" name="apellidos" placeholder="de 3 a 20 caracteres" class="form-username form-control" id="form-username">
			                      </div>
                            <div class="form-group">
			                    		<label class="" for="form-username">Email</label>
			                        	<input type="email" name="mail" placeholder="Email..." class="form-username form-control" id="form-username">
			                      </div>
                            <div class="form-group">
			                    		<label class="" for="form-username">Teléfono</label>
			                        	<input type="text" name="tfno" placeholder="máximo 9 dígitos" class="form-username form-control" id="form-username">
			                      </div>
			    <div class="form-group">
			                        	<label class="" for="form-password">Contraseña</label>
			                        	<input type="password" name="pass" placeholder="de 4 a 8 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula" class="form-password form-control" id="form-password">
			                      </div>
                            <div class="form-group">
			                    		<label class="" for="form-username">Fecha de nacimiento(dd/mm/aaaa)</label>
			                        	<input type="text" name="fecha_nac" placeholder="dd/mm/aaaa" class="form-username form-control" id="form-username">
			                      </div>
                            <div class="form-group">
			                    		<label class="" for="form-username">Foto de perfil</label>
			                        	<input type="file" name="foto" class="form-username form-control" id="form-username"><input type="hidden" name="lim_tamano" value="120000"/>

			                      </div>

                            <div class="form-group">
			                    		<label class="" for="form-username">¿Quieres ser editor?</label>
			                        	<input type="radio" name="editor" value="no" checked/>No
                                <input type="radio" name="editor" value="si"/>Si
                            </div>
			      <button type="submit" name='enviar' class="btn">¡Regístrate!</button>
                              <button type="reset" class='btn'>Borrar</button>
                              <button type="button" onclick=" location.href='../index.php' " class="btn">Inicio</button>
			                    </form>
		                    </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.backstretch.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
