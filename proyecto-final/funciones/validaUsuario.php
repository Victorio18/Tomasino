<?php
session_start();
require "conecta.php";

$con = conecta();
$user = $_REQUEST['user']; 
$pass = $_REQUEST['pass'];
$pass = md5($pass);

$sql = "SELECT * FROM administradores WHERE correo = '$user' and pass = '$pass' and status = 1 and eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;

if($num){
    while($row = $res->fetch_array()){
        $idU  = $row["id"];
        $nombre = $row["nombre"].' '.$row["apellidos"];
        $correo = $row["correo"];
    
        $_SESSION['idU'] = $idU;
        $_SESSION['nombre'] = $nombre;  
        $_SESSION['correo'] = $correo;        
    }
       echo 1;
}
else{
    
    echo 0;
}


?>