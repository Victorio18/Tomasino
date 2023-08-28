<?php
session_start();
unset($_SESSION['idC']);
unset($_SESSION['nombreC']);
unset($_SESSION['correoC']);
// session_destroy();
header("Location: index.php");

?>