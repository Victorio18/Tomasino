<?php
//salva_administradores.php
require "../funciones/conecta.php";

$con = conecta();

//Recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passEnc = md5($pass);

    $sql = "INSERT INTO clientes (nombre, apellidos, correo, password) VALUES ('$nombre', '$apellidos', '$correo', '$passEnc')";

    $res = $con->query($sql);

    header("Location: acceder.php");



?>