<?php
    require "menu.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Pedidos</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class="container">
        <?php
        //detalle_banners.php
        require "funciones/conecta.php";
        $con = conecta();
        //Recibe Valores
        $id = $_REQUEST['id'];
        $sql = "SELECT productos.id, productos.nombre, pedidos_productos.cantidad, productos.costo FROM pedidos_productos, productos WHERE pedidos_productos.id_pedido = $id and id_producto = productos.id";
        $res = $con->query($sql);

        $total = 0;
        ?>
        
        <table class="lista_pedidos">
            <tr>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Costo Unitario</td>
                <td>Subtotal</td>
                </tr>
        
        <?php
        while($row = $res->fetch_array()){
            $nProducto = $row["nombre"];
            $cantidad = $row["cantidad"];
            $costo = $row["costo"];
            ?>
            <tr>
                <td><?php echo $nProducto; ?></td>
                <td><?php echo $cantidad; ?></td>
                <td><?php echo $costo; ?></td>
                <?php $subtotal = $costo * $cantidad;
                $total+=$subtotal;?>
                <td>$<?php echo $subtotal; ?></td>
            </tr>
            
        <?php }?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="total">$<?php echo $total;?></span></td>
            </tr>   
        </table>
        
        <a href="lista_pedidos.php">Regresar a la lista</a>
    </div>

</body>

</html>

