<?php
 spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
sesion();
//nos aseguramos que pertenece al tipo 1, 2 de administradores
if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario'])==1 OR isset($_SESSION['datos']['id_tipo_usuario'])==2)){
$foto=$_SESSION['foto'];
            //echo $foto;
$nick=$_SESSION['datos']['nick'];
}
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
        <title>Página Administrador</title>
        <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/main_perfil.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
        <script src="../jquery/jquery-3.1.1.min.js" ></script>
        <script type="text/javascript" src="../jquery/jquery_menu_desplegable.js"></script>
        <style>
            .tablas-administracion{
               margin-top: 2rem;
               margin-bottom: 2rem;
             }
             h2 {
               margin-top: 2rem;
               margin-bottom: 2rem;
             }
        </style>
    </head>
    <body>

         <header>
    		<nav>
    			<ul id='lista_principal'>
    				<li id='inicio'><a href="" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
                                <li id='perfil'><img src="<?php echo $foto;?>" width="50px" alt="">Hola <?php echo $nick;?>!<i class="fa fa-angle-down" aria-hidden="true"></i>
    					<ul class='perfil' id='perfil_usuario'>
    						<li><a href="index_administradores.php?pagina=1">Solicitudes de Edición</a></li>
                                                <li><a href="index_administradores.php?pagina=2">Activar usuarios</a></li>
                                                <li><a href="index_administradores.php?pagina=3">Desactivar usuarios</a></li>
                                                <li><a href="modificaTusDatos.php">Editar tus datos</a></li>
                                                <li><a href="">Cursos</a></li>
                                                <li><a href="cerrarSesion.php">Cerrar Sesion</a></li>
    					</ul></li>
    				</ul>
    		</nav>
    		<div id='slider'>
    		</div>
        <div class="navegacion">
          <ul id='navegacion_secundaria'>
                 <li><a href="index_administradores.php?pagina=1">Solicitudes de Edición</a></li>
                 <li><a href="index_administradores.php?pagina=2">Activar usuarios</a></li>
                 <li><a href="index_administradores.php?pagina=3">Desactivar usuarios</a></li>
                 <li><a href="modificaTusDatos.php">Editar tus datos</a></li>
                 <li><a href="">Cursos</a></li>

          </ul>
        </div>

    	</header>
        <div id="contenido">
            <?php
            if(isset($_GET['pagina'])){
            $recibe_pagina=$_GET['pagina'];

            switch ($recibe_pagina){
                case 1:
                  include ("solicita_edicion.php");
               break;
               case 2:
                 include ("activar_usuarios.php");
               break;
               case 3:
                 include ("desactivar_usuarios.php");
               break;
                case 4:
                 include ("modificaTusDatos.php");
               break;
               default:
               include ("solicita_edicion.php");//aqui incluyes la pagina que por defecto aparecera si no se leccionan alguna de las otras
               }
               }
               if(isset($_REQUEST['num'])){
                    echo "<p style='color:red'>".validacionExisteUsuario($_REQUEST['num'])."</p>";
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
