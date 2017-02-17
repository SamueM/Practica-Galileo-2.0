<?php 
    include_once("clases/curso.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buscador</title>
</head>
<body>
    <h1>Cursos:</h1>
    <?php
        // Autor: Samuel M. 14/02/2017 //
        // Prueba buscarNombre() //
        if(isset($_POST['nombre'])){
            $resultados = curso::bucarNombre($_POST['nombre']);
            if($resultados==0){
                echo "Se ha producido un error en la busqueda." ;
            } else if($resultados['numero']==0){
                echo "<h2>No se encontraron resultados al buscar: '".$_POST['nombre']."' </h2>";
            }else {
                echo "<h2>Se encontraron ".$resultados['numero']." resultados al buscar: '".$_POST['nombre']."' </h2>";
                for($i = 0; $i < count($resultados['filas_consulta']) ; $i++){
                    foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                        if($key == "id_curso" ){
                            echo $key." ----- ".$value." <button class='v_t' value='".$value."'>Ver Temas</button><br/>" ;
                            $id_curso_actual = $value ;
                        } else {
                            echo $key." ----- ".$value."<br/>" ;
                        }
                    }
                    // Aqui se imprimiran los temas del curso X
                    echo "<div id=temas_de_".$id_curso_actual." style='float:left'></div><br/><br/><br/>";
                }
                
            }
        } else {
            $resultados = curso::bucarNombre("%");
            if($resultados==0){
                echo "Se ha producido un error en la busqueda." ;
            } else if($resultados['numero']==0){
                echo "<h2>No se encontraron resultados al buscar: '".$_POST['nombre']."' </h2>";
            }else {
                echo "<h2>Se encontraron ".$resultados['numero']." (Todos los cursos) </h2>";
                for($i = 0; $i < count($resultados['filas_consulta']) ; $i++){
                    foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                        if($key == "id_curso" ){
                            echo $key." ----- ".$value." <button class='v_t' value='".$value."'>Ver Temas</button><br/>" ;
                            $id_curso_actual = $value ;
                        } else {
                            echo $key." ----- ".$value."<br/>" ;
                        }
                    }
                    // Aqui se imprimiran los temas del curso X
                    echo "<div id=temas_de_".$id_curso_actual." style='float:left'></div><br/><br/><br/>";
                }
                
            }
        }
    ?>
    <script src="jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".v_t").on("click",function(){
                //console.log($(this).val());
                var nodo_de_ejecucion = $(this) ;
                $.ajax({
                    data: {"curso": nodo_de_ejecucion.val() },
                    type: "POST",
                    url: "inc/funciones_AJAX.php?codigoFuncion=2",
                    //dataType:"json",
                    success: function(data){
                        console.log(data+" "+'temas_de_'+nodo_de_ejecucion.val());
                        var parametro = JSON.parse(data) ;
                        var nodos = $('#temas_de_'+nodo_de_ejecucion.val()) ;
                        for(var i =0 ; i<parametro.length ; i++){
                            console.log("Titulo: "+parametro[i].titulo+" -- Descripccion:"+parametro[i].descripcion+"  "+nodos);

                            nodos.html("<p>Titulo: "+parametro[i].titulo+" -- Descripccion:"+parametro[i].descripcion+"</p>");
                        }

                    }
                })
                .done(function(data){
                    if(data == 0 ){
                        alert("No hay temas en este curso todavia :/");
                    }
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    if ( console && console.log ) {
                        console.log( "La solicitud a fallado: " +  textStatus);
                    }
                });
            });
        });
    </script>
</body>
</html>