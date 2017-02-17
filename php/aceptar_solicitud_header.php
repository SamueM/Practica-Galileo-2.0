<?php
spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
require_once '../inc/funciones.php';
sesion();
//SEGURIDAD->Nos aseguramos que estamos en la sesión del administrador ó del super_admin (tipo2 ó tipo1)
if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario']))){
    $id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
    //echo $id_tipo_usuario;
   if($id_tipo_usuario==1 OR $id_tipo_usuario==2){
if(isset($_REQUEST['enviarSolicitud'])){
    $id_usuarios=$_REQUEST['solicitud'];
    print_r($id_usuarios); 
    $usuario=new Usuario();        
    foreach ( $id_usuarios as $value) {
         $usuario->aceptaSolititudEdicion($value);   
        }
        }
   }
}
if (!headers_sent()) {
header('Location:index_administradores.php');  
exit;
}
?>