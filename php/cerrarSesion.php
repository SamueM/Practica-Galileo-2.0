<?php
require_once '../inc/funciones.php';
sesion();
session_destroy();
if (!headers_sent()) {
header("Location:../index.php");
exit;
}
?>
