<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/css-reset.css">
    <link rel="stylesheet" href="../style/style_front.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<?php require "menu.php";?>
<body>
    <div class="container">
    <?php
        //detalle_banners.php
        require "../funciones/conecta.php";
        $con = conecta();
        //Recibe Valores
        $id = $_REQUEST['id'];
        $sql = "SELECT productos.id, productos.nombre, pedidos_productos.cantidad, productos.costo FROM pedidos_productos, productos WHERE pedidos_productos.id_pedido = $id and id_producto = productos.id";
        $res = $con->query($sql);

        $total = 0;
        ?>

        <div class="titulo_P">
            <h1>Carrito 2/2</h1>
        </div>
        
        <table class="lista_pedidos">
            <tr>
                <td>Producto</td>
                <td>Costo</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
                </tr>
        
        <?php
        while($row = $res->fetch_array()){
            $nProducto = $row["nombre"];
            $cantidad = $row["cantidad"];
            $costo = $row["costo"];
            $productosId = $row["id"]
            ?>
            <tr id="<?php echo $productosId;?>">
                <td><?php echo $nProducto; ?></td>
                <td>$<?php echo $costo; ?></td>
                <td><?php echo $cantidad;?></td>
                <?php $subtotal = $costo * $cantidad;
                $total+=$subtotal;?>
                <td>$<?php echo $subtotal; ?></td>
            </tr>
            
        <?php }?>
            <tr>
                
                <td></td>
                <td></td>
                <td><span class="total">Total</span></td>
                <td><span class="total">$</span><span class="total valor"><?php echo $total;?></span></td>
                
            </tr>
        </table>

        <div id="mensaje1">Pedido Finalizado</div>
        
    </div>
    <div class="regresarC">
        <a href="javascript: history.go(-1)">Regresar</a>
        <a href="javascript:void(0);" onclick="finalizar(<?php echo $id?>)">Finalizar</a>
    </div>
    </div>
</body>
<?php require "footer.php"?>
</html>


<script>
    $('#mensaje1').hide();
    function finalizar(idPedido){
        $.ajax({
                    url : 'finalizar.php',
                    type : 'post',
                    dataType : 'text',
                    data : 'idPedido=' + idPedido,
                    // data : 'pedido='+ pedido,
                    // data : 'id=50',
                    success : function(res){
                        if (res == 1) {
                            // console.log("sepudo");
                            $('#mensaje1').show();
                            
                            setTimeout(function(){window.location.href = "index.php";}, 5000);
                            
                        } else {
                            console.log("nosepudo");
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
    }
</script>