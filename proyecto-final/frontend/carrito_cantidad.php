<?php


    require "../funciones/conecta.php";

    $con = conecta();

    //Recibe Valores
    $idProducto = $_REQUEST['idProducto'];
    $idPedido = $_REQUEST['pedido'];
    $cantidad = $_REQUEST['cantidad'];

    

    $sql = "UPDATE pedidos_productos SET cantidad = $cantidad WHERE id_pedido = $idPedido and id_producto = $idProducto";

    $res = $con->query($sql);

    if(mysqli_affected_rows($con)> 0){ 
        echo 1;
    }else{
        echo 0;
    }




?>
