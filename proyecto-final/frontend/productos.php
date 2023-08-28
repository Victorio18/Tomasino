<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../style/css-reset.css">
    <link rel="stylesheet" href="../style/style_front.css">
    <script src="https://kit.fontawesome.com/bce48df0a5.js" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<?php require "menu.php"; ?>

<body>
    <div class="container">
        <div class="container-productos">
            <?php
            require "../funciones/conecta.php";
            $con = conecta();
            $sql = "SELECT archivo_n, nombre, codigo, costo, id FROM productos where status = 1 and eliminado = 0";
            $res = $con->query($sql);
            $con = 1;

            while ($row = $res->fetch_array()) {
                $idP = $row["id"];
                $ProductoImg = $row["archivo_n"];
                $nombreP = $row["nombre"];
                $codigo = $row["codigo"];
                $costo = $row["costo"];
            ?>

                <div class="producto" id=<?php echo "\"$con\"" ?>>
                    <!-- <a href="productos_detalle.php?id=<?php echo $idP; ?>"> -->
                    <div class="informacion"><img src=<?php echo "\"../archivos/$ProductoImg\""; ?> alt="Producto"></div>
                    <!-- </a> -->
                    <div class="codigo">
                        <p><a href="productos_detalle.php?id=<?php echo $idP; ?>"><?php echo "$con. $nombreP"; ?></a></p>
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

                <!-- <a href="javascript:void(0);" onclick="paginado($j, $ultimo);"> -->
            <?php $con++;
            } ?>
        </div>

        <div class="controles">
            <?php
            $ultimo = $con - 1;
            $pagina = $ultimo / 6;
            $puntos = " . . ";
            echo "<p> <</p>";
            for ($i = 0; $i < $pagina; $i++) {
                $j = $i + 1;
                if ($i >= $pagina - 1)
                    echo "<p><a href=\"javascript:void(0);\" onclick=\"paginado($j, $ultimo);\">$j </></a></p>";
                else
                    echo "<p><a href=\"javascript:void(0);\" onclick=\"paginado($j, 0);\">$j </></a></p>";
                if ($i >= 0 and $i < $pagina - 1) {
                    echo "<p>$puntos </p>";
                }
            }
            echo "<p> ></p>";
            ?>
        </div>



    </div>

</body>

<?php require "footer.php"; ?>

</html>

<p class="<?php echo $con; ?>" id="detect"></p>

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



    $("#detect").hide();

    paginado(1, 0);

    function esconder() {
        var ult = $('#detect').attr('class');
        ult -= 1;

        for (var i = 1; i <= ult; i++) {
            $('#' + i).hide();
        }
    }


    function paginado(numero, ultimo) {
        var limite = numero * 6;
        var inicio = limite - 5;
        if (ultimo == 0) {
            esconder();
            for (var i = inicio; i <= limite; i++) {
                $('#' + i).show();
            }
        } else {
            esconder();
            for (var i = inicio; i <= ultimo; i++) {
                $('#' + i).show();
            }
        }
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