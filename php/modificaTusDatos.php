<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
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
      <div id="misdatos">
          <h2>MODIFICA TUS DATOS</h2>
          <form enctype="multipart/form-data" action="modificaTusDatos_header.php" method="POST">
           <?php 
          
           $nombre=$_SESSION['datos']['nombre'];
           $apellidos=$_SESSION['datos']['apellidos'];
          
           if($_SESSION['datos']['telefono']=='0' || $_SESSION['datos']['telefono']==NULL || $_SESSION['datos']['telefono']==""){
           $tfno="";
           }else{
           $tfno=$_SESSION['datos']['telefono'];
           }
       
           $fecha_nac_BBDD=$_SESSION['datos']['fecha_nac'];//Nos da la fecha en formato de bbdd Ejemplo: 1980-06-10
           /* Necitamos mostrarla en formato de usuario dd/mm/aaaa
            * 
            */
           $fecha_nac=  getFechaNac($fecha_nac_BBDD);
           ?>
             <table>
                <tr><td>Nick</td><td><?php echo $_SESSION['datos']['nick'];?></td></tr>
                <tr><td>Nombre(mín 3 caracteres y máximo 20)</td><td><input type="text" name="nombre" size="9" value="<?php echo $nombre; ?>"/></td></tr>
                <tr><td>Apellidos(mín 3 caracteres y máximo 20)</td><td><input type="text" name="apellidos" size="9" value="<?php echo $apellidos; ?>"/></td></tr>
                <tr><td>@mail</td><td><input type="text" name="mail" size="9" value="<?php echo $_SESSION['datos']['mail']; ?>"/></td></tr>   
                <tr><td>Fecha nacimiento(dd/mm/aaaa)</td><td><input type="text" name="fecha_nac" size="9" value="<?php echo $fecha_nac; ?>"/></td></tr>
                <tr><td>Cambia tu foto:<img src="<?php echo $_SESSION['foto']; ?>" width="50px"/></td><td><input type="file" name="foto"/><input type="hidden" name="lim_tamano" value="120000"/></td></tr>
                    <tr><td><h2>Datos que puedes cambiar</h2></td></tr>
                <tr><td>Teléfono</td><td><input type="text" name="tfno" size="9" value="<?php echo $tfno; ?>"/></td></tr>
                      <tr><td><h2>¿Quieres cambiar la contraseña?</h2></td></tr>
                <tr><td>Escriba nueva contraseña</td><td><input type="password" name="passNueva" size="8"/><input type="hidden" name="pass" value="<?php echo $_SESSION['datos']['pass']; ?>"/></td></tr>
                <tr><td>Repita nueva contraseña</td><td><input type="password" name="passRep" size="8"/></td></tr>
                <tr><td class="boton"><input type="submit" name="modificar" value="MODIFICAR DATOS"/></td><td class="boton"><input type="reset" value="Borrar"/></td></tr>	
		</table>
        
      
    </form>
    
    <?php
    if(isset($_REQUEST['error'])){
        ?>
          <h2 style="color:red">NO SE HAN PODIDO MODIFICAR LOS DATOS.</h2>
          <p>Existen errores al rellenar los campos</p>
          <?php
        $error=  urldecode($_REQUEST['error']);
        $errores=  unserialize($error);
        //print_r($errores);
        foreach ($errores as $key => $value) {
            echo "<p>".($key+1).")".validacionExisteUsuario($value)."</p>";
        }
    }
    ?>
    
</div>
    </body>
</html>
