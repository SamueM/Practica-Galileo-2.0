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
        $errores=array();
        $num=-304; //"El usuario se ha modificado correctamente."-> '../inc/defines.inc.php'
        /*
         * Un usuario no puede modificar su NICK (es único y lo identifica)
         */
        $id_usuario=$_SESSION['id_usuario'];
        $nick=$_SESSION['datos']['nick']; 
        /**
         * Si el usuario cambia el nombre ó el apellido, se comprueba si es válido, 
         * y de ser así, se devuelve con la primera letra en mayúsculas.
         * Es válido para nombres (ó apellidos) simples ó compuestos
         */  
       if(isset($_REQUEST['nombre'])){
           if(esNombreValido($_REQUEST['nombre'])){
               $nombre= ponerLetraEnMayuscula($_REQUEST['nombre']);//-> '../inc/validaciones.inc.php'
           }else{
               
               $num=-207;
               $errores[]=$num;
           }
       }else{
            $nombre=$_SESSION['datos']['nombre'];
       }

        if(isset($_REQUEST['apellidos'])){      
            if(esNombreValido($_REQUEST['apellidos'])){  
            $apellidos= ponerLetraEnMayuscula($_REQUEST['apellidos']);//-> '../inc/validaciones.inc.php'
            }else{
               $num=-208;   
               $errores[]=$num;
            }
       }else{
            $apellidos=$_SESSION['datos']['apellidos'];
       }
             
       if(!empty($_REQUEST['tfno'])){
           if(esTelefono($_REQUEST['tfno'])){
             $telefono=$_REQUEST['tfno'];
           }else{
               $num=-206;
               $errores[]=$num;
           }
       }else{    
           if($_REQUEST['tfno']==""){ 
               $telefono=NULL;
              
           }else{
                $telefono=$_SESSION['datos']['telefono'];
                  
           }                 
       }
     
       if(isset($_REQUEST['mail'])){
           if(esMailValido($_REQUEST['mail'])){
               if($_REQUEST['mail']!=$_SESSION['datos']['mail']){
               if($usuario->esmailRepetido($_REQUEST['mail'])){
                   $num=-204;
                   $errores[]=$num;
               }else{
                   $mail=$_REQUEST['mail'];
               }
               }else{
                   $mail=$_SESSION['datos']['mail'];
               }
           }else{
               $num=-209;
               $errores[]=$num;
           }
       }else{
           $mail=$_SESSION['datos']['mail'];
       }
      
       if(!empty($_REQUEST['fecha_nac'])){
            $fecha=$_REQUEST['fecha_nac'];
          if(esFechaNac($fecha)){
              $fecha_nac=  validarFechaNac($fecha);
          }else{
              $num=-205;
             $errores[]=$num;
          }
       }else{//que el campo esté vacío
           $fecha_nac="0000-00-00";
       }
     
       if(!empty($_REQUEST['passNueva']) && !empty($_REQUEST['passRep'])){
           //4 y 8 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula
          if(esContraseña($_REQUEST['passNueva'])){//-> '../inc/validaciones.inc.php'
            if(($_REQUEST['passNueva']) ==($_REQUEST['passRep'])){
                 $passNueva=$_REQUEST['passNueva'];
                 $pass=MD5($passNueva);
            }else{
                $num=-210;
                $errores[]=$num;
            }
           }else{
               $num=-305;
               $errores[]=$num;
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
    // echo $num;
       if($num==-304){//Los datos de modificación son correctos
            $usuario->modificardatos($nombre,$apellidos,$mail,$telefono,$pass,$fecha_nac,$id_usuario);
            if($_FILES['foto']['size']!=0){  
                 $usuario->modificarFoto($nick,$archivo_foto, $id_usuario);

            }
       //Actualizamos los datos, las sesiones
             $usuario=new Usuario();
             $_SESSION['datos']['nombre']= $nombre;
             $_SESSION['datos']['apellidos']=  $apellidos;
             $foto=$usuario->getFotoUsuario($id_usuario);
             $_SESSION['foto']=$foto;
             $passNuevo=$usuario->getPassUsuario($id_usuario);
             $_SESSION['datos']['pass']=$passNuevo;
             $_SESSION['datos']['mail']=$mail;
             $_SESSION['datos']['telefono']=$telefono;
             $_SESSION['datos']['fecha_nac']=$fecha_nac;
             //$mensaje=  validacionExisteUsuario($num);//'../inc/validaciones.inc.php';
             //print_r($mensaje);
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
        }else{
            //print_r($errores);
            $strError=  serialize($errores);
            $error=  urlencode($strError);
            $destino="modificaTusDatos.php?error=$error";
        }
     }
 
     
if (!headers_sent()) {
  header('Location:'.$destino);  
exit;
}         
     
 }
?>