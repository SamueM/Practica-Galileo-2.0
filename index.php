<!--
- Práctica DAW IES Galileo 2017
-
- Archivo index
-
- @project  2ºDAW, Módulos de DIW, EC y ES
- @author   Isabel, Cristina, Samuel, Alejandro y Miguel
-
-->

<?php
	include_once("clases/Curso.php");
	require_once 'inc/funciones.php';
	sesion();
	if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario'])==1 OR isset($_SESSION['datos']['id_tipo_usuario'])==2)){
		$foto=$_SESSION['foto'];
		$nick=$_SESSION['datos']['nick'];
	}
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
	<script src="jquery/jquery_listaDeslizante.js" ></script>
	<script src="jquery/parallax.js" ></script>
</head>
<body>
	<header>
		<nav>
			<ul id='lista_principal'>
				<li id='inicio'><a href="" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
				<?php
				if(isset($_SESSION['id_usuario'])){
						$id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
						if($id_tipo_usuario==4){
							echo "<li id='editor'><a href='' title=''><i class='fa fa-pencil' aria-hidden='true'></i>Conviértete en editor</a></li>" ;
						}
				} else {
						echo "<li id='editor'><a href='' title=''><i class='fa fa-pencil' aria-hidden='true'></i>Conviértete en editor</a></li>" ;
				}
				?>
				<li id='registrarte'>
					<?php
						if(isset($_SESSION['id_usuario'])){
							echo "<i class='fa fa-unlock-alt' aria-hidden='true'></i><a href='./php/cerrarSesion.php'>Cerrar Sesion</a>";
						} else {
							echo "<a href='./php/registrate.php' title=''><i class='fa fa-unlock-alt' aria-hidden='true'></i>Regístrate</a>";
						}
					?>
				</li>
				<li id='ini_sesion'>
					<?php
						if(isset($_SESSION['id_usuario'])){
							$id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
	            switch ($id_tipo_usuario){
	                case 1:
	                case 2:
	                    $destino="index_administradores.php";
	                break;
	                case 3:
	                    $destino="index_editores.php";
	                break;
	                case 4:
	                    $destino="index_suscriptores.php";
	                break;
	                default:
	                    $num=-201;
	                    $destino="iniciar_sesion.php?num=$num";
	                break;
	            }
							echo "<a href='./php/".$destino."'>";
							echo "<img src=".substr($_SESSION['foto'],3,strlen($_SESSION['foto']))." width='50px'>".$_SESSION['datos']['nick']."</a>" ;
						} else {
							echo "<a href='./php/iniciar_sesion.php'><i class='fa fa-user' aria-hidden='true'></i>Inicia Sesión</a>" ;
						}
					?>
				</li>
				<li id='menu_moviles'><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul id='lista_movil'>
					<li id='editor2'><a href="" title="">Conviértete en editor</a></li>
					<!--<li id='registrarte2'><a href="./php/registrate.php" title="">Regístrate</a></li>-->
					<li id='registrarte2'>
						<?php
							if(isset($_SESSION['id_usuario'])){
								$id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
		            echo "<a href='./php/cerrarSesion.php'>Cerrar Sesion</a>";
							} else {
								echo "<a href='./php/registrate.php' title=''>Regístrate</a>";
							}
						?>
					</li>
					<li id='ini_sesion2'>
						<?php
							if(isset($_SESSION['id_usuario'])){
								$id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
		            switch ($id_tipo_usuario){
		                case 1:
		                case 2:
		                    $destino="index_administradores.php";
		                break;
		                case 3:
		                    $destino="index_editores.php";
		                break;
		                case 4:
		                    $destino="index_suscriptores.php";
		                break;
		                default:
		                    $num=-201;
		                    $destino="iniciar_sesion.php?num=$num";
		                break;
		            }
								echo "<a href='./php/".$destino."'>";
								echo "<img src=".substr($_SESSION['foto'],3,strlen($_SESSION['foto']))." width='50px'>".$_SESSION['datos']['nick']."</a>" ;
							} else {
								echo "<a href='./php/iniciar_sesion.php'>Inicia Sesión</a>" ;
							}
						?>
					</li>
				</ul></li>
			</ul>
		</nav>
		<div class='formulario' id='convierteteEditor'>
		  	<i class="fa fa-window-close-o" aria-hidden="true"></i>
		  	<h2>Regístrate o Inicia sesión para ser editor</h2>
			<div class='botones'>
				<button type="button" onclick=" location.href='./php/registrate.php' " class="boton">Regístrate</button>
				<button type="button" onclick=" location.href='./php/iniciar_sesion.php' " class="boton">Inicia sesión</button>
			</div>
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
			<?php
				Curso::ultimos_temas_subidos();
			?>
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
