<?php
    require "menu.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de banners</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<?php
//edita_productos.php

require "funciones/conecta.php";

$con = conecta();

//Recibe valores 
$id = $_REQUEST['id'];

$sql = "SELECT * FROM banners WHERE id = $id";

$res = $con->query($sql);
$row = $res->fetch_array();
$id_row = $row["id"];
$nombre = $row["nombre"];

?>


<body>
    <div class="container">

        <form name="forma01" class="form_edit" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $id_row; ?>">
            <h1>Edición de Banners</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
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
        var archivo = $('#archivo').val();

        if (nombre == "") {
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else {
            document.forma01.method = 'post';
            document.forma01.action = 'editarenbase_banners.php';
            document.forma01.submit();
        }
    }
</script>