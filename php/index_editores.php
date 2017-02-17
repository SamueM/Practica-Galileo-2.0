<?php
require_once '../inc/funciones.php';
sesion();
//nos aseguramos que pertenece al tio 3 de editores
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
        <title></title>
    </head>
    <body>
        <h2>Página de editores</h2>
        <p>En esta página los editores pueden crear Cursos/Módulos y subir sus temas</p>
         <h2><a href="cerrarSesion.php">Cerrar Sesion</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="modificaTusDatos.php"><img src="<?php echo $foto; ?>" width="50px"><?php echo $nick;?></a></h2>
        <p style="color:red">Pincha sobre la foto para modificar los datos!!</p>
        <?php
        // put your code here
        ?>
 
    </body>
    
</html>
