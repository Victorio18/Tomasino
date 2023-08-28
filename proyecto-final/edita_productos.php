<?php
    require "menu.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de productos</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<?php
//edita_productos.php

require "funciones/conecta.php";

$con = conecta();

//Recibe valores 
$id = $_REQUEST['id'];

$sql = "SELECT * FROM productos WHERE id = $id";

$res = $con->query($sql);
$row = $res->fetch_array();
$id_row = $row["id"];
$nombre = $row["nombre"];
$codigo = $row["codigo"];
$descripcion = $row["descripcion"];
$costo = $row["costo"];
$stock = $row["stock"];
$status = $row["status"];
$statusImpreso = ($status == '1') ? 'Activo' : 'Inactivo';

?>


<body>
    <div class="container">

        <form name="forma01" class="form_edit" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $id_row; ?>">
            <h1>Edición de Productos</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="line">
                <!-- <label class="newline" for="apellidos">Apellidos</label> -->
                <input type="text" id="codigo" name="codigo" placeholder="Codigo" value="<?php echo $codigo; ?>">
                <span id="mensaje2"></span>
            </div>
            <div class="line">
                <!-- <label class="newline" for="correo">Correo</label> -->
                <input type="number" step="0.01" min=0 name="costo" id="costo" placeholder="Costo" value="<?php echo $costo; ?>">
                
            </div>

            <div class="line">
                <!-- <label class="newline" for="contraseña">Contraseña</label> -->
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripción..."><?php echo $descripcion; ?></textarea>
            </div>
            <div class="line">
                <!-- <label class="newline" for="rol">Rol</label> -->
                <input type="number" name="stock" id="stock" placeholder="Stock" value="<?php echo $stock; ?>">
            </div>
            <div class="line">
                <input type="file" name="archivo" id="archivo">
            </div>

            <div class="boton"><input class="boton_edit" type="submit" onclick="edita(); return false;" value="Editar"></div>
            <div id="mensaje1"></div>

        </form>
        <p><a href="lista_productos.php">Regresar al listado</a></p>
    </div>
</body>

</html>

<script>
    $('#id').hide();

    function edita() {
        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var codigo = $('#codigo').val();
        var costo = $('#costo').val();
        var stock = $('#stock').val();
        var descripcion = $('#descripcion').val();
        var archivo = $('#archivo').val();

        if (nombre == "" || codigo == "" || costo == "" || stock == "" || descripcion == "") {
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else {
            $.ajax({
                url: 'codigoeditar_productos.php',
                type: 'post',
                dataType: 'text',
                data: 'codigo=' + codigo + '&id=' + id,
                success: function(res) {
                    if (res == 0) {
                        $('#mensaje2').html('El código ' + codigo + ' ya existe');
                        setTimeout("$('#mensaje2').html('');", 5000);
                    } else {
                        document.forma01.method = 'post';
                        document.forma01.action = 'editarenbase_productos.php';
                        document.forma01.submit();
                    }
                    // alert(res);
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        }
    }
</script>