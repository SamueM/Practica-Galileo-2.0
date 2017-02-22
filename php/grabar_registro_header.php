<?php
    spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
    require_once '../inc/funciones.php';
    require_once '../inc/validaciones.inc.php';
    $usuario = new Usuario();
    $strMensaje="";
    if(isset($_REQUEST['enviar'])){
    if(isset($_REQUEST['nick']) AND isset($_REQUEST['nombre']) AND isset($_REQUEST['pass']) AND isset($_REQUEST['mail'])){
        $archivo_foto=$_FILES['foto'];
        //echo $foto_tmp_name=$archivo_foto['tmp_name'];
        $nick=$_REQUEST['nick'];
        $nombre=$_REQUEST['nombre'];
        $pass=$_REQUEST['pass'];
        $email=$_REQUEST['mail'];
        if(empty($_REQUEST['ape'])){
            $apellidos="NULL";
        }else{
        $apellidos=$_REQUEST['ape'];
        }
        if(empty($_REQUEST['tfno'])){
           $telefono="NULL";
        }else{
          $telefono=$_REQUEST['tfno'];
        }
        if(empty($_REQUEST['fec_nac'])){
          $nacimiento="NULL";
        }else{
          $fecha=$_REQUEST['fec_nac'];
          $nacimiento=  validarFechaNac($fecha);//validado en '../inc/validaciones.inc.php'
        }
        $solicita_edicion=$_REQUEST['editor'];
        /* A la vez que se inserta un usuario en la base de datos, queremos que nos devuelva
         * un mensaje de validación, es decir, que es correcto,
         * como un mensaje de error si no se ha podido hacer la insercción.
         * Quiero coger los mensajes de error que vienen determinados en el archivo 'defines.inc.php'
         */
        //$num nos devuelve un número definido en el archivo 'defines.inc.php'
        $num=$usuario->insertarUsuario($nick, $nombre, $apellidos, $email, $telefono, $pass, $nacimiento,$solicita_edicion, $archivo_foto);
        //print_r($mensaje[$num]);
        $mensaje=validacionExisteUsuario($num);//'../inc/validaciones.inc.php'
        //echo $mensaje;
        $serMensaje= serialize($mensaje);
        $strMensaje= urlencode($serMensaje);

    }

}
if (!headers_sent()) {
header('Location:../index.php?nuevoUsuario='.$strMensaje);  
exit;
}
?>
