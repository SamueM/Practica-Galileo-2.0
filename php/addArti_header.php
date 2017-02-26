<?php
	 include('../clases/Curso.php');
     //require_once '../inc/validacionesCurso.inc.php';
    $curso=new Curso();
            if(isset($_REQUEST['add'])){
                if(isset($_REQUEST['titleadd']) AND isset($_REQUEST['descriadd'])){
                        $img=$_FILES['imgArti'];
                        $pdf=$_FILES['pdf'];
                         //echo $foto_tmp_name=$archivo_foto['tmp_name'];
                         $title=$_REQUEST['titleadd'];
                         if(empty($_REQUEST['descriadd'])){
                             $descri="NULL";
                         }else{
                            $descri=$_REQUEST['descriadd'];
                      }
                    $men=$curso->addArtic($_REQUEST['curso'],$title,$descri,$_REQUEST['actArti'],$pdf,$img);
                    header('Location:CrearCursoArti.php?mensajeArti='.$men);
                }
            }
?>