<?php
require_once '../inc/funciones.php';
sesion();
if (!headers_sent()) {
header("Location:../index.php");
exit;
}
?>