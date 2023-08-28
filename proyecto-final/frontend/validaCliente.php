<?php
session_start();
require "../funciones/conecta.php";

$con = conecta();
$user = $_REQUEST['user']; 
$pass = $_REQUEST['pass'];
$pass = md5($pass);

$sql = "SELECT * FROM clientes WHERE correo = '$user' and password = '$pass' and status = 1 and eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;

if($num){
    while($row = $res->fetch_array()){
        $idC  = $row["id"];
        $nombreC = $row["nombre"];
        $correoC = $row["correo"];
    
        $_SESSION['idC'] = $idC;
        $_SESSION['nombreC'] = $nombreC;  
        $_SESSION['correoC'] = $correoC;        
    }
       echo 1;
}
else{
    
    echo 0;
}


?>