<?php
//salva_administradores.php
require "funciones/conecta.php";

$con = conecta();

//Recibe variables
$nombre = $_REQUEST['nombre'];
$archivo_n = '';
$archivo = '';

$file_name = $_FILES['archivo']['name'];        //Nombre real del archivo
$file_tmp = $_FILES['archivo']['tmp_name'];    //Nombre temporal del archivo
$cadena    = explode(".", $file_name);          //Separa el nombre para obtener la extension
$ext       = $cadena[1];                        //Extension
$dir       = "archivos/";                       //Carpeta donde se guardan los archivos        
$file_enc  = md5_file($file_tmp);              //Nombre del archivo encriptado


if($file_name != ''){
    $fileName1 = "$file_enc.$ext";
    copy($file_tmp, $dir.$fileName1);  //Nuevo nombre de mi archivo
}

    $sql = "INSERT INTO banners (nombre, archivo_n, archivo) VALUES ('$nombre', '$fileName1', '$file_name')";

    $res = $con->query($sql);

    header("Location: lista_banners.php");

?>