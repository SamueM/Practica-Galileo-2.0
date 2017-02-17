<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
sesion();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Práctica</title>
        <link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
        <link rel="stylesheet" href="../css/main.css" />
        <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
        <script src="jquery/jquery-3.1.1.min.js" ></script>
    </head>
    <body>
       
        <h2>
            <?php
           
            if($_SESSION['datos']['solicita_edicion']=='no'){
            echo '<a href="convierteteEnEditor_header.php">CONVIERTETE EN EDITOR</a>';
            } else{
                echo "SOLICITUD DE EDICION EN TRÁMITE";
            }
             $foto=$_SESSION['foto'];
            //echo $foto;
             $nick=$_SESSION['datos']['nick'];
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="modificaTusDatos.php"><img src="<?php echo $foto; ?>" width="50px"><?php echo $nick;?></a>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="cerrarSesion.php">Cerrar Sesion</a></h2>
        <p style="color:red">Pincha sobre la foto para modificar los datos!!</p>
        <h2>Esta es la página de un usuario que se ha logueado y es un suscriptor(alumno)</h2>
        <p>Los datos del suscriptor</p>
        <?php
        echo "Id del suscriptor: ".$_SESSION['id_usuario']."<br>";
        foreach ($_SESSION['datos'] as $key => $value) {
            /*
             * Vamos a imprimir la fecha de nacimiento en formato válido
             */
            if($key=='fecha_nac'){//del archivo '../inc/validaciones.inc.php'
                $fecha=getFechaNac($value);
                echo $key.": ".$fecha."<br>";
            }else{
                echo $key.": ".$value."<br>";
            }
        }
        $foto=$_SESSION['foto'];
        //echo $foto;
        echo '<img src="'.$foto.'" width="50px">';
         
        ?>
        
    </body>
</html>
