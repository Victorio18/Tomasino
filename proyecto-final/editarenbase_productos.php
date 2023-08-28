<?php
// editarenbase_administradores
require "funciones/conecta.php";

$con = conecta();

//Recibe variables
$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$costo = $_REQUEST['costo'];
$descripcion = $_REQUEST['descripcion'];
$stock = $_REQUEST['stock'];
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

if($fileName1 == ""){
    $sql = "UPDATE productos set nombre = '$nombre', codigo = '$codigo', costo = '$costo', descripcion = '$descripcion', stock = '$stock' where id = $id";
    $res = $con->query($sql);  
}else if($fileName1 != ""){
    $sql = "UPDATE productos set nombre = '$nombre', codigo = '$codigo', costo = '$costo', descripcion = '$descripcion', archivo_n = '$fileName1', archivo = '$file_name' where id = $id";
    $res = $con->query($sql);
}



header("Location: lista_productos.php");


?>