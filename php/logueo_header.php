<?php
 spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
if(isset($_REQUEST['loguear'])){
    if(!empty($_REQUEST['nick']) AND !empty($_REQUEST['contrasena'])){
        $nick=$_REQUEST['nick'];
        $pass=$_REQUEST['contrasena'];
        $usuario=new Usuario();
        if($id_usuario=$usuario->esRegistrado($nick, $pass)){ //para loguearse, se comprueba que sea ususario activo
            require_once '../inc/funciones.php';
            sesion();
            $_SESSION['id_usuario']=$id_usuario;
            $_SESSION['datos']=$usuario->getUsuario($id_usuario);
            //print_r($_SESSION['datos']);
            $_SESSION['foto']=$usuario->getFotoUsuario($id_usuario);
            $id_tipo_usuario=$_SESSION['datos']['id_tipo_usuario'];
            //echo $id_tipo_usuario;
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
                    $destino="../index.php?num=$num";
                break;
            }

        }else{
             $num=-201;
             $destino="../index.php?num=$num";
        }

        }
}else{
     $num=-201;
     $destino="../index.php?num=$num";
}
if (!headers_sent()) {
  header('Location:'.$destino);
exit;
}
?>
