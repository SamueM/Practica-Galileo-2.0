<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Página perfil</title>
	<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/main_perfil.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
	<script src="jquery/jquery-3.1.1.min.js" ></script>
	<script type="text/javascript" src="jquery/jquery_menu_desplegable.js"></script>
</head>
<body>

	<header>
		<nav>
			<ul id='lista_principal'>
				<li id='inicio'><a href="" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
				<li id='perfil'><img src="" alt="">Miguel Costa<i class="fa fa-angle-down" aria-hidden="true"></i>
					<ul class='perfil' id='perfil_usuario'>
						<li>Cursos</li>
						<li>Gestión de usuarios</li>
						<li>Gestión de cursos</li>
						<li>Editar usuario</li>
						<li>Conviértete en editor</li>
						<li>Cerrar sesión</li>
					</ul></li>
				</ul>
		</nav>
		<div id='slider_perfil'>
		</div>
	</header>

	<div id='usuario'>
		<div id='imagen'>
			<img src="almacen_fotos/Lucas.png" alt="">
		</div>
		<div id='info_perfil'>
			<h2>Miguel Costa</h2>

			<ul>
				<li>Nick: Costa82</li>
				<li>Email: costa_torito@hotmail.com</li>
				<li>Fecha nacimiento: 06/04/1982</li>
				<li>Telefono: 666666666</li>
				<li>Dirección: Valladolid</li>
				<li>Tipo de usuario: Alumno </li>
			</ul>
		</div>
		<div id='menu_lateral'>
			<a class="enlace" href="" class='button'>Quiero ser editor</a>
			<ul class='perfil' id='perfil_usuario_lateral'>

						<li>Cursos</li>
						<li>Gestión de usuarios</li>
						<li>Gestión de cursos</li>
						<li>Editar usuario</li>
			</ul>
		</div>


	</div>
	<article id='cursos'>
		<div id='imagen'>
			<img src="img/php.png" alt="">
		</div>
		<div id='descripcion_curso'>
			<h2>PHP</h2>
			 	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ullamcorper. Suspendisse massa arcu, eleifend id gravida scelerisque, placerat non diam. Nunc posuere lectus neque, ac semper magna molestie in. Integer tristique, felis eu interdum consequat, nulla odio congue enim, eget posuere orci neque ut ligula. Aenean at auctor elit. Vivamus tristique elit in nisl lacinia, eu tempor libero placerat. Vestibulum pulvinar augue sit amet quam dapibus, lacinia ultricies justo blandit. Vivamus a ultricies massa. Mauris vulputate volutpat bibendum.</p>
			<ul id='temas'>
				<li><h2>TEMA 1. INTRODUCCIÓN</h2>
				<p class='descripcion_tema'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ullamcorper. Suspendisse massa arcu, eleifend id gravida scelerisque, placerat non diam. Nunc posuere lectus neque, ac semper magna molestie in. Integer tristique, felis eu interdum consequat, nulla odio congue enim, eget posuere orci neque ut ligula. Aenean at auctor elit. Vivamus tristique elit in nisl lacinia, eu tempor libero placerat. Vestibulum pulvinar augue sit amet quam dapibus, lacinia ultricies justo blandit. Vivamus a ultricies massa. Mauris vulputate volutpat bibendum.<a href=""><i class="fa fa-download" aria-hidden="true"></i></a></p></li>
				<li><h2>TEMA 2. DESARROLLO</h2>
				<p class='descripcion_tema'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ullamcorper. Suspendisse massa arcu, eleifend id gravida scelerisque, placerat non diam. Nunc posuere lectus neque, ac semper magna molestie in. Integer tristique, felis eu interdum consequat, nulla odio congue enim, eget posuere orci neque ut ligula. Aenean at auctor elit. Vivamus tristique elit in nisl lacinia, eu tempor libero placerat. Vestibulum pulvinar augue sit amet quam dapibus, lacinia ultricies justo blandit. Vivamus a ultricies massa. Mauris vulputate volutpat bibendum.<a href=""><i class="fa fa-download" aria-hidden="true"></i></a></p></li>
				<li><h2>TEMA 3. CONCLUSIÓN</h2>
				<p class='descripcion_tema'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ullamcorper. Suspendisse massa arcu, eleifend id gravida scelerisque, placerat non diam. Nunc posuere lectus neque, ac semper magna molestie in. Integer tristique, felis eu interdum consequat, nulla odio congue enim, eget posuere orci neque ut ligula. Aenean at auctor elit. Vivamus tristique elit in nisl lacinia, eu tempor libero placerat. Vestibulum pulvinar augue sit amet quam dapibus, lacinia ultricies justo blandit. Vivamus a ultricies massa. Mauris vulputate volutpat bibendum.<a href=""><i class="fa fa-download" aria-hidden="true"></i></a></p></li>
			</ul>
		</div>
	</article>
</body>
</html>
