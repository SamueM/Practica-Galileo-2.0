<?php
require_once 'inc/funciones.php';
sesion();
require_once 'inc/validaciones.inc.php';
include_once("clases/Curso.php");
if(!isset($_GET['curso'])){
    header("Location:index.php");
} else if(!Curso::existeIdCurso($_GET['curso'])){
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Página curso</title>
	<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/main_perfil.css" />
	<link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
	<script src="jquery/jquery-3.1.1.min.js" ></script>
	<script type="text/javascript" src="jquery/jquery_menu_desplegable.js"></script>
	<script type="text/javascript" src="jquery/jquery_acordeon.js"></script>
	<script src="jquery/jquery_menuMoviles_desplegable.js" ></script>
  <script src="jquery/jquery_listaDeslizante.js" ></script>
	<style type="text/css">
			.estrellas {
				text-align: center;
			}
			.fa-star, .fa-star-o {
					color: yellow ;
					text-decoration: none;
			}
			.fa-star:hover {
					color: yellow ;
					text-decoration: none;
			}
	</style>

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
				/*
					if(isset($_SESSION['id_usuario'])){
					} else {
						echo "<li id='editor'><a href='' title=''><i class='fa fa-pencil' aria-hidden='true'></i>Conviértete en editor</a></li>";
					}
					*/
				?>
				<li id='registrarte'>
					<?php
						if(isset($_SESSION['id_usuario'])){
							echo "<i class='fa fa-unlock-alt' aria-hidden='true'></i><a href='./php/cerrarSesion.php'>Cerrar Sesion</a>";
							/*
							echo "<a href='./php/cerrarSesion.php'><i class='fa fa-lock' aria-hidden='true'></i>Cerrar Sesion</a>";
							*/
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
		<div id='slider_perfil'>
		</div>
	</header>
	<article id='curso'>
		<div class='imagen'>
      <?php
        $curso = new Curso();
      ?>
			<img <?php echo "src='img_cursos/".$curso->get_imagen($_GET['curso'])."'" ; ?> alt="">
			<div class='estrellas'></div>
      <?php
        echo "<p class='nota_numerica'> Nota media: ".Curso::valoracion_curso($_GET['curso'])."/5 </p>";

      ?>
		</div>
		<div id='descripcion_curso'>
			<h2><?php echo $curso->nombreCurso($_GET['curso']) ;?></h2>
			 	<p><?php echo $curso->get_descripcion($_GET['curso']) ;?></p>
			<ul id='temas'>
        <?php
            $temas = $curso->visualizar_temas($_GET['curso']);
            if(isset($_SESSION['datos']['id_usuario'])){
              $inscri = Curso::estoy_inscrito($_SESSION['datos']['id_usuario'],$_GET['curso']);
            }
            foreach ($temas as $key => $value) {
              echo "<li>
              <h2 class='titulo_tema'>TEMA ".($key+1).". ".$value['titulo']."</h2>
              <div class='sangrado descripcion_tema'>
      				<p class=''> ".$value['descripcion'] ;
              if(isset($inscri)){
                echo "<a href='cursos/".$value['ruta']."/".$value['url']."' >" ;
              } else {
                echo "<a>" ;
              }
              echo "<i class='fa fa-download' aria-hidden='true'></i>
              </a>
              <div class='estrellas_".$value['id_tema']."'></div>
              </p>
              </div>
              </li>";
            }
        ?>
			</ul>
		</div>
	</article>
	<!-- Votacion -->
	<script src="jquery/jquery-3.1.1.min.js"></script>
	<script src="jquery/starrr.js"></script>
	<script type="text/javascript">

			 $(document).ready(function(){
					 // Imprimir el script de la media del curso //
           $('.estrellas').starrr({
               rating: <?php echo Curso::valoracion_curso($_GET['curso']) ;?>,
               max: 5,
               readOnly: 'true',
               change:function(e,valor){
                 // No va a cambiar //
               }
           });

           //  Imprimir el script de la media del curso //
					 <?php
							if( isset($_SESSION['id_usuario']) ){
									$editor = Curso::soy_editor_de_este_curso($_SESSION['datos']['id_usuario'],$_GET['curso']);

                  foreach ($temas as $key => $value) {
                    if($editor=='false' && $inscri){
                      echo "$('.estrellas_".$value['id_tema']."').starrr({
    											rating: ".Curso::valoracion_tema_alumno($value['id_tema'],$_SESSION['id_usuario']).",
    											max: 5, // Maximo de estrellas
    											change:function(e,valor){
    													$.ajax({
    															data: {'usuario' : ".$_SESSION['id_usuario'].", 'tema': ".$value['id_tema'].", 'voto': valor},
    															type: 'POST',
    															url: 'inc/funciones_AJAX.php?codigoFuncion=1',
    													})
    													.done(function( data, textStatus, jqXHR ) {
    															if(data==0){
    																	alert('Comprueba si estas suscrito en el curso.');
    															}
    													})
    													.fail(function( jqXHR, textStatus, errorThrown ) {
    															if ( console && console.log ) {
    																	console.log( 'La solicitud a fallado: ' +  textStatus);
    															}
    													});
    											}
    									});" ;
                    }
                }
							} else {
                foreach ($temas as $key => $value) {
                  echo "$('.estrellas_".$value['id_tema']."').starrr({
											rating: ".Curso::valoracion_tema($value['id_tema']).",
											max: 5, // Maximo de estrellas
											readOnly: 'true', // Solo Lectura
											change:function(e,valor){
													// Cuando cambie el valor de las estrellas Haz X
													$.ajax({
															data: {'usuario' : 1, 'tema': ".$_GET['curso']." , 'voto': valor},
															type: 'POST',
															url: 'inc/funciones_AJAX.php?codigoFuncion=1',
													})
													.done(function( data, textStatus, jqXHR ) {
															if(data==0){
																	alert('Comprueba si estas suscrito en el curso.');
															}
													})
													.fail(function( jqXHR, textStatus, errorThrown ) {
															if ( console && console.log ) {
																	console.log( 'La solicitud a fallado: ' +  textStatus);
															}
													});
											}
									});" ;
                }
							}


					 ?>
			});

	</script>
</body>
</html>
