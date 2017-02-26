<?php
	 include('../clases/Curso.php');
     require_once '../inc/validacionesCurso.inc.php';
     require_once '../inc/funciones.php';
       sesion();
       if(isset($_REQUEST['addCur'])){
       			 $curso=new Curso();
                 //print $_REQUEST['title'];
                if(isset($_REQUEST['title']) AND isset($_REQUEST['descri'])){
                        $img=$_FILES['img'];
                         $title=$_REQUEST['title'];
                         if(empty($_REQUEST['descri'])){
                             $descri="NULL";
                         }else{
                            $descri=$_REQUEST['descri'];
                      }
                    $fecha=date("Y-m-d");
                    $id= $_SESSION['id_usuario'];
                  //  print $fecha;
                   //  $men=$curso->addCurso($id,$title,$descri,$fecha,$_REQUEST['editor'],$img);
                    $men=$curso->addCurso("9",$title,$descri,$fecha,$_REQUEST['actCur'],$img);
        			header('Location:CrearCursoArti.php?mensajeCurso='.$men);  
                }
            }
?>