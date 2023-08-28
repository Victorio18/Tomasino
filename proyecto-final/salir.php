<?php
session_start();
unset($_SESSION['idU']);
unset($_SESSION['nombre']);
unset($_SESSION['correo']);

// session_destroy();
header("Location: index.php");

?>