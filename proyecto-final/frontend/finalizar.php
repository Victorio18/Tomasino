<?php
    require "../funciones/conecta.php";

    $con = conecta();


    $idPedido = $_REQUEST['idPedido'];


    $sql = "UPDATE pedidos set status = 1 where id = $idPedido";

    $res = $con->query($sql);

    if(mysqli_affected_rows($con)> 0){ 
        echo 1;
    }else{
        echo 0;
    }



?>
