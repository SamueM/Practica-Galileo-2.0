<?php
require_once '../inc/funciones.php';
sesion();
include_once ('../clases/Usuario.php');
$usuario=new Usuario();
require_once '../inc/validaciones.inc.php';
require_once '../inc/defines.inc.php';
//Seguridad: existe el usuario y está activo
 if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['activo'])=='si')){
     if(isset($_REQUEST['modificar'])){
         $num=-304; //"El usuario se ha modificado correctamente."-> '../inc/defines.inc.php'
        $id_usuario=$_SESSION['id_usuario'];
        $nick=$_SESSION['datos']['nick']; 
       if(isset($_REQUEST['nombre'])){
           $nombre=$_REQUEST['nombre'];
       }else{
            $nombre=$_SESSION['datos']['nombre'];
       }
        if(isset($_REQUEST['apellidos'])){
           $apellidos=$_REQUEST['apellidos'];
       }else{
            $apellidos=$_SESSION['datos']['apellidos'];
       }
       if(isset($_REQUEST['tfno'])){
           $telefono=$_REQUEST['tfno'];
       }else{
           $telefono=$_SESSION['datos']['telefono'];
       }

       if(isset($_REQUEST['mail'])){
           $mail=$_REQUEST['mail'];
       }else{
           $mail=$_SESSION['datos']['mail'];
       }
        
       $fecha_nac= $_SESSION['datos']['fecha_nac'];
       $nac="";
       if(!empty($_REQUEST['fecha_nac'])){
           $nac=$_REQUEST['fecha_nac'];
           if(esFechaNac($nac)){
               $fecha_nac=validarFechaNac($nac);
              // echo "valido";
           }else{
               $fecha_nac=$_SESSION['datos']['fecha_nac'];
              // echo "novalido";
           }
       }
     
       if(!empty($_REQUEST['passNueva']) && !empty($_REQUEST['passRep'])){
           if(($_REQUEST['passNueva']) ==($_REQUEST['passRep'])){
           $passNueva=$_REQUEST['passNueva'];
           $pass=MD5($passNueva);
           }else{
               $num=-305;
           }
       }else{
            $pass=$_SESSION['datos']['pass'];
       }
       $archivo_foto=$_FILES['foto'];
       if($_FILES['foto']['size']==0){
           //no cambiar la imagen
           $foto=$_SESSION['foto'];
       }else{
           $archivo_foto=$_FILES['foto'];
       }
      //echo $num;
       if($num==-304){//Los datos de modificación son correctos
            $usuario->modificardatos($nombre,$apellidos,$mail,$telefono,$pass,$fecha_nac,$id_usuario);
            if($_FILES['foto']['size']!=0){  
                 $usuario->modificarFoto($nick,$archivo_foto, $id_usuario);

            }
       //Actualizamos los datos, las sesiones
             $usuario=new Usuario();
             $foto=$usuario->getFotoUsuario($id_usuario);
             $_SESSION['foto']=$foto;
             $passNuevo=$usuario->getPassUsuario($id_usuario);
             $_SESSION['datos']['pass']=$passNuevo;
             $_SESSION['datos']['mail']=$mail;
             $_SESSION['datos']['telefono']=$telefono;
             $_SESSION['datos']['fecha_nac']=$fecha_nac;
             //echo "hola ".$_SESSION['datos']['fecha_nac'];
             $mensaje=  validacionExisteUsuario($num);//'../inc/validaciones.inc.php';
             //print_r($mensaje);
            
        }
     }
 $id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
         switch ($id_tipo_usuario){
                case 1:
                case 2:   
                    $destino="index_administradores.php";
                break;
                case 3:
                    $destino="index_editores.php";
                break;
                case 4:
                    $destino="index_suscriptores.php";
                break;
                default:
                    $num=-201;
                    $destino="iniciar_sesion.php?num=$num";
                break;
            }
     
if (!headers_sent()) {
  header('Location:'.$destino);  
exit;
}         
     
 }
?>