<?php
session_start();
session_destroy();
$_SESSION = array(); // Limpiar variables de sesión

header("location: login.php");
?>