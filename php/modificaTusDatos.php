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
           
           if(empty($_SESSION['datos']['apellidos'])){
           $apellidos=$_SESSION['datos']['apellidos'];
           }else{
           $apellidos="";
           }
           if($_SESSION['datos']['telefono']=='0'){
           $tfno="";
           }else{
           $tfno=$_SESSION['datos']['telefono'];
           }
        
        
               echo '<table>
                <tr><td class="dcha">Nick</td><td class="izda">'.$_SESSION['datos']['nick'].'</td></tr>
                <tr><td class="dcha">Nombre</td><td class="izda"><input type="text" name="nombre" size="9" value="'.$nombre.'"/></td></tr>
                <tr><td class="dcha">Apellidos</td><td class="izda"><input type="text" name="apellidos" size="9" value="'.$apellidos.'"/></td></tr>
                <tr><td class="dcha">@mail</td><td class="izda"><input type="text" name="apellidos" size="9" value="'.$_SESSION['datos']['mail'].'"/></td></tr>   
                <tr><td class="dcha">Fecha nacimiento(dd/mm/aa)</td><td class="izda"><input type="text" name="fecha_nac" size="9" value=""/></td></tr>
                <tr><td class="dcha">Cambia tu foto:<img src="'.$_SESSION['foto'].'" width="50px"/></td><td class="izda"><input type="file" name="foto"/><input type="hidden" name="lim_tamano" value="120000"/></td></tr>
                    <tr><td><h2>Datos que puedes cambiar</h2></td></tr>
                <tr><td class="dcha">Teléfono</td><td class="izda"><input type="text" name="tfno" size="9" value="'.$tfno.'"/></td></tr>
                      <tr><td><h2>¿Quieres cambiar la contraseña?</h2></td></tr>
                <tr><td class="dcha">Escriba nueva contraseña</td><td class="izda"><input type="password" name="passNueva" size="8"/><input type="hidden" name="pass" value="'.$_SESSION['datos']['pass'].'"/></td></tr>
                <tr><td class="dcha">Repita nueva contraseña</td><td class="izda"><input type="password" name="passRep" size="8"/></td></tr>
                <tr><td class="boton"><input type="submit" name="modificar" value="MODIFICAR DATOS"/></td><td class="boton"><input type="reset" value="Borrar"/></td></tr>	
		</table>'
        
 ?>       
    </form>
    
    
    
</div>
    </body>
</html>
