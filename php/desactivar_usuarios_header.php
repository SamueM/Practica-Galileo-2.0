<?php
spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
require_once '../inc/funciones.php';
sesion();
//SEGURIDAD->Nos aseguramos que estamos en la sesión del administrador ó del super_admin (tipo2 ó tipo1)
if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario']))){
    $id_tipo_usuario_admin=$_SESSION['datos']['id_tipo_usuario'];
    //echo $id_tipo_usuario;
    /**
     * Un administrador puede activar ó desactivar usuarios de tipo 3(editor) ó
     * de tipo 4 (suscriptor). Pero no puede activar ó desactivar a otros administradores
     */
    if(isset($_REQUEST['enviarSolicitud'])){
        $num=0;
        $id_usuarios=$_REQUEST['solicitud'];
        //print_r($id_usuarios); 
        $usuario=new Usuario();        
        foreach ( $id_usuarios as $value) {
            $tipo_usuario=$usuario->tipoUsuario($value);
            if($id_tipo_usuario_admin==1 && ($tipo_usuario==2 || $tipo_usuario==3 || $tipo_usuario==4)){
             $usuario->cambiarInactivo($value);   
              $usuario=new Usuario();
            }
            else if($id_tipo_usuario_admin==2 && ($tipo_usuario==3 || $tipo_usuario==4)){
             $usuario->cambiarInactivo($value); 
              $usuario=new Usuario();
            }else{
                $num=-212;
            }
            }
            }
   
}
if (!headers_sent()) {
header('Location:index_administradores.php?pagina=3&num='.$num);  
exit;
}