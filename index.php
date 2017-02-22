<!--
Editado por Miguel Costa 14/02/2017 13:00
-->
<?php
	include_once("clases/Curso.php");
	require_once 'inc/defines.inc.php';
	require_once 'inc/validaciones.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Práctica</title>
	<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
	<link rel="stylesheet" href="css/main.css" />
	<link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
	<script src="jquery/jquery-3.1.1.min.js" ></script>
	<script src="jquery/jquery_menuMoviles_desplegable.js" ></script>
	<script src="jquery/jquery_formularios.js" ></script>
	<script src="jquery/parallax.js" ></script>
</head>
<body>

	<header>
		<nav>
			<ul id='lista_principal'>
				<li id='inicio'><a href="#" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
				<li id='editor'><a href="#" title=""><i class="fa fa-pencil" aria-hidden="true"></i>Conviértete en editor</a></li>
				<li id='registrarte'><a href="#" title=""><i class="fa fa-unlock-alt" aria-hidden="true"></i>Regístrate</a></li>
				<li id='ini_sesion'><a href="#" title=""><i class="fa fa-user" aria-hidden="true"></i>Inicia Sesión</a></li>
				<li id='menu_moviles'><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul id='lista_movil'>
					<li id='editor2'><a href="#" title="">Conviértete en editor</a></li>
					<li id='registrarte2'><a href="#" title="">Regístrate</a></li>
					<li id='ini_sesion2'><a href="#" title="">Inicia Sesión</a></li>
				</ul></li>

			</ul>
		</nav>
		<div class='formulario' id='registroNuevo'>
			<i class="fa fa-window-close-o" aria-hidden="true"></i>
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
				 <form enctype="multipart/form-data" action="php/grabar_registro_header.php" method="POST" autocomplete="off">

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

		<div class='formulario' id='formularioSesion'>
			<i class="fa fa-window-close-o" aria-hidden="true"></i>
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
				<form  action="php/logueo_header.php" method="post" enctype="application/x-www-form-urlencoded" id="formAcceso">
						<p><label class="icon">Nick</label>
						<input type="text" name="nick" placeholder="Nick" required/></p>

						<p><label class="icon" class='contrasena'>Contraseña</label>
						<input type="password" name="contrasena" placeholder="Contraseña" required/></p>
						<div class='centrado'><input type="submit" name="loguear" value="Acceder" class='botonFormulario'/></div>
				</form>

				</div>
		</div>
		<div class='formulario' id='convierteteEditor'>
		  	<i class="fa fa-window-close-o" aria-hidden="true"></i>
		  	<h2>Regístrate o Inicia sesión para ser editor</h2>

			<form action="/">
				<a href="#" title="" class='boton aceptar'>Aceptar</a>
			</form>
		</div>

		<div id='slider'>
			<div id='buscador'>
				<form action="buscador.php" method="POST">
					<label><p>Busca tus temas</p><input type="search" name="nombre" placeholder="Buscar"></label>
				</form>
			</div>
		</div>
	</header>

	<section class='cursosPopulares'>
		<h2>Cursos más populares</h2>
		<ul class="temas_flex">
			<!--<li>
                <div class='imagen'><img src="./img/php.png" /></div>
                <div class='modulo'>
                	<h2>PHP</h2>
                	<div class='descripcion'>
                		<ul>
			                <li>Nicolás Fdez Arellano</li>
							<li>Tutor DAW (Desarrollo de Aplicaciones Web)</li>
							<li>IES Galileo</li>
						</ul>
		            </div>
		            <div class='descargar'>
		            	<p><a href="#" class="boton">DESCARGAR</a></p>
		            </div>
	            </div>
			</li>
			<li>
                <div class='imagen'><img src="./img/javascript.png" /></div>
                <div class='modulo'>
                	<h2>JAVASCRIPT</h2>
                	<div class='descripcion'>
		                <ul>
			                <li>David Marín Álvarez</li>
							<li>IES Galileo</li>
						</ul>
		            </div>
		            <p class='descargar'><a href="#" class="boton rojo">DESCARGAR</a>
	            </div>
			</li>
			<li>
                <div class='imagen'><img src="./img/interfaces.png" /></div>
                <div class='modulo'>
                	<h2>INTERFACES</h2>
                	<div class='descripcion'>
		                <ul>
			                <li>Ángel T. Domínguez</li>
							<li>IES Galileo</li>
						</ul>
		            </div>
		            <p class='descargar'><a href="#" class="boton rojo">DESCARGAR</a>
	            </div>
			</li>-->
			<?php
					$cursos = Curso::cursos_mejor_valorados();
					foreach ($cursos as $key => $value) {
						Curso::imprimir_curso_mv($value);
					}
			 ?>
		</ul>
	</section>

	<section class='ultimosSubidos'>
		<h2>Últimos temas subidos</h2>
		<ul class="temas_flex">
			<li>
                <div class='imagen'><img src="./img/php.png" /></div>
                <div class='modulo'>
                	<h2>PHP</h2>
                	<div class='descripcion'>
                		<ul>
			                <li>Nicolás Fdez Arellano</li>
							<li>Tutor DAW (Desarrollo de Aplicaciones Web)</li>
							<li>IES Galileo</li>
						</ul>
		            </div>
		            <div class='descargar'>
		            	<p><a href="#" class="boton rojo">DESCARGAR</a></p>
		            </div>
	            </div>
			</li>
			<li>
                <div class='imagen'><img src="./img/javascript.png" /></div>
                <div class='modulo'>
                	<h2>JAVASCRIPT</h2>
                	<div class='descripcion'>
		                <ul>
			                <li>David Marín Álvarez</li>
							<li>IES Galileo</li>
						</ul>
		            </div>
		            <p class='descargar'><a href="#" class="boton rojo">DESCARGAR</a>
	            </div>
			</li>
			<li>
                <div class='imagen'><img src="./img/interfaces.png" /></div>
                <div class='modulo'>
                	<h2>INTERFACES</h2>
                	<div class='descripcion'>
		                <ul>
			                <li>Ángel T. Domínguez</li>
							<li>IES Galileo</li>
						</ul>
		            </div>
		            <p class='descargar'><a href="#" class="boton rojo">DESCARGAR</a>
	            </div>
			</li>
        </ul>
	</section>

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
