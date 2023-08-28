<?php
$file_name = $_FILES['archivo']['name'];        //Nombre real del archivo
$file_tmp = $_FILES['archivo']['tmp_name'];    //Nombre temporal del archivo
$cadena    = explode(".", $file_name);          //Separa el nombre para obtener la extension
$ext       = $cadena[1];                        //Extension
$dir       = "archivos/";                       //Carpeta donde se guardan los archivos        
$file_enc  = md5_file($file_tmp);              //Nombre del archivo encriptado

echo "file name: $file_name <br>";
echo "file_tmp: $file_tmp <br>";
echo "ext: $ext <br>";
echo "file_enc: $file_enc <br>";

if($file_name != ''){
    $fileName1 = "$file_enc.$ext";
    copy($file_tmp, $dir.$fileName1);  //Nuevo nombre de mi archivo
}

?>