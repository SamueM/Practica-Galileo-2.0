 <?php

    $id_usuario=$_GET["id"];
    $id_curso=$_GET["curso"];
    $con  = mysqli_connect("localhost","root","","bd_cursosgalileo");
    $sql="SELECT * FROM inscritos_curso WHERE id_usuario='".$id_usuario."' AND id_curso='".$id_curso."'";
            if($con->real_query($sql)){
                   if($resul=$con->store_result()){
                     if($resul->num_rows==0){
                        $sql="INSERT INTO inscritos_curso (id_usuario,id_curso,cursando,favorito) VALUES('$id_usuario','$id_curso','si','no')";
                        if($con->real_query($sql)){
                            echo "<h3>Te has registrado con exito<h3>";
                        }else{
                              echo $con->errno." -> ".$con->error;
                        }
                     }else{
                        $resul->free_result();
                        echo "<h3>Ya te has registrado en este curso<h3>";
                     }
                   }
            }else{
                  echo $con->errno." -> ".$con->error;
            }
 ?>