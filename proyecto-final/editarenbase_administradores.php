<?php
// editarenbase_administradores
require "funciones/conecta.php";

$con = conecta();

//Recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$rol = $_REQUEST['rol'];
$pass = $_REQUEST['pass'];
$id = $_REQUEST['id'];

$passEnc = md5($pass);

$file_name = $_FILES['archivo']['name'];        //Nombre real del archivo
$file_tmp = $_FILES['archivo']['tmp_name'];    //Nombre temporal del archivo
$cadena    = explode(".", $file_name);          //Separa el nombre para obtener la extension
$ext       = $cadena[1];                        //Extension
$dir       = "archivos/";                       //Carpeta donde se guardan los archivos        
          


if($file_name != ''){
    $file_enc  = md5_file($file_tmp);    //Nombre del archivo encriptado
    $fileName1 = "$file_enc.$ext";
    copy($file_tmp, $dir.$fileName1);  //Nuevo nombre de mi archivo
}

if($pass == "" && $fileName1 == ""){
    $sql = "UPDATE administradores set nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol' where id = $id";
    $res = $con->query($sql);  
}else if($pass1 != "" && $fileName1 == ""){
    $passEnc = md5($pass);
    $sql = "UPDATE administradores set nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol', pass = '$passEnc' where id = $id";
    $res = $con->query($sql);   
}else if($pass1 == "" && $fileName1 != ""){
    $sql = "UPDATE administradores set nombre = '$nombre', apellidos = '$apellidos', rol = '$rol', archivo_n = '$fileName1', archivo = '$file_name'  where id = $id";
    $res = $con->query($sql);
}else{
    $passEnc = md5($pass);
    $sql = "UPDATE administradores set nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol', pass = '$passEnc', archivo_n = '$fileName1', archivo = '$file_name' where id = $id";
    $res = $con->query($sql); 
}



header("Location: lista_administradores.php");


?>