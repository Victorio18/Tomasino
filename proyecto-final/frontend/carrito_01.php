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
            <h1>Carrito 1/2</h1>
        </div>
        
        <table class="lista_pedidos">
            <tr>
                <td>Producto</td>
                <td>Costo</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
                <td>Eliminar</td>
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
                <td>$<span class="<?php echo $productosId?> costo"><?php echo $costo; ?></span></td>
                <td><span><a href="javascript:void(0);" onclick="editaCantidad(-1, <?php echo $productosId?>, <?php echo $id?>)">< </a></span><span class="<?php echo $productosId?> cantidad"><?php echo $cantidad;?></span><span><a href="javascript:void(0);" onclick="editaCantidad(1, <?php echo $productosId?>, <?php echo $id?>)">  ></a></span></td>
                <?php $subtotal = $costo * $cantidad;
                $total+=$subtotal;?>
                <td>$<span class="<?php echo $productosId?> subtotal"><?php echo $subtotal; ?></span></td>
                <td><a href="javascript:void(0);" onclick="eliminaProductos(<?php echo $productosId;?>, <?php echo $id?>, <?php echo $subtotal?>)">Eliminar</a></td>
            </tr>
            
        <?php }?>
            <tr>
                
                <td></td>
                <td></td>
                <td><span class="total">Total</span></td>
                <td><span class="total">$</span><span class="total valor"><?php echo $total;?></span></td>
                <td></td>
            </tr>
        </table>
        
    </div>
    <div class="regresarC">
        <a href="javascript: history.go(-1)">Regresar</a>
        <a href="carrito_02.php?id=<?php echo $id;?>">Continuar</a>
    </div>

    
</body>

<?php require "footer.php"?>
</html>

<script>
    function eliminaProductos(fila, id, subtotal){
            confirmar = confirm("Desea eliminar el id " + fila);
           var nfila = "#" + fila;
           var operacion = '-'+subtotal;
            if(confirmar == true){
                $.ajax({
                    url : 'elimina_carrito.php',
                    type : 'post',
                    dataType : 'text',
                    data : 'id=' + fila+'&pedido='+id,
                    // data : 'id=50',
                    success : function(res){
                        if (res == 1) {
                            $(nfila).hide();
                            var texto= $('.total.valor').text();
                            var nuevoTotal = texto + operacion;
                            var Total = eval(nuevoTotal);
                            $('.total.valor').text(Total);  
                        } else {
                            alert("Error en la eliminacion");
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
            }
        }

        function editaCantidad(boton, producto, id){
            var texto= $('.'+producto+'.cantidad').text();
            var subtotal = $('.'+producto+'.subtotal').text();
            var costo = $('.'+producto+'.costo').text();

            

            if(texto == 1 && boton == -1){
                console.log("-1");
            }else if(boton == 1){
                var operacion = '+1';
                var nuevaCantidad = texto + operacion;
                nuevaCantidad = eval(nuevaCantidad);
                $('.'+producto+'.cantidad').text(nuevaCantidad);

                var nuevoSubtotal = costo + '*' + nuevaCantidad;
                nuevoSubtotal = eval(nuevoSubtotal).toFixed(2);

                $('.'+producto+'.subtotal').text(nuevoSubtotal);

                editarEnBase(producto, nuevaCantidad, id);
                total(boton, costo);
                

            }else if(boton == -1){
                var operacion = '-1';
                var nuevaCantidad = texto + operacion;
                nuevaCantidad = eval(nuevaCantidad);
                $('.'+producto+'.cantidad').text(nuevaCantidad);

                var nuevoSubtotal = costo + '*' + nuevaCantidad;
                nuevoSubtotal = eval(nuevoSubtotal).toFixed(2);

                $('.'+producto+'.subtotal').text(nuevoSubtotal);

                editarEnBase(producto, nuevaCantidad, id);
                total(boton, costo);
                

            }

           
        }

        function total(boton, subtotal){
            var texto= $('.total.valor').text();
            // console.log(subtotal);
            if(boton == 1){
                var operacion = '+' + subtotal
                var nuevoTotal = texto + operacion;
                nuevoTotal = eval(nuevoTotal).toFixed(2);
                // console.log(nuevoTotal);
                $('.total.valor').text(nuevoTotal);

            }else{
                var operacion = '-' + subtotal
                var nuevoTotal = texto + operacion;
                nuevoTotal = eval(nuevoTotal).toFixed(2);
                // console.log(nuevoTotal);
                $('.total.valor').text(nuevoTotal);
            }
             
        }

        function editarEnBase(producto, cantidad, pedido){
            // console.log(producto +' '+cantidad+' '+pedido);
            // var cantidadtxt = cantidadtxt + cantidad;
            // console.log("recibido");
            $.ajax({
                    url : 'carrito_cantidad.php',
                    type : 'post',
                    dataType : 'text',
                    data : 'idProducto=' + producto +'&cantidad='+cantidad + '&pedido='+ pedido,
                    // data : 'pedido='+ pedido,
                    // data : 'id=50',
                    success : function(res){
                        if (res == 1) {
                            console.log("sepudo");  
                        } else {
                            console.log("nosepudo");
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
                
        }
</script>