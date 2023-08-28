<?php
require "funciones/conecta.php";

$con = conecta();

$correo = $_REQUEST['correo'];

$id = $_REQUEST['id'];

$sql =  "SELECT correo from administradores where correo = '$correo' and eliminado = 0 and id <> '$id'";

$res = $con->query($sql);   
$row = $res->fetch_array();

// $id_row = $row['id'];

$num_rows = mysqli_num_rows($con->query($sql));

// echo $id;

if($num_rows > 0){     
    //Fue encontrado.
    echo 0;

}else{ //No fue encontrado
    echo 1;  //pasa la prueba
}
?>