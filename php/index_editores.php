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
      <script src="../jquery/jquery_listaDeslizante.js" ></script>
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
                 <li><a href="index_editores.php?pagina=1">Crear curso</a></li>
                 <li><a href="index_editores.php?pagina=2">Subir temas</a></li>
                 <li><a href="modificaTusDatos.php">Editar tus datos</a></li>
                 <li><a href="index_editores.php?pagina=3">Cursos</a></li>
          </ul>
        </div>
      </header>
      <div id='usuario'>
        <?php
        if(isset($_GET['pagina'])){
          switch ($_GET['pagina']) {
            case '1':
               // Pagina Cursos //

               // Pagina Cursos //
            break;
            case '2':
               // Pagina Cursos //

               // Pagina Cursos //
            break;
            case '3':
               // Pagina Gestion Cursos //
               $registros_cursos = $curso->ver_cursos_light();
               echo "<ul class='temas_flex_2'>";
               while($row = $registros_cursos->fetch_assoc()){
                 if(Curso::soy_editor_de_este_curso($id_usuario,$row['id_curso'])=='false'){
                   Curso::imprimir_curso_usuario($row,$id_usuario);
                 }
               }
               echo "</ul>";
               // Pagina Gestion Cursos //
            break;
            default:
              $p=$curso->verCursosInscritos($id_usuario);
            if($p=="Todavia no te has registrado en ningún curso.   ANIMATE"){
              echo"<h1>".$p."</h1>";
              $curso->verCursos();
            }
            break;
          }
        } else {
          $p=$curso->verCursosInscritos($id_usuario);
          if($p=="Todavia no te has registrado en ningún curso.   ANIMATE"){
            echo"<h1>".$p."</h1>";
            $curso->verCursos();
          }
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
    <script type="text/javascript">
      $("document").ready(function(){
        var numero_de_cursos = $(".temas_flex_2").children().length ;
        for (var i = 0; i <= numero_de_cursos; i++) {
          $("#curso_"+i).click(function() {
            var boton = $(this) ;
            $.ajax({
                data: { 'id_usuario' :<?php echo $_SESSION['id_usuario'] ?>, 'id_curso':boton.val() },
                type: 'POST',
                url: '../inc/funciones_AJAX.php?codigoFuncion=4',
                success:function() {
                  if(boton.hasClass('boton-inscribir')){
                    alert("Te apuntaste correctamente al curso, ahora puedes leer la documentación.");
                    boton.removeClass('boton-inscribir');
                    boton.addClass('boton-desinscribir');
                    boton.html("Desinscribirse");
                  } else {
                    alert("Te desapuntaste correctamente al curso.");
                    boton.removeClass('boton-desinscribir');
                    boton.addClass('boton-inscribir');
                    boton.html("Inscribirme");
                  }
                }
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
          });
        }
      });
    </script>
</html>
