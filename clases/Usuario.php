<?php
 //passwword de prueba 1234
require_once 'Connection.php';
class Usuario{
    /* NOTAS:
     * No puede heber dos usuarios con nick iguales. El nick es UNIQUE
     * La foto será nick.jpg ó nick.png
     */
    private $c;
    private $tabla;
    public function __construct() {
        $bd=  Connection::dameInstancia();
        $this->c=$bd->dameConexion();
        $this->tabla="usuarios";
    }
    /**
     * Función que devuelve los datos de un usuario pasándole su id
     * @param type $id_usuario
     * @return $datos es un array con todos los datos de usuario (id,tipo,nombre,apellidos,...)
     * son todos los campos que se guardan para ese usuario en la base de datos
     */
    public function getUsuario($id_usuario){
        $datos=array();
         $sql="SELECT * FROM $this->tabla WHERE id_usuario=".$id_usuario;
         if($this->c->real_query($sql)){
             if($result=$this->c->store_result()){
                 if($result->num_rows==1){
                     $registro=$result->fetch_assoc();
                  foreach ($registro as $key => $value) {
                     $datos[$key]=$value;
                  }
                  $result->free_result();
                     return $datos;
                 }

             }
         }else{
            return $this->c->errno." -> ".$thsi->c->error;
         }
    }
    /**
     * Cuando un usuario se registra, la propia base de datos le asigna un id que es del tipo
     * AutoIncrement. Si la funcionalidad de la página está en que una vez registrado el usuario, éste
     * pueda acceder de forma automática como usuario registrado ó logueado, entonces necesitará
     * abrir una sesión para este usuario desde el momento en que se ha inscrito correctamente.
     * Sus datos los conocemos, pero no su id de usuario que de forma automática le ha asignado un número
     * el campo id_usuario de la base de datos.
     * Con este método vamos a conocer cuál es su id pasándole en nick
     * @param  $nick de usuario para que nos devuelva su nick
     *  @return el id del usuario
     */
     public function getIdusuario($nick){
        $sql="SELECT id_usuario from $this->tabla WHERE UPPER(nick)=UPPER('$nick')";
        $sentencia = $this->c->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_result($idUsuario);
        $registro=$sentencia->fetch();
        $sentencia->close();
        return $idUsuario;

    }
    /**
     * Método que devuelve un array que contiene todos los usuarios que están activos
     * @return los usuarios y sus datos
     */
    public function getUsuarios() {
        $datos=array();
        $i=0;
        $sql="SELECT * FROM $this->tabla WHERE activo='si' ORDER BY id_tipo_usuario ASC";
        if($this->c->real_query($sql)){
            if($result=  $this->c->store_result()){
                if($result->num_rows>0){
                   while($registro=$result->fetch_assoc()){
                       foreach ($registro as $key => $value) {
                            $datos[$i][$key]=$value;
                  }
                  $i++;
                            /*$id_tipo_usuario=$registro['id_tipo_usuario'];
                            $datos['id_tipo_usuario']=$id_tipo_usuario;
                            $nick=$registro['nick'];
                            $datos['nick']=$nick;
                            $nombre=$registro['nombre'];
                            $datos['nombre']=$nombre;
                            $apellidos=$registro['apellidos'];
                            $datos['apellidos']=$apellidos;
                            $mail=$registro['mail'];
                            $datos['mail']=$mail;
                            $pass=$registro['pass'];
                            $datos['pass']=$pass;
                            $activo=$registro['activo'];
                            $datos['activo']=$activo;
                            $solicita_edicion=$registro['solicita_edicion'];
                            $datos['solicita_edicion']=$solicita_edicion;
                            $foto=$registro['foto'];
                            $datos['foto']=$foto;*/
                   }

                }
                 $result->free_result();
                 return $datos;

            }
        }else{
            return "Error nº.".$this->c->errno;
        }
    }
     /**
     *
     */
     public function getUsuariosFiltro($activo,$todos) {
        $datos=array();
        $i=0;
        $sql="SELECT * FROM $this->tabla WHERE";
        if($activo){
            $sql.=" activo='si' ";
        }else{
            $sql.=" activo='no' ";
        }
        if($todos){//soy súper
           $sql.=" and id_tipo_usuario in (2,3,4) ";
        }else{//soy admin
            $sql.=" and id_tipo_usuario in (3,4) ";
        }
        $sql.=" ORDER BY id_tipo_usuario ASC";
        if($this->c->real_query($sql)){
            if($result=  $this->c->store_result()){
                if($result->num_rows>0){
                   while($registro=$result->fetch_assoc()){
                       foreach ($registro as $key => $value) {
                            $datos[$i][$key]=$value;
                  }
                  $i++;
                   }

                }
                 $result->free_result();
                 return $datos;
            }
        }else{
            return "Error nº.".$this->c->errno;
        }
    }
    /**
     * Método que guarda la foto del usuario en la carpeta del proyecto y devuelve la ruta de la imagen que se guarda en la base de datos
     * Si el usuario no inserta una imagen, se guardará por defecto la imagen "sinFotoBlue.png" con el nick del usuario
     * @return devuelve la ruta en la que se va a guardar la imagen en la base de datos
     */
    public function guardarFoto($nick,$archivo_foto){
        $foto_name = $archivo_foto['name'];
        $foto_type=$archivo_foto['type'];
        $foto_tmp_name=$archivo_foto['tmp_name'];
        $foto_size=$archivo_foto['size'];
        if($foto_type=="image/jpeg" || $foto_type=="image/pjpeg"){
            $extension="jpg";
        }elseif ($foto_type=="image/png") {
             $extension="png";
        }else{
            $extension=NULL;
        }
        $ruta="NULL";
        $rutaBD="NULL";
        $lugar='../fotos/';
        //Validamos la fotografía
        if($foto_name!=NULL AND $extension!=NULL AND $foto_size!=0){
            if($foto_size<=$_REQUEST['lim_tamano']){
                $nombre_foto=$nick.".".$extension;
                $ruta=$lugar.$nombre_foto;
                //Guardamos la foto en la carpeta del proyecto "fotos" con su nick Ejemplo: Ana.jpg
                move_uploaded_file($foto_tmp_name, $ruta);
                //Declaramos la ruta de la imagen en la base de datos
                $rutaBD=$nombre_foto;
            }
        }else{//en caso de que el usuario no inserte imagen
            $rutaOrigen=$lugar."sinFotoBlue.png";
            $rutaFinal=$lugar.$nick.".png";
            copy($rutaOrigen, $rutaFinal);
            $rutaBD=$nick.".png";
        }
         return $rutaBD;
    }
    /**
     * Método que se utiliza para comprobar si un usuario está registrado y poder loguearse
     * Es importante que el usuario esté activo
     * @param type $nick
     * @param type $pass
     * @return  true si está registrado y valor -1 si no lo está
     */
    public function esRegistrado($nick,$pass){
        $passMD5=md5($pass);
        $sql="SELECT * FROM $this->tabla WHERE UPPER(nick) = UPPER('$nick') and pass ='$passMD5' and activo='si'";
        if($this->c->real_query($sql)){
            if($result=@$this->c->store_result()){
                if($result->num_rows==1){
                    $registro = $result->fetch_assoc();
                   // print_r($registro);
                    return $registro['id_usuario'];
                }
             $result->free_result();
            }else{
                return -1;//no hay usuario registrado
            }
        }else{
             return $this->c->errno."->".$this->c->error;
        }
    }
    /**
     * Comprueba si el nick del usuario no existe para poder registrarlo como uno nuevo (grabar_registro_header.php)
     * El nick del usuario siempre va a ser de tipo UNIQUE
     * @param type $nick
     * @return boolean
     */
    public function existeUsuario($nick){
        $sql="SELECT nick FROM $this->tabla WHERE UPPER(nick)=UPPER('$nick')";
        if($this->c->real_query($sql)){
            if($result=$this->c->store_result()){
                if($result->num_rows==1){
                    /*$registro=$result->fetch_assoc();
                    print_r($registro);*/
                    $result->free_result();
                    return true;
                }else{
                    $result->free_result();
                    return false;
                }
            }
        }else{
            return "Error nº.".$this->c->errno;
        }

    }
    /** NO SE USA/////
     * Función que nos dice si un usuario es activo 'si' ó 'no'
     * @param type $nick pasamos el nick del usuario
     * @return boolean true si ese usuario es 'activo'.False en caso contrario
     */
    public function esActivo($nick){
        $sql="SELECT activo from $this->tabla WHERE UPPER(nick)=UPPER('$nick')";
        $sentencia = $this->c->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_result($activo);
        while ($registros=$sentencia->fetch()){
            if($activo=='si'){
                $sentencia->close();
                return true;
            }else{
                $sentencia->close();
                return false;
            }
            }

    }
    /**
     * Método que se utiliza para cambiar el estado de activo de un usuario a 'no activo'
     * @param type $id_usuario pasamos el id del usuario
     */
    public function cambiarInactivo($id_usuario){
        $sql="UPDATE $this->tabla SET `activo` = 'no' WHERE id_usuario=".$id_usuario;
         $sentencia = $this->c->prepare($sql);
         $sentencia->execute();
         $sentencia->close();
    }
    /**
     * Método que se utiliza para cambiar el estado de activo de un usuario a 'si activo'
     * @param type $id_usuario pasamos el id del usuario
     */
    public function cambiarActivo($id_usuario){
        $sql="UPDATE $this->tabla SET `activo` = 'si' WHERE id_usuario=".$id_usuario;
         $sentencia = $this->c->prepare($sql);
         $sentencia->execute();
         $sentencia->close();
    }
    /**
     * Método que nos devuelve el tipo de usuario a partir de su id
     * @param type $id
     * @return type el tipo de usuario(1,2,3 ó 4)
     */
    public function tipoUsuario($id_usuario){
         $sql="SELECT id_tipo_usuario from $this->tabla WHERE id_usuario=".$id_usuario;
        $sentencia = $this->c->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_result($id_tipo_usuario);
        $registros=$sentencia->fetch();
        $sentencia->close();
        return $id_tipo_usuario;


    }
    /**
     * Método que nos devuelve el nombre del tipo de usuario a partir de su id_tipo_usuario
     * Tenemos que buscar este dato en la tabla 'tipos_usuario'
     * @param type $id_tipo_usuario
     * @return type el tipo de usuario(super,admin,editor,suscriptor)
     */
     public function tipoNombreUsuario($id_tipo_usuario){
         $sql="SELECT nombre from tipos_usuario WHERE id_tipo_usuario=".$id_tipo_usuario;
        $sentencia = $this->c->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_result($nombre_usuario);
        $registros=$sentencia->fetch();
        $sentencia->close();
        return $nombre_usuario;


    }
    /*
     * Un usuario puede registrarse como alumno(Tipo 4) sin solicitar permisos de registro.
     * Pero un usuario que quiera registrarse como editor (Tipo3) necesitará permisos del administrador ó súper admin.
     */
    /* Método que introduce un usuario en la Base de datos:
     * A un usuario se le inserta por defecto del tipo 4 (alumno-suscriptor) en estado 'activo'.
     * Por defecto, al ser el campo Nick de tipo UNIQUE, phpMyadmin nunca insertará dos usuarios con el mismo Nick
     * Aún así, comprobamnos que ese nick no exista ya en la base de datos para que no se repita
     * @return $exito=-310->el usuario ha sido insertado correctamente y $exito!=-310-> no se inserta el nuevo usuario
     */
    public function insertarUsuario($nick,$nombre,$apellidos,$mail,$telefono,$pass,$fecha_nac,$solicita_edicion,$archivo_foto) {
        $foto=$this->guardarFoto($nick,$archivo_foto);
        $exito="";
        $tipo_usuario=4;
        $passMD5=  md5($pass);
        $activo="si";
         $sql="INSERT INTO $this->tabla (`id_tipo_usuario`, `nick`, `nombre`, `apellidos`, `mail`, `telefono`, `pass`, `fecha_nac`,`activo`, `solicita_edicion`, `foto`)"
                . " VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $sentencia=$this->c->prepare($sql);
        $sentencia->bind_param("issssisssss",$tipo_usuario,$nick,$nombre,$apellidos,$mail,$telefono,$passMD5,$fecha_nac,$activo,$solicita_edicion,$foto);
            if($sentencia->execute()){
            $exito=-301;
            }else{
            $exito=-303;
            //print  "<h2>¡¡ Error !! " . $this->c->errno."</h2>";
            }
         return $exito;

    }
    public function modificarFoto($nick,$archivo_foto,$id_usuario){
         $foto=$this->guardarFoto($nick,$archivo_foto);
         $sql_query = "UPDATE $this->tabla SET  "
                ."  foto = ?"
                ." WHERE id_usuario= ?";

 	$stmt =  $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
          }
	$stmt->bind_param('si',$foto,$id_usuario);
	$stmt->execute();
    }

    public function modificardatos($nombre,$apellidos,$mail,$telefono,$pass,$fecha_nac,$id_usuario){
           //UPDATE `cine_bd`.`usuarios` SET `direccion` = 'Palomas,3', `imagen` = 'Pedro.jpg' WHERE `usuarios`.`mi_uid` = 2;
        $sql_query = "UPDATE $this->tabla SET nombre= ? , apellidos= ? , mail= ? ,telefono = ? ,"
                ."  pass = ? , fecha_nac =? "
                ." WHERE id_usuario= ?";

 	$stmt =  $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
          }
	$stmt->bind_param('sssissi',$nombre,$apellidos,$mail,$telefono,$pass,$fecha_nac,$id_usuario);
	$stmt->execute();
     }
     /**
      * Método que se emplea para obtener la contraseña de un usuario
      * @param type $id
      * @return type
      */
     public function getPassUsuario($id){
         $sql="SELECT pass FROM $this->tabla WHERE id_usuario=$id";
         if($this->c->real_query($sql)){
            if($result=@$this->c->store_result()){
                if($result->num_rows==1){
                    $registro = $result->fetch_assoc();
                   // print_r($registro);
                    return $registro['pass'];

                }
             $result->free_result();
            }else{
                return -1;//no hay foto
            }
        }else{
             return $this->c->errno."->".$this->c->error;
        }
    }
    /**
     * Método al que le paso el id de un usuario y me devuelve la fotografía de un usuario, con la ruta incluida.
     * En caso de que no haya insertado ninguna, se mostrará una por defecto
     * @return la ruta completa de la fotografía
     */
    public function getFotoUsuario($id){
        $sql="SELECT foto FROM $this->tabla WHERE id_usuario=$id";
        if($this->c->real_query($sql)){
            if($result=$this->c->store_result()){
                if($result->num_rows==1){
                    $registro=$result->fetch_assoc();
                    if($registro['foto']!='NULL'){ //Si existe ruta de foto en la BBDD
                    $ruta_foto="../fotos/".$registro['foto'];
                      // echo $ruta_foto;
                    }else{//En caso de que no exista ruta de foto en la BBDD, que sea NULL
                       $ruta_foto="../fotos/sinFotoBlue.png";
                    }
                     $result->free_result();

                }else{//En caso de que no exista ruta de foto en la BBDD,qque sea NULL
                     $ruta_foto="../fotos/sinFotoBlue.png"; 
                        $result->free_result();

                }
                //echo "la ruta de la foto es ".$ruta_foto;
                return $ruta_foto;
            }

        }else{
            return "Error nº.".$this->c->errno;
        }
    }

    /**
     * Esta función comprueba que el mail que inserta el usuario no exite ya en la base de datos
     * @param type $mail le pasamos un string con el mail que inserta el usuario por formulario
     * @return boolean true si el mail ya existe en la base de datos. False, al contrario
     */
    public function esmailRepetido($mailNuevo){
        $existe=false;
        $sql="SELECT mail FROM $this->tabla";
        $sentencia = $this->c->prepare($sql);
        $sentencia->execute();
        $sentencia->execute();
        $sentencia->bind_result($mailBD);
         while ($registros=$sentencia->fetch()){
             if($mailBD==$mailNuevo){
                 $existe=true;
             }
            }
              $sentencia->close();
        if($existe){
            return true;
        } else{
            return false;
        }


    }


  /**
     * Método que lista todas las solicitudes de suscritos que quieren ser editores
     * Nos aseguramos que el tipo de suaurio es 4, es decir, suscriptor.
     * Lo hacemos por si hubiera alguna solicitud de edición 'si' en un editor que se hubiera quedado colgada
     * en la base de datos. **Es absurdo que un editor solicite editar**
     * @return datos array con todos los datos del suscriptor que pide la solicitud
     */
    public function listarSolicitudesDeEdicion(){
        $sql="SELECT * FROM usuarios WHERE id_tipo_usuario=4 AND solicita_edicion='si'";
        $datos=array();
        if($this->c->real_query($sql)){
            if($result=$this->c->store_result()){
                if($result->num_rows>0){
                    $i=0;
                   while($registro=$result->fetch_assoc()){
                       foreach ($registro as $key => $value) {
                          $datos[$i][$key]=$value;
                       }
                       $i++;

                   }
                   //print_r($datos);
                   $result->free_result();
                        return $datos;
                }else{
                    return $datos;
                }
            }
        }else{
            return "Error nº.".$this->c->errno;
        }
    }

    public function aceptaSolititudEdicion($id_usuario){
         $sql_query = "UPDATE $this->tabla SET id_tipo_usuario = ? ,"
                ."  solicita_edicion = ? "
                ." WHERE id_usuario= ?";

 	$stmt =  $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
          }
          $id_tipo_ususario=3;
          $solicita_edicion='no';

	$stmt->bind_param('isi',$id_tipo_ususario,$solicita_edicion,$id_usuario);
	$stmt->execute();
    }
    public function solicitaEdicion($id_usuario){
         $sql_query = "UPDATE $this->tabla SET "
                ."  solicita_edicion = ? "
                ." WHERE id_usuario= ?";

 	$stmt =  $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
          }
          $solicita_edicion='si';

	$stmt->bind_param('si',$solicita_edicion,$id_usuario);
	$stmt->execute();
    }
}
?>
