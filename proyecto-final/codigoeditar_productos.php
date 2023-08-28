<?php
require "funciones/conecta.php";

$con = conecta();

$codigo = $_REQUEST['codigo'];

$id = $_REQUEST['id'];

$sql =  "SELECT codigo from productos where codigo = '$codigo' and eliminado = 0 and id <> '$id'";

$res = $con->query($sql);   
$row = $res->fetch_array();

$num_rows = mysqli_num_rows($con->query($sql));

if($num_rows > 0){     
    //Fue encontrado.
    echo 0;

}else{ //No fue encontrado
    echo 1;  //pasa la prueba
}
?>