<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once("../clases/Curso.php");
$curso=new Curso();
sesion();
//nos aseguramos que pertenece al tio 3 de editores
if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario'])==1 OR isset($_SESSION['datos']['id_tipo_usuario'])==2)){
$foto=$_SESSION['foto'];
            //echo $foto;
$nick=$_SESSION['datos']['nick'];
$id_usuario=$_SESSION['datos']['id_usuario'];
}
?>
<!DOCTYPE html>

<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Página Editor</title>
      <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
      <link rel="stylesheet" href="../css/bootstrap.min.css" />
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
            <li id='inicio'><a href="../index.php" title=""><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
            <li id='perfil1'><a href="modificaTusDatos.php"><img src="<?php echo $foto;?>" alt=""></a> Hola <?php echo $nick;?>!<i class="fa fa-angle-down" aria-hidden="true"></i>
              <ul class='perfil' id='perfil_usuario'>
                <li><a href="">Crear curso</a></li>
                <li><a href="">Subir temas</a></li>
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
                 <li><a href="">Crear curso</a></li>
                 <li><a href="">Subir temas</a></li>
                 <li><a href="modificaTusDatos.php">Editar tus datos</a></li>
                 <li><a href="">Cursos</a></li>
          </ul>
        </div>
      </header>
      <div id='usuario'>
        <?php
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
