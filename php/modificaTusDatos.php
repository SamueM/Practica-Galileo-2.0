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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Modifica tus datos</title>

      <!-- CSS -->
      <link rel="stylesheet" href="../css/main.css" />
      <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
      <link rel="stylesheet" href="../formulario/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="../formulario/css/form-elements.css">
      <link rel="stylesheet" href="../formulario/css/style.css">
      <link rel="shortcut icon" href="../formulario/ico/favicon.png">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../formulario/ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../formulario/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../formulario/ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="../formulario/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <body>
      <body>
        <div class="container">
          <div class="form-box">
            <div class="form-top">
              <div class="form-top-left">
                <h2>Modifica tus datos <?php echo $_SESSION['datos']['nick'];?></h2>
                <div id="errores">
                  <?php
                  if(isset($_REQUEST['error'])){
                      ?>
                        <h3>NO SE HAN PODIDO MODIFICAR LOS DATOS.</h3>
                        <p>Existen errores al rellenar los campos:</p>
                        <?php
                      $error=  urldecode($_REQUEST['error']);
                      $errores=  unserialize($error);
                      //print_r($errores);
                      foreach ($errores as $key => $value) {
                          echo "<p>".($key+1).".".validacionExisteUsuario($value)."</p>";
                      }
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="form-bottom">
            <form enctype="multipart/form-data" action="modificaTusDatos_header.php" method="POST" class="login-form">
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
             <div class="form-group">
               <label>Nombre</label>
                 <input type="text" name="nombre" value="<?php echo $nombre; ?>" required="required"//>
             </div>
             <div class="form-group">
               <label>Apellidos</label>
                 <input type="text" name="apellidos" value="<?php echo $apellidos; ?>" required="required"/>
             </div>
             <div class="form-group">
               <label>Email</label>
                 <input type="email" name="mail" value="<?php echo $_SESSION['datos']['mail']; ?>" required="required"/>
             </div>
             <div class="form-group">
               <label>Fecha de nacimiento (dd/mm/aaaa)</label>
                 <input type="text" name="fecha_nac" value="<?php echo $fecha_nac; ?>"/>
             </div>
             <div class="form-group">
               <label>Cambia tu foto: <img src="<?php echo $_SESSION['foto']; ?>" width="50px"/></label>
                 <input type="file" name="foto"><input type="hidden" name="lim_tamano" value="120000"/>
             </div>
             <div class="form-group">
               <label>Teléfono</label>
                 <input type="text" name="tfno" value="<?php echo $tfno; ?>"/>
             </div>
            <h3>¿Quieres cambiar la contraseña?</h3>
            <div class="form-group">
                <label>Escriba nueva contraseña</label>
                <input type="password" name="passNueva" size="8"/><input type="hidden" name="pass" value="<?php echo $_SESSION['datos']['pass']; ?>"/>
            </div>
            <div class="form-group">
                <label>Repita nueva contraseña</label>
                <input type="password" name="passRep" size="8"/>
            </div>
            <div class="botones">
            <button type="submit" name="modificar" class='btn'>Modificar datos</button>
            <button type="reset" class='btn'>Borrar</button>
            <?php
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
                   $destino="index.php";
               break;
           }
            ?>
            <button type="button" onclick=" location.href='<?php echo $destino;?>' " class="btn">Volver</button>
          </div>
        </form>
        </div>
        </div>

        </div>

    </body>
</html>
