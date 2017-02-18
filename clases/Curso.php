<?php
	require_once 'Connection.php';
	class Curso{
		   private $c;
   		   private $tabla;
   		   public function __construct() {
       			 $bd=  Connection::dameInstancia();
      			  $this->c=$bd->dameConexion();
       			  $this->tabla="cursos";
   		   }


   		   public function existCurso($title){
   		   		$sql="SELECT * FROM ".$this->tabla." WHERE titulo='".$title."'";
   		   		if($this->c->real_query($sql)){
   		   			if($resul=$this->c->store_result()){
   		   				if($resul->num_rows==0){
   		   					return true;
   		   				}else{
                           return false;
                        }
   		   			}
   		   		}else{
   		   			return $this->c->errno." -> ".$this->c->error;
   		   		}
   		   }

   		   public function addCurso($id_usuario,$title,$descri,$date,$active,$img){  //mkdir("/ruta/a/mi/directorio", 0700);  Crear un directorio
                 echo $title;
                 echo "<h3>Prueba</h3>";
                 if($this->existCurso($title)){
                  $foto=$this->guardarImgCurso($title,$img);
   		   		$sql="INSERT INTO ".$this->tabla." (id_usuario,titulo,descripcion,fecha_creacion,activo,foto) VALUES(?,?,?,?,?,?)";
   		   		$sen=$this->c->prepare($sql);
   		   		$sen->bind_param("isssss",$id_usuario,$title,$descri,$date,$active,$foto);
   		   		if($sen->execute()){
                     mkdir("../cursos/".$title, 0700);
                     mkdir("../cursos/".$title."/imagenes", 0700);
                     echo "<h2>Se ha añadido correctamente</h2>";
                  }else{
                     echo "<h1>No se pudo añadir correctamente el curso</h1>";
                     echo $sen->error;
                  }
                }else{
                   echo "<h1>error: Ya existe la base de datos<h1>";
                }

   		   }
            public function guardarImgCurso($nick,$archivo_foto){
                   $foto_name = $archivo_foto['name'];
                   $foto_type=$archivo_foto['type'];
                  $foto_tmp_name=$archivo_foto['tmp_name'];
                  $foto_size=$archivo_foto['size'];
                  if($foto_type=="image/jpeg" || $foto_type=="image/pjpeg"){
                     $extension="jpg";
                }elseif ($foto_type=="image/png") {
                     $extension="png";
                }else{
                     $extension=NULL;
                }
               $ruta="NULL";
              $rutaBD="NULL";
             $lugar='../img_Cursos/';
            //Validamos la fotografía
           if($foto_name!=NULL AND $extension!=NULL AND $foto_size!=0){
               if($foto_size<=$_REQUEST['lim_tamano']){
                   $nombre_foto=$nick.".".$extension;
                   $ruta=$lugar.$nombre_foto;
                    //Guardamos la foto en la carpeta del proyecto "fotos" con su nick Ejemplo: Ana.jpg
                   move_uploaded_file($foto_tmp_name, $ruta);
                   //Declaramos la ruta de la imagen en la base de datos
                  $rutaBD=$nombre_foto;
             }
           }else{//en caso de que el usuario no inserte imagen
             $rutaOrigen="../fotos/sinFotoBlue.png";
             $rutaFinal=$lugar.$nick.".png";
               copy($rutaOrigen, $rutaFinal);
             $rutaBD=$nick.".png";
          }
             return $rutaBD;
         }

   	        public function verCursos(){

   		   		$sql="SELECT * FROM".$this->tabla;
   		   		if($this->c->real_query($sql)){
   		   			if($resul=$this->c->store_result()){
   		   				if($resul->num_rows()>0){
   		   					$datos=array();
   		   					$mostrar=$resul->fetch_assoc();
   		   					foreach ($mostrar as $campo => $valor) {
   		   						$datos[$campo]=$valor;
   		   					}
   		   					$resul->free_result();
   		   					return $datos;
   		   				}else{
   		   					$resul->free_result();
 							echo "Esta tabla esta vacia, contacta con el Administrador de la página";
   		   				}
   		   			}
   		   		}else{
   		   			$this->c->errno." -> ".$this->c->error;
   		   		}
   		   }
   		   public function verCursosCreados($id_usuario){
                  //PRINT $id_usuario ;

   		   		$sql="SELECT * FROM ".$this->tabla." WHERE id_usuario='".$id_usuario."'";
   		   		if($this->c->real_query($sql)){
   		   			if($resul=$this->c->store_result()){
                          //print $resul->num_rows;
   		   				if($resul->num_rows>0){
   		   				/*	$datos=array();
   		   					$mostrar=$resul->fetch_assoc();
   		   					foreach ($mostrar as $campo => $valor) {
   		   						$datos[$campo]=$valor;
   		   					}*/
                            while($mostrar=$resul->fetch_assoc()){
                              print "<button value=".$mostrar["id_curso"]." name=".$mostrar["titulo"].">".$mostrar["titulo"]."</button>";
                           }
   		   					$resul->free_result();
   		   					return $datos;
   		   				}else{
   		   					$resul->free_result();
   		   					return "Todavia no has creado ningun curso.   ANIMATE";
   		   				}
   		   			}
   		   		}else{
   		   			echo $this->c->errno." -> ".$this->c->error;
   		   		}
   		   }

   		   public function verCursosInscritos($id_usuario){			//Falta Registrar Curso

                  PRINT "EXITO CURSOS";
   		   		$sql="SELECT A.* FROM ".$this->tabla." A, inscritos_curso B WHERE B.id_usuario='".$id_usuario."' AND B.id_curso=A.id_curso";
   		   		if($this->c->real_query($sql)){
   		   			if($resul=$this->c->store_result()){
                        print $resul->num_rows;
   		   				if($resul->num_rows>0){
   		   					//$datos=array();
   		   					//$mostrar=$resul->fetch_assoc();
   		   					/*foreach ($mostrar as $campo => $valor) {
   		   						$datos[$campo]=$valor;
   		   					}*/
                           while($mostrar=$resul->fetch_assoc()){
                              print $mostrar["titulo"];
                           }
   		   					$resul->free_result();
   		   					//return $datos;
   		   				}else{
   		   					$resul->free_result();
   		   					echo "Todavia no te has registrado en ningún curso.   ANIMATE";
   		   				}
   		   			}
   		   		}else{
   		   			echo $this->c->errno." -> ".$this->c->error;
   		   		}
   		   }

         public function esTutor($id_curso){

         }
         public function registrarCurso($id_usuario,$id_curso){
            $sql="SELECT * FROM inscritos_curso WHERE id_usuario='".$id_usuario."' AND id_curso='".$id_curso."'";
            if($this->c->real_query($sql)){
                   if($resul=$this->c->store_result()){
                     if($resul->num_rows==0){
                        $sql="INSERT INTO inscritos_curso (id_usuario,id_curso) VALUES('$id_usuario','$id_curso')";
                        if($this->c->real_query($sql)){
                            echo "<h3>Te has registrado con exito<h3>";
                        }else{
                              echo $this->c->errno." -> ".$this->c->error;
                        }
                     }else{
                        $resul->free_result();
                        echo "<h3>Ya te has registrado en este curso<h3>";
                     }
                   }
            }else{
                  echo $this->c->errno." -> ".$this->c->error;
            }
         }
         public function addArtic($id_curso,$title,$descrip,$active,$url,$img){
                if($this->existArtic($title)){
                  $foto=$this->guardarImgArticulo($id_curso,$title,$img);
                  $url=$this->guardarPdf($id_curso,$title,$url);
                  $date=date("Y-m-d");
                  $sql="INSERT INTO temas (id_curso,titulo,descripcion,fecha_creacion,activo,url,foto) VALUES(?,?,?,?,?,?,?)";
                  $sen=$this->c->prepare($sql);
                  $sen->bind_param("issssss",$id_curso,$title,$descrip,$date,$active,$url,$foto);
                  if($sen->execute()){
                     echo "<h2>Se ha añadido correctamente el articulo</h2>";
                  }else{
                     echo "<h1>No se pudo añadir correctamente el curso</h1>";
                     echo $sen->error;
                  }
                }else{
                   echo "<h1>error: Ya existe la base de datos<h1>";
                }
         }
         public function existArtic($title){
                  $sql="SELECT * FROM temas WHERE titulo='".$title."'";
                  if($this->c->real_query($sql)){
                     if($resul=$this->c->store_result()){
                        if($resul->num_rows==0){
                           return true;
                        }else{
                           return false;
                        }
                     }
                  }else{
                     return $this->c->errno." -> ".$this->c->error;
                  }
        }
         public function guardarImgArticulo($cur,$nick,$archivo_foto){
                   $curso=$this->nombreCurso($cur);
                   $foto_name = $archivo_foto['name'];
                   $foto_type=$archivo_foto['type'];
                  $foto_tmp_name=$archivo_foto['tmp_name'];
                  $foto_size=$archivo_foto['size'];
                  if($foto_type=="image/jpeg" || $foto_type=="image/pjpeg"){
                     $extension="jpg";
                }elseif ($foto_type=="image/png") {
                     $extension="png";
                }else{
                     $extension=NULL;
                }
               $ruta="NULL";
              $rutaBD="NULL";
             $lugar='../cursos/'.$curso.'/imagenes/';
            //Validamos la fotografía
           if($foto_name!=NULL AND $extension!=NULL AND $foto_size!=0){
               if($foto_size<=$_REQUEST['lim_tamano']){
                   $nombre_foto=$nick.".".$extension;
                   $ruta=$lugar.$nombre_foto;
                    //Guardamos la foto en la carpeta del proyecto "fotos" con su nick Ejemplo: Ana.jpg
                   move_uploaded_file($foto_tmp_name, $ruta);
                   //Declaramos la ruta de la imagen en la base de datos
                  $rutaBD=$nombre_foto;
             }
           }else{//en caso de que el usuario no inserte imagen
             $rutaOrigen="../fotos/sinFotoBlue.png";
             $rutaFinal=$lugar.$nick.".png";
               copy($rutaOrigen, $rutaFinal);
             $rutaBD=$nick.".png";
          }
             return $rutaBD;
         }
         public function guardarPdf($cur,$nick,$archivo_foto){
            $curso=$this->nombreCurso($cur);
            $pdf_name = $archivo_foto['name'];
            $pdf_type=$archivo_foto['type'];
            $pdf_tmp_name=$archivo_foto['tmp_name'];
             $lugar='../cursos/'.$curso."/";
            //Validamos la fotografía
                 if($pdf_type=="application/pdf"){
                     $extension="pdf";
                }
                   $nombre_pdf=$nick.".".$extension;
                   $ruta=$lugar.$nombre_pdf;
                    //Guardamos la foto en la carpeta del proyecto "fotos" con su nick Ejemplo: Ana.jpg
                   move_uploaded_file($pdf_tmp_name, $ruta);
                   //Declaramos la ruta de la imagen en la base de datos
                  $rutaBD=$nombre_pdf;

             return $rutaBD;
         }
         public function nombreCurso($id){
               $sql="SELECT titulo FROM ".$this->tabla." WHERE id_curso='".$id."'";
                  if($this->c->real_query($sql)){
                        if($resul=$this->c->store_result()){
                           $mostrar=$resul->fetch_assoc();
                           return $mostrar["titulo"];
                        }
                  }else{
                       echo $this->c->errno." -> ".$this->c->error;
                  }
         }

          // Autor: Samuel M. 14/02/2017  -  17/02/2017 //
          // Metodo bucarNombre //
          /*
              bucarNombre: es una funcion estatica que se usara en la pagina de busquedas,
              y que devuelve un array con el numero de resultados de la consulta como primer parametro
              y los resultados de la misma como segundo como $clave => $valor .
          */
          public static function bucarNombre($cadena){
              $c = Connection::dameInstancia();
              $conexion = $c->dameConexion();
              $consulta = "Select * from cursos where titulo like '%".$cadena."%' ;";
              $resultado = $conexion->query($consulta);
              if($resultado->num_rows != 0){
                  while($row = $resultado->fetch_assoc()){
                      $rows[] = $row ;
                  }
                  $datos =  array('numero' => $resultado->num_rows,'filas_consulta' => $rows );
                  return $datos ;
              } else {
                  return $datos = array('numero' => 0 ) ;
              }
          }
          // Metodo bucarNombre //
          // Metodo get_temas //
          public static function get_temas($id_curso){
              $c = Connection::dameInstancia();
              $conexion = $c->dameConexion();
              $consulta = "Select * from temas where id_curso=".$id_curso." ;" ;
              $resultado = $conexion->query($consulta);
              if($resultado->num_rows ==0 ){
                  return 0 ;
              } else {
                  while($row = $resultado->fetch_assoc()){
                      $rows[] = $row ;
                  }
                  return json_encode($rows) ;
              }
          }
          // Metodo get_temas //
          // Ultimos cursos Subidos //
          public static function utimos_temas_subidos(){
              $c = Connection::dameInstancia();
              $conexion = $c->dameConexion();
              $consulta = "Select * from cursos order by fecha_creacion desc limit 3 ;" ;
              $resultado = $conexion->query($consulta);
              if($resultado->num_rows ==0 ){
                  return 0 ;
              } else {
                  while($row = $resultado->fetch_assoc()){
                      $rows[] = $row ;
                  }
                  return $rows  ;
              }
          }
          // Ultimos cursos Subidos //
          /** Cursos mejor Valorados
							devuelve un array con los registros de los cursos
							con la puntuacion mas alta
					 */
           public static function cursos_mejor_valorados(){
              $c = Connection::dameInstancia();
              $conexion = $c->dameConexion();
              $consulta = "Select cursos.id_curso, cursos.id_usuario, cursos.titulo, cursos.descripcion, cursos.fecha_creacion, cursos.foto, avg(votos.voto) from cursos, votos, temas where votos.id_tema=temas.id_tema and temas.id_curso=cursos.id_curso and cursos.activo='si' group by temas.id_tema order by avg(votos.voto) limit 3" ;
              $resultado = $conexion->query($consulta);
              if($resultado->num_rows ==0 ){
                  return 0 ;
              } else {
                  while($row = $resultado->fetch_assoc()){
                      $rows[] = $row ;
                  }
                  return $rows  ;
              }
          } 
          // Cursos mejor valorados //
          // Valoracion de un tema //
          public static function valoracion_tema($id_tema){
              $c = Connection::dameInstancia();
              $conexion = $c->dameConexion();
              $consulta = "SELECT avg(voto) as voto  from votos, inscritos_curso where votos.id_usuario=inscritos_curso.id_usuario and id_tema=".$id_tema." group by id_tema ;" ;
              $resultado = $conexion->query($consulta);
              $row = $resultado->fetch_assoc();
              return $row['voto'] ;
          }
          // Valoracion de un tema //
          // Activar - desactivar Tema //
          public static function modificar_disponibilidad_tema($id_tema,$valor_actual){
              $c = Connection::dameInstancia();
              $conexion = $c->dameConexion();
              if($valor_actual==0){
                  $valor_actual = "no" ;
              } else {
                  $valor_actual = "si" ;
              }
              $consulta = "UPDATE temas set activo='".$valor_actual."' where id_tema=".$id_tema." ;" ;
              if($conexion->query($consulta)){
                  return 1 ;
              } else {
                  return 0 ;
              }
          }
          // Activar - desactivar Tema //
					// Devuelve un booleano dependiendo de si eres o no el elditor del curso//
					public static function soy_editor_de_este_curso($id_usuario,$id_curso)
					{
						$c = Connection::dameInstancia();
						$conexion = $c->dameConexion();
						$consulta = "SELECT * from cursos where id_curso =".$id_curso." and id_usuario=".$id_usuario.";" ;
						$resultado = $conexion->query($consulta);
						if($resultado->num_rows>0){
								return 'true' ;
						} else {
								return 'false' ;
						}
					}
					// Devuelve un booleano dependiendo de si eres o no el elditor del curso//
	}
?>
