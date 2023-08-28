<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css-reset.css">
    <link rel="stylesheet" href="../style/style_front.css">
    <title>TOMASINO</title>
    <script src="https://kit.fontawesome.com/bce48df0a5.js" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<?php require "menu.php" ?>

<body>
    <div class="container">

        <?php require "../funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT archivo_n FROM banners where status = 1 and eliminado = 0 order by rand() limit 1";
        $res = $con->query($sql);
        $row = $res->fetch_array();
        $imagen = $row["archivo_n"];
        ?>
        <div class="banner">
            <img src=<?php echo "\"../archivos/$imagen\""; ?> alt="banner">
        </div>
        <div class="container-productos">
            <?php
            $sql = "SELECT archivo_n, nombre, codigo, costo, id FROM productos where status = 1 and eliminado = 0 order by rand() limit 6";
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
    </div>
</body>

<?php
require "footer.php";
?>

</html>

<script>
     $('.aviso').hide();
     $('.mensajeCantidad').hide();
     $('.agregado').hide();

    function agregar(numero){
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