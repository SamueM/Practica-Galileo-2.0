<?php
spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
//nos aseguramos que pertenece al tipo 1, 2 de administradores
if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['id_tipo_usuario'])==1 OR isset($_SESSION['datos']['id_tipo_usuario'])==2)){
$foto=$_SESSION['foto'];
            //echo $foto;
$nick=$_SESSION['datos']['nick'];

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
                <h2>LISTADO DE SOLICITUDES DE EDICIÓN DE NUESTROS LECTORES</h2>
                <table class="table table-hover tablas-administracion">
                    <tr><th>Foto</th><th>Id_Usuario</th><th>Nick</th><th>Nombre</th><th>Apellido(s)</th><th>Email</th><th>Teléfono</th><th>Autorizo Crear Editor</th></tr>
            <?php
            foreach ($listado as $key => $value) {
               // echo "<br><p>Datos del solicitante número ".($key+1)."</p>";
                $id_usuario=$value['id_usuario'];
                $foto=$usuario->getFotoUsuario($id_usuario);
                echo "<tr>";
                echo '<td><img src="'.$foto.'" width="50px"></td>'."<td>".$id_usuario."</td><td>".$value['nick']."</td><td>".$value['nombre']."</td><td>".$value['apellidos']."</td><td>".$value['mail']."</td><td>".$value['telefono']."</td>";
                foreach ($value as $key2 => $value2) {

                    if($key2=='solicita_edicion'){
                       //echo $key2." -> ".$value2."<br>";
                       echo '<td><input type="checkbox" name="solicitud[]" value="'.$id_usuario.'"></td>';
                    }

                }
                echo "</tr>";

              }

              ?>
                </table>
               <p><input type="submit" name="enviarSolicitud" value="Crear Editor(es)" class="boton rojo"/></p>
              </form>
            <?php
            }else{
                echo "<p> No existen solicitudes de edicición </p>";
            }
 }
?>
