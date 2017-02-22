<?php

    // Funciones AJAX //

    /*
        Autor: Samuel M. 13/02/2017
        Funcion: Almacenar las funciones AJAX y administrarlas segun las peticiones.
    */

    // Clases que incluir o //

        include_once("../clases/connection.php");
        include_once("../clases/curso.php");
        $c = Connection::dameInstancia();
        $conexionFA = $c->dameConexion();

    // Archivos que incluir //
    // Manejador de funciones //
    if(isset($_GET['codigoFuncion'])){

        switch ($_GET['codigoFuncion']) {
            // --- Votar: modificar o añadir una valoracion de un usuario a un tema. --- //
            case '1':
                $usuario = $_POST['usuario'] ;
                $tema = $_POST['tema'] ;
                $voto = $_POST['voto'] ;
                if(comprobarVoto($usuario,$tema,$conexionFA)) {
                   if(incluirVoto($usuario,$tema,$voto,$conexionFA)){
                       echo 1 ;
                   } else {
                       echo 0 ;
                   }
                } else {
                   if(actualizarVoto($usuario,$tema,$voto,$conexionFA)){
                       echo 1 ;
                   } else {
                       echo 0 ;
                   }
                }
            break;
            // --- Extraer todos los temas del curso X --- //
            case '2':
                $curso = $_POST['curso'] ;
                echo Curso::get_temas($curso) ;
            break;
            // --- Hacer funcion activar y desactivar tema --- //
            case '3':
                $tema = $_POST['tema'] ;
                $valor_actual = $_POST['valor_actual'] ;
                echo Curso::modificar_disponibilidad_tema($tema,$valor_actual) ;
            break;
            // --- Hacer funcion activar y desactivar tema --- //
            // --- Llamar a la funcion activar y desactivar curso --- //
            case '4':
                $id_usuario = $_POST['id_usuario'];
                $id_curso = $_POST['id_curso'];
                echo Curso::activar_desactivar_curso($id_usuario,$id_curso);
            break;
            // --- Llamar a la funcion activar y desactivar curso --- //
            // --- --- --- --- --- --- //
            default:
                return "{'error':'no se entro en ninguna funcion'}" ;
            break;
        }

    }
    // Manejador de funciones //
    // Funciones //

        // Comprueba si existe un voto de un usuario para un tema: 0->false , 1->true //
    function comprobarVoto($id_usuario,$id_tema,$conexion) {
        $consulta = "Select * from votos where id_usuario='".$id_usuario."' and id_tema='".$id_tema."' ;";
        $resultado = $conexion->query($consulta);
        if($resultado->num_rows == 0){
            return 1 ;
        } else {
            return 0 ;
        }
    }

        //  Inserta un nuevo voto: 0->false , 1->true  //
    function incluirVoto($id_usuario,$id_tema,$voto,$conexion){
        $fecha = date('Y-m-d');
        $consulta = "INSERT INTO `votos`(`id_usuario`, `id_tema`, `voto`, `fecha`) VALUES (".$id_usuario.",".$id_tema.",".$voto.",'".$fecha."') ;";
        if($conexion->query($consulta)){
            return 1 ;
        } else {
            return 0 ;
        }
    }

        // Actualiza un voto existente: 0->false , 1->true  //
    function actualizarVoto($id_usuario,$id_tema,$voto,$conexion){
        $fecha = date('Y-m-d');
        $consulta = "UPDATE votos set voto=".$voto." , fecha='".$fecha."' where id_usuario=".$id_usuario." and id_tema=".$id_tema." ;" ;
        if($conexion->query($consulta)){
            return 1 ;
        } else {
            return 0 ;
        }
    }

    // Funciones //


?>
