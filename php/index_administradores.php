<?php
 spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
require_once '../inc/funciones.php';
sesion();
//nos aseguramos que pertenece al tipo 1, 2 de administradores
if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario'])==1 OR isset($_SESSION['datos']['id_tipo_usuario'])==2)){
$foto=$_SESSION['foto'];
            //echo $foto;
$nick=$_SESSION['datos']['nick'];
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina del Administrador</title>
    </head>
    <body>
        <h2><a href="cerrarSesion.php">Cerrar Sesion</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="modificaTusDatos.php"><img src="<?php echo $foto; ?>" width="50px"><?php echo $nick;?></a></h2>
        <p style="color:red">Pincha sobre la foto para modificar los datos!!</p>
        <?php
        $id_usuario=$_SESSION['id_usuario'];
        //echo $id_usuario;
        $usuario=new Usuario();
        //$valido=$usuario->solicitaEdicion(8);
        //echo $valido;
        $listado=$usuario->listarSolicitudesDeEdicion();
        //print_r($listado);
        if(count($listado)>0){
         ?>   
        <form id="form_solicitud" name="form_solicitud" action="aceptar_solicitud_header.php" method="POST">
        <?php
        foreach ($listado as $key => $value) {
            echo "<br><p>Datos del solicitante número ".($key+1)."</p>";
            foreach ($value as $key2 => $value2) {
                $id_usuario=$value['id_usuario'];
                if($key2=='solicita_edicion'){
                    echo $key2." -> ".$value2."<br>"; 
                   echo '<input type="checkbox" name="solicitud[]" value="'.$id_usuario.'">Autorizo crear Editor<br>';
                   
                }elseif ($key2=='foto') {
                    $foto=$usuario->getFotoUsuario($id_usuario);
                    echo $key2." -> ".$value2."<br>"; 
                    echo '<img src="'.$foto.'" width="50px">';
                }else{
                     echo $key2." -> ".$value2."<br>"; 
                }
                
            }
          
          }
          ?>
           <p><input type="submit" name="enviarSolicitud" value="Crear Editor(es)"/></p>	
          </form>
        <?php
        }else{
            echo "<p> No existen solicitudes de edicición </p>";
        }
        ?>
       
    </body>
</html>
