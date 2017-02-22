<?php
require_once 'inc/funciones.php';
sesion();
require_once 'inc/validaciones.inc.php';
if(!isset($_GET['curso'])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <style type="text/css">
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
    <?php
        // Prueba Votos //
        // Prueba activar y desactivar tema //
        // Ambas funcionalidades implementadas con AJAX //
        include_once("clases/Connection.php");
        include_once("clases/Curso.php");
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "Select * from temas where id_curso=".$_GET['curso'].";";
        $resultado = $conexion->query($consulta);
        $activo = "";
        while($row = $resultado->fetch_assoc()){
            $activo = $row['activo']=='si'? 1: 0 ;
            echo "<p>".$row['titulo']."</p>" ;
            echo "<div class='estrellas'></div>" ;
            echo "<label>disponibilidad del Tema: <input ";
            if($activo){
              echo "checked";
            }
            echo " type='checkbox' value='";
            if(!$activo){
              echo "1";
            } else {
              echo "0";
            }
            echo "' class='valor_actual' name='".$row['id_tema']."'></label>";
        }

        foreach ($_SESSION as $key => $value) {
            if(is_array($value)){
                print_r($value);
                echo " ".$key."</br>";
            } else {
                echo $key." --- ".$value."</br>";
            }

        }

    ?>
    <h1></h1>
    <p style="width:40%; display:inline;">Aqui Probaremos desinscribir en un curso:
        <ul id="desinscribir_curso">
          <?php
            $consulta = "select * from cursos, inscritos_curso where inscritos_curso.id_usuario=5 and cursos.id_curso=inscritos_curso.id_curso and cursando='si';" ;
            $resultado = $conexion->query($consulta);
            while($row = $resultado->fetch_assoc()){
              // EXISTEN MUCHAS MANERAS DE COGER EL CODIGO DEL ALUMNO
              // IMPRIMIENDOLO EN EL SCRIPT, EN LA PROPIA ETIQUEDA DEL IMPUT, COGIENDO
              // EL NOMBRE DE LA PAGINA.
              if($row['activo']=='si'){
                  echo "<li>".$row['titulo']." --- <input type='checkbox' name='".$row['id_curso']."' value='5' class='desins'></li>";
              }
            }
          ?>
        </ul>
    </p>
    <p style="width:40%; display:inline;">Aqui Probaremos inscribir en un curso:
        <ul id="inscribir_curso">
          <?php
          $consulta = "SELECT * FROM `cursos` ;" ;
          $resultado = $conexion->query($consulta);
          while($row = $resultado->fetch_assoc()){
            // EXISTEN MUCHAS MANERAS DE COGER EL CODIGO DEL ALUMNO
            // IMPRIMIENDOLO EN EL SCRIPT, EN LA PROPIA ETIQUEDA DEL IMPUT, COGIENDO
            // EL NOMBRE DE LA PAGINA.
            if($row['activo']=='si'){
                echo "<li>".$row['titulo']." --- <input type='checkbox' name='".$row['id_curso']."' value='5' class='ins'></li>";
            }
          }

          ?>
        </ul>
    </p>


    <!--<div class="estrellas"></div>-->
    <a href="index.php">Volver</a>
    <script src="jquery/jquery-3.1.1.min.js"></script>
    <script src="jquery/starrr.js"></script>
    <script type="text/javascript">

         $(document).ready(function(){
             // Imprimir scripts diferentes cuando estes logueado //

             <?php
                if( isset($_SESSION['datos']['id_usuario']) ){
                    // Haremos la prueba con el id 3
                    $editor = Curso::soy_editor_de_este_curso(3,$_GET['curos']);
                    echo "$('.estrellas').starrr({
                        rating: ".Curso::valoracion_tema($_GET['curos']).", //Estrellas se estaran iluminadas en un principio
                        max: 5, // Maximo de estrellas
                        readOnly: '".$editor."', // Solo Lectura
                        change:function(e,valor){
                            // Cuando cambie el valor de las estrellas Haz X
                            $.ajax({
                                data: {'usuario' : ".$_SESSION['datos']['id_usuario'].", 'tema': ".$_GET['curos'].", 'voto': valor},
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
                } else {
                    echo "$('.estrellas').starrr({
                        rating: ".Curso::valoracion_tema($_GET['curso']).", //Estrellas se estaran iluminadas en un principio
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


             ?>

             // Voy a probar el script de modificacion de disponibilidad de un tema //

             $(".valor_actual").change(function(){
                 //alert($(this).val() +" "+$(this).attr("name"));
                 // Cuando Hagamos el done cambiar el valor del checkbox //
                 var checkbox_clickeado =  $(this) ;
                $.ajax({
                    data: {'tema' : checkbox_clickeado.attr('name'), 'valor_actual': checkbox_clickeado.val() },
                    type: 'POST',
                    url: 'inc/funciones_AJAX.php?codigoFuncion=3',
                    success:function(data) {
                      if(data!=0){
                          if(checkbox_clickeado.val()==1){
                            checkbox_clickeado.val(0);
                          } else {
                            checkbox_clickeado.val(1);
                          }
                      }
                    }
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    if ( console && console.log ) {
                        console.log( 'La solicitud a fallado: ' +  textStatus);
                    }
                });
             })

             // Voy a probar el script de modificacion de disponibilidad de un tema //
             // Voy a probar el script de activar y desactivar de un curso //
             $(".desins").change(function(){
               var registro = $(this).parent() ;
               console.log({'id_usuario':$(this).val(),'id_curso':$(this).attr('name')});
               $.ajax({
                 data:{'id_usuario':$(this).val(),'id_curso':$(this).attr('name')},
                 type:'POST',
                 url:'inc/funciones_AJAX.php?codigoFuncion=4',
                 success:function(data){
                   console.log(data);
                    if(data==1){
                      alert("OPERACION REALIZADA CORREXTAMENTE");
                      $("#inscribir_curso").append(registro);
                    } else {
                      alert("FALLO!");
                    }
                 }
               });

             });
             $(".ins").change(function(){
               var registro = $(this).parent() ;
               console.log({'id_usuario':$(this).val(),'id_curso':$(this).attr('name')});
               $.ajax({
                 data:{'id_usuario':$(this).val(),'id_curso':$(this).attr('name')},
                 type:'POST',
                 url:'inc/funciones_AJAX.php?codigoFuncion=4',
                 success:function(data){
                   console.log(data);
                    if(data==1){
                      alert("OPERACION REALIZADA CORREXTAMENTE");
                      $("#desinscribir_curso").append(registro) ;
                    } else {
                      alert("FALLO!");
                    }
                 }
               });

             });


             // Voy a probar el script de activar y desactivar de un curso //
        });


    </script>
</body>
</html>
