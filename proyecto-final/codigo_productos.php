<?php

require "funciones/conecta.php";

$con = conecta();

$codigo = $_REQUEST['codigo'];

$sql =  "SELECT codigo from productos where codigo = '$codigo' and eliminado = 0 and status = 1";

$res = mysqli_num_rows($con->query($sql));

if($res > 0){     
    echo 0;   //fue encontrado
}else{
    echo 1;  //no encontrado
}

?>