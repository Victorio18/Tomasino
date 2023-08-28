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
    <script src="https://kit.fontawesome.com/bce48df0a5.js" crossorigin="anonymous"></script>
</head>
<?php require "menu.php"; ?>

<body>
    <?php require "../funciones/conecta.php";
    $con = conecta();

    $id = $_REQUEST['id'];
    $sql = "SELECT * from productos where id = $id";
    $res = $con->query($sql);
    $row = $res->fetch_array();

    $imagen = $row["archivo_n"];
    $descripcion = $row["descripcion"];
    $nombre = $row["nombre"];
    $costo = $row["costo"];
    $codigo = $row["codigo"];
    $stock = $row["stock"];
    ?>
    <div class="container">
        <div class="container-detalle">
            <div class="imagenProducto">
                <img src="../archivos/<?php echo $imagen; ?>" alt="Producto">
            </div>
            <div class="descripcionProducto">
                <p><span class="banquete"> <?php echo $nombre; ?></span></p>
                <p><?php echo $descripcion; ?></p>
                <p><span class="color">Costo:</span> $<?php echo $costo; ?></p>
                <p><span class="color">Código:</span> <?php echo $codigo; ?></p>
                <p><span class="color">Stock:</span> <?php echo $stock; ?></p>
                <div class="compras">
                    <p class="buy"><a href="javascript:void(0);" onclick="agregar(<?php echo $id ?>);" class="<?php echo $id ?>">Agregar </a>
                        <input class="cantidad <?php echo $id;?>" type="number" name="cantidad" id="cantidad" min="1" max="5"></p>
                </div>
                <div class=<?php echo "\"$id\"" ?>>
                        <div class="aviso">Necesita iniciar sesión para comprar</div>
                    </div>
                    <div class=<?php echo "\"$id\"" ?>>
                        <div class="mensajeCantidad">Agregue un valor numérico</div>
                    </div>
                    <div class=<?php echo "\"$id\"" ?>>
                        <div class="agregado">Producto Agregado</div>
                    </div>
            </div>
        </div>
    </div>

    <div class="regresar">
        <a href="javascript: history.go(-1)">Regresar</a>
    </div>

    <div class="similares">
        <p>Otros productos similares</p>
    </div>

    <div class="container-productos">
            <?php
            $sql = "SELECT archivo_n, nombre, codigo, costo, id FROM productos where status = 1 and eliminado = 0 and id <> $id order by rand() limit 3";
            $res = $con->query($sql);

            while ($row = $res->fetch_array()) {
                $idP = $row["id"];
                $ProductoImg = $row["archivo_n"];
                $nombreP = $row["nombre"];
                $codigo = $row["codigo"];
                $costo = $row["costo"];

            ?>


                <div class="producto">
                    <div class="informacion"><img src=<?php echo "\"../archivos/$ProductoImg\""; ?> alt="Producto"></div>
                    <div class="codigo">
                        <p><a href="productos_detalle.php?id=<?php echo $idP; ?>"><?php echo "$nombreP"; ?></a></p>
                        <p>Código: <?php echo "$codigo"; ?></p>
                        <p>$<?php echo "$costo"; ?></p>
                    </div>
                    <div class="compras">
                        <p class="comprar"><a href="javascript:void(0);" onclick="agregar(<?php echo $idP ?>);" class="<?php echo $idP ?>">Agregar </a>
                        <input class="cantidad <?php echo $idP;?>" type="number" name="cantidad" id="cantidad" min="1" max="5"></p>
                    </div>
                    <div class=<?php echo "\"$idP\"" ?>>
                        <div class="aviso">Necesita iniciar sesión para comprar</div>
                    </div>
                    <div class=<?php echo "\"$idP\"" ?>>
                        <div class="mensajeCantidad">Agregue un valor numérico</div>
                    </div>
                    <div class=<?php echo "\"$idP\"" ?>>
                        <div class="agregado">Producto Agregado</div>
                    </div>

                </div>


            <?php } ?>
        </div>



</body>

<?php require "footer.php"; ?>

</html>

<script>
    $('.aviso').hide();
    $('.mensajeCantidad').hide();
    $('.agregado').hide();

    function agregar(numero) {
        <?php
        if (isset($idC)) {
        ?>
            var cantidad = $(".cantidad."+numero).val();
            // alert(numero+ " "+ cantidad);
            if(cantidad >0){
                // alert(cantidad);
                $.ajax({
                    url: 'salva_carrito01.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'id=' + numero + '&cantidad=' + cantidad,
                    success: function(res) {
                        $('.' +numero+ ' .agregado').show();
                        setTimeout(function(){$('.'+numero+' .agregado').hide();}, 2000);
                    },
                    error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });
            }else{
                // alert("agregue un valor");
                $('.' +numero+ ' .mensajeCantidad').show();
                setTimeout(function(){$('.'+numero+' .mensajeCantidad').hide();}, 2000);
            }
            // window.location.href = 'salvacarrito01.php?id='+numero+'&cantidad='+cantidad;
        <?php } else { ?>
            $('.' + numero + ' .aviso').show();
            setTimeout(function() {
                $('.' + numero + ' .aviso').hide()
            }, 2000);
        <?php } ?>


    }

    function menu(){
        $.ajax({
                    url: 'devuelveId.php',
                    type: 'post',
                    dataType: 'text',
                    success: function(res) {
                        if (res > 0) {
                            window.location.href = 'carrito_01.php?id='+res;
                        } else {
                            window.location.href = 'carrito_01.php?id='+res;
                        }
                    },
                    error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });
    }
</script>