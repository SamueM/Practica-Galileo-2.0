<?php
    spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
    require_once '../inc/funciones.php';
    require_once '../inc/validaciones.inc.php';
    $usuario = new Usuario();
    $strMensaje="";
    if(isset($_REQUEST['enviar'])){
        $errores=array();
        $num=-301; //"El usuario se ha registrado correctamente."-> '../inc/defines.inc.php'
        if(isset($_REQUEST['nick']) AND isset($_REQUEST['nombre']) AND isset($_REQUEST['apellidos']) AND isset($_REQUEST['pass']) AND isset($_REQUEST['mail'])){       
                    /**
                     * Nick es Campo obligatorio
                     * Si cumple los criterios de validación (esNick())
                     * (tiene que tener de 4 a 8 caracteres, letras ó números)
                     * Debemos de comprobar si el usuario no está regsitrado previamente
                     */
                   if(esNick($_REQUEST['nick'])){
                       if(!$usuario->existeUsuario($_REQUEST['nick'])){
                         $nick=$_REQUEST['nick'];//-> '../inc/validaciones.inc.php'
                       }else{
                        $num=-300;
                       $errores[]=$num;
                       }
                   }else{
                       $num=-211;
                       $errores[]=$num;
                   }
                   //Campo obligatorio
                   if(esNombreValido($_REQUEST['nombre'])){
                       $nombre= ponerLetraEnMayuscula($_REQUEST['nombre']);//-> '../inc/validaciones.inc.php'
                   }else{
                       $num=-207;
                       $errores[]=$num;
                   }
                   //Campo obligatorio
                    if(esNombreValido($_REQUEST['apellidos'])){  
                    $apellidos= ponerLetraEnMayuscula($_REQUEST['apellidos']);//-> '../inc/validaciones.inc.php'
                    }else{
                       $num=-208;   
                       $errores[]=$num;
                    }
                    if(esMailValido($_REQUEST['mail'])){
                       if($usuario->esmailRepetido($_REQUEST['mail'])){
                           $num=-204;
                           $errores[]=$num;
                       }else{
                           $mail=$_REQUEST['mail'];
                       } 
                   }else{
                       $num=-209;
                       $errores[]=$num;
                   }
                   //Campo obligatorio
                   if(esContraseña($_REQUEST['pass'])){//-> '../inc/validaciones.inc.php'
                         $pass=$_REQUEST['pass'];
                        
                   }else{
                       $num=-305;
                       $errores[]=$num;
                   }
                    //El teléfono no es un campo obligatorio
                   if(!empty($_REQUEST['tfno'])){
                        if(esTelefono($_REQUEST['tfno'])){
                          $telefono=$_REQUEST['tfno'];
                        }else{
                            $num=-206;
                            $errores[]=$num;
                        }
                    }else{    
                       $telefono=NULL;                         
                     }

                if(!empty($_REQUEST['fecha_nac'])){
                    $fecha=$_REQUEST['fecha_nac'];
                  if(esFechaNac($fecha)){
                      $fecha_nac=  validarFechaNac($fecha);//validado en '../inc/validaciones.inc.php'
                  }else{
                      $num=-205;
                     $errores[]=$num;
                  }
                 }else{//que el campo esté vacío
                   $fecha_nac="0000-00-00";
                }
                /*if(empty($_REQUEST['fec_nac'])){
                  $nacimiento="NULL";
                }else{
                  $fecha=$_REQUEST['fec_nac'];
                  $nacimiento=  validarFechaNac($fecha);//validado en '../inc/validaciones.inc.php'
                }*/
                //El objeto Usuario presenta una función que valida y guarda la ruta de la foto
                 $archivo_foto=$_FILES['foto'];
                 /**
                  * El nuevo usuario que se regsitra puede solicitar desde el propio registro 
                  * su consición de lector ó pedir ser editor. Esta solicitud le llegará al administrador
                  * que desde su back-end decidirá si hacerle ó no editor.
                  */
                $solicita_edicion=$_REQUEST['editor'];
                /**
                 * Lo registramos como usuario activo. Este registro de usuario activado se inserta desde el propio
                 * objeto Usuario, en la función insertarUsuario($nick,$nombre,$apellidos,$mail,$telefono,$pass,$fecha_nac,$solicita_edicion,$archivo_foto),
                 * con la condición de que "si" es usuario activo.
                 * Si despues cambia su condición, será el adminitrador en su propia gestión el que pueda cambiarlo.
                 */
                
                /* A la vez que se inserta un usuario en la base de datos, queremos que nos devuelva
                 * un mensaje de validación, es decir, que es correcto,
                 * como un mensaje de error si no se ha podido hacer la insercción.
                 * Quiero coger los mensajes de error que vienen determinados en el archivo 'defines.inc.php'
                 * Este número nos dirá si el usuario se ha registrado ó no correctamente, ó si ya estaba registrado previamente.
                 */
                //$num nos devuelve un número definido en el archivo 'defines.inc.php'
                if($num==-301){
                $num=$usuario->insertarUsuario($nick, $nombre, $apellidos, $mail, $telefono, $pass, $fecha_nac,$solicita_edicion, $archivo_foto);
                $errores[]=$num;
                }
            }else{ //Error, campos obligatorios no rellenados
            $num=-303;
            $errores[]=$num;
            }
            if($num!=-301){
            $strError=  serialize($errores);
            $error=  urlencode($strError);
            $destino="registrate.php?error=$error";  
            }else{
             /**
             * El usuario se ha registrado correctamente. Le enviamos directamente a la página de suscriptores como usuario logueado
             */
                 $usuario=new Usuario();
                 require_once '../inc/funciones.php';
                 sesion();
                 $id_usuario=$usuario->getIdusuario($nick);
                 $_SESSION['datos']=$usuario->getUsuario($id_usuario);
                 $_SESSION['foto']=$usuario->getFotoUsuario($id_usuario);
                 $destino="index_suscriptores.php";  
            }
   

}
if (!headers_sent()) {
   header('Location:'.$destino);  
exit;
} 
?>