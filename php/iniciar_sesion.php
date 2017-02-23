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
                <div class="container1">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Inicia Sesión</h1>
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
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Inicia sesión para entrar en nuestro sitio</h3>
                            		<p>Introduce tu Nick y contraseña</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="logueo_header.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="" for="form-username">Nick</label>
			                        	<input type="text" name="nick" placeholder="Nick..." class="form-username form-control" id="form-username">
			                      </div>
			                      <div class="form-group">
			                        	<label class="" for="form-password">Contraseña</label>
			                        	<input type="password" name="contrasena" placeholder="Contraseña..." class="form-password form-control" id="form-password">
			                      </div>
			                        <button type="submit" name='loguear' class="btn">¡Inicia sesión!</button>
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
