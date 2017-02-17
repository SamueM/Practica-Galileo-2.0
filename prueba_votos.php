<?php
require_once 'inc/funciones.php';
sesion();
require_once 'inc/validaciones.inc.php';
if(!isset($_GET['tema'])){
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
        include_once("clases/Connection.php");
        include_once("clases/Curso.php");        
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "Select * from temas limit 1;";
        $resultado = $conexion->query($consulta);
        while($row = $resultado->fetch_assoc()){
            echo $row['titulo'] ;
            echo "<div class='estrellas'></div>" ;
        }

        foreach ($_SESSION as $key => $value) {
            if(is_array($value)){
                print_r($value);
                echo " ".$key."</br>";
            } else {
                echo $key." --- ".$value."</br>";
            }
            
        }


        // Voy a probar el script de modificacion de disponibilidad de un tema //
        echo "<label>disponibilidad del curso: <input checked type='checkbox' value='1' id='valor_actual' name='1'></label>";

        // Voy a probar el script de modificacion de disponibilidad de un tema //

    ?>
    <h1></h1>

    <!--<div class="estrellas"></div>-->
    <a href="index.php">Volver</a>
    <script src="jquery/jquery-3.1.1.min.js"></script>
    <script src="jquery/starrr.js"></script>
    <script type="text/javascript">

         $(document).ready(function(){
             // Imprimir scripts diferentes cuando estes logueado //

             <?php
                if( isset($_SESSION['datos']['id_usuario']) ){
                    echo "$('.estrellas').starrr({
                        rating: ".Curso::valoracion_tema($_GET['tema']).", //Estrellas se estaran iluminadas en un principio
                        max: 5, // Maximo de estrellas
                        readOnly: 'false', // Solo Lectura
                        change:function(e,valor){
                            // Cuando cambie el valor de las estrellas Haz X
                            $.ajax({
                                data: {'usuario' : ".$_SESSION['datos']['id_usuario'].", 'tema': ".$_GET['tema'].", 'voto': valor},
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
                        rating: ".Curso::valoracion_tema($_GET['tema']).", //Estrellas se estaran iluminadas en un principio
                        max: 5, // Maximo de estrellas
                        readOnly: 'true', // Solo Lectura
                        change:function(e,valor){
                            // Cuando cambie el valor de las estrellas Haz X
                            $.ajax({
                                data: {'usuario' : 1, 'tema': ".$_GET['tema']." , 'voto': valor},
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

             $("#valor_actual").change(function(){
                 alert($(this).val() +" "+$(this).attr("name"));
                 // Cuando Hagamos el done cambiar el valor del checkbox //
                /*$.ajax({
                    data: {'tema' : $(this).attr('name'), 'valor_actual': $(this).val() },
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
                });*/
             })

             // Voy a probar el script de modificacion de disponibilidad de un tema //
        });

    </script>
</body>
</html> 