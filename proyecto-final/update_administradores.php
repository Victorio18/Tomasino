<?php
//update_administradores.php
require "funciones/conecta.php";
$con = conecta();

//Recibe Variables

$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$passEnc = md5($pass);

$sql = "UPDATE administradores set nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', password = '$passEnc', rol = $rol where id = $id"





?>