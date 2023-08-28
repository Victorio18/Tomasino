<?php 
session_start();
if(isset($_SESSION['idC'])){
    $idC = $_SESSION['idC'];
    $nombre = $_SESSION['nombreC'];
    }
require "../funciones/conecta.php";
$con = conecta();

    $sql = "SELECT id from pedidos where id_usuario = $idC and status = 0";  
    
    $res = $con->query($sql);
    $filas = mysqli_num_rows($con->query($sql));

    if ($filas > 0) {
        $row = $res->fetch_array();
        $idPedido = $row["id"];
    }else{
        $idPedido = 0;
    }

    echo $idPedido;

?>