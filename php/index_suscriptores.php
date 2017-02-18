<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
sesion();

 $foto=$_SESSION['foto'];
 $nick=$_SESSION['datos']['nick'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Página perfil</title>
  <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/main_perfil.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
  <script src="../jquery/jquery-3.1.1.min.js" ></script>
  <script type="text/javascript" src="../jquery/jquery_menu_desplegable.js"></script>
</head>
    <body>

      <header>
    		<nav>
    			<ul id='lista_principal'>
    				<li id='inicio'><a href="" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
    				<li id='perfil'><img src="" alt="">Hola <?php echo $nick;?>!<i class="fa fa-angle-down" aria-hidden="true"></i>
    					<ul class='perfil' id='perfil_usuario'>
    						<li>Cursos</li>
    						<li>Gestión de usuarios</li>
    						<li>Gestión de cursos</li>
    						<li><a href="modificaTusDatos.php">Editar usuario</a></li>
                <?php

                if($_SESSION['datos']['solicita_edicion']=='no'){
                echo '<li><a href="convierteteEnEditor_header.php">Conviértete en editor</a></li>';
                }
                ?>
    						<li><a href="cerrarSesion.php">Cerrar Sesion</a></li>
    					</ul></li>
    				</ul>
    		</nav>
    		<div id='slider'>
    		</div>
        <div class="navegacion">
          <ul id='navegacion_secundaria'>
                <li><a href="">Cursos</a></li>
                <li><a href="">Administrar usuarios</a></li>
                <li><a href="">Gestión de cursos</a></li>
                <li><a href="modificaTusDatos.php">Editar usuario</a></li>
          </ul>
        </div>

    	</header>

      <div id='usuario'>
    		<div id='imagen'>
    			<a href="modificaTusDatos.php"><?php echo '<img src="'.$foto.'" />'?></a>
    		</div>
    		<div id='info_perfil'>
          <?php
          echo '<h2>'.$_SESSION['datos']['nombre'].'</h2>';
          foreach ($_SESSION['datos'] as $key => $value) {
              /*
               * Vamos a imprimir la fecha de nacimiento en formato válido
               */
              if($key=='fecha_nac'){//del archivo '../inc/validaciones.inc.php'
                  $fecha=getFechaNac($value);
                  echo $key.": ".$fecha."<br>";
              }else{
                  echo $key.": ".$value."<br>";
              }
          }

          ?>
    		</div>
    		<div id='menu_lateral'>
          <?php

          if($_SESSION['datos']['solicita_edicion']=='no'){
            echo '<a class="enlace" href="convierteteEnEditor_header.php" class="button">¡QUIERO SER EDITOR!</a>';
          } else {
            echo "<h3>SOLICITUD DE EDICION EN TRÁMITE</h3>";
          }
          ?>
    		</div>

    	</div>

    </body>
</html>
