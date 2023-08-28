<?php
    //elimina-administradores.php

    require "../funciones/conecta.php";

    $con = conecta();

    //Recibe Valores
    $idProducto = $_REQUEST['id'];
    $idPedido = $_REQUEST['pedido'];

    //$sql = "DELETE FROM administradores WHERE id = $id";

    $sql = "DELETE FROM pedidos_productos  WHERE id_pedido = $idPedido and id_producto = $idProducto";

    $res = $con->query($sql);

    if(mysqli_affected_rows($con)> 0){ 
        echo 1;
    }else{
        echo 0;
    }

    // echo mysqli_affected_rows($con);

    //header("Location: lista_administradores.php");


?>
