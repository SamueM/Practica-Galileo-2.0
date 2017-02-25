<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once("../clases/Curso.php");
$curso=new Curso();
sesion();
 $foto=$_SESSION['foto'];
 $nick=$_SESSION['datos']['nick'];
 $id_usuario=$_SESSION['datos']['id_usuario'];
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
   <script>
      $(document).ready(function(){
         $(".registrar").click(function(){
           //alert($(this).val());
            console.log(<?php echo $id_usuario; ?>);
            var id=<?php echo $id_usuario; ?>;
             var p="resul"+$(this).val();//Nos sirve para coger el parrafo correspondiente, dependiendo de en que curso nos queremos registrar
           $("#"+p).load("../AJAX/registrarCurso.php?id="+id+"&curso="+$(this).val());
         });
      });
  </script>
</head>
    <body>

      <header>
    		<nav>
    			<ul id='lista_principal'>
    				<li id='inicio'><a href="../index.php" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
            <li id='perfil1'><a href="modificaTusDatos.php"><img src="<?php echo $foto;?>" alt=""></a> Hola <?php echo $nick;?>!<i class="fa fa-angle-down" aria-hidden="true"></i>
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
                <li><a href="index_suscriptores.php">Cursos</a></li>
                <li><a href="">Gestión de cursos</a></li>
                <li><a href="modificaTusDatos.php">Editar usuario</a></li>
          </ul>
        </div>

    	</header>

      <div id='usuario'>
        <?php

        if($_SESSION['datos']['solicita_edicion']=='no'){
          echo '<center><a class="boton" href="convierteteEnEditor_header.php">¡QUIERO SER EDITOR!</a></center>';
        } else {
          echo "<h3>SOLICITUD DE EDICION EN TRÁMITE</h3>";
        }
         $p=$curso->verCursosInscritos($id_usuario);
          if($p=="Todavia no te has registrado en ningún curso.   ANIMATE"){
            echo"<h1>".$p."</h1>";
            $curso->verCursos();
          }
        ?>
    	</div>

      <footer>
    	<div id='conocenos'>
    	<h3>Conócenos</h3>
    		<ul>
    			<li><a href="">Isabel</a></li>
    			<li><a href="">Cristina</a></li>
    			<li><a href="">Samuel</a></li>
    			<li><a href="">Alejandro</a></li>
    			<li><a href="">Miguel</a></li>
    		</ul>
    	</div>
            <p>Copyright 2017 DAW<br />IES Galileo</p>
            <div class='redes'>
            	<h3>Síguenos en: </h3>
    	        <a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
    	        <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
    	        <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
    	        <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
    		</div>
        </footer>

    </body>
</html>
