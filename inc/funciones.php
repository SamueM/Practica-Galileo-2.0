<?php function sesion() {
        session_cache_limiter('nocache');
        session_name('misCursos');
        session_start();
    }
?>
