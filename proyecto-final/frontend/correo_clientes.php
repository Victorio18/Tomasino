<?php

require "../funciones/conecta.php";

$con = conecta();

$correo = $_REQUEST['correo'];

$sql =  "SELECT correo from clientes where correo = '$correo' and  eliminado = 0";

$res = mysqli_num_rows($con->query($sql));

if($res > 0){     
    echo 0;   //fue encontrado
}else{
    echo 1;  //no encontrado
}

?>