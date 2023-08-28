<?php
    require "menu.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Banners</title>
    <link rel="stylesheet" href="style.css">
    
    <script src="js/jquery-3.3.1.min.js"></script>
    
</head>

<body>

    <div class="container">
        <form name="forma01" enctype="multipart/form-data">
        <h1>Alta de banners</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="line">
                <input type="file" name="archivo" id="archivo">
            </div>
            <div class="boton"><input type="submit" onclick="recibe(); return false;" value="Registrar"></div>
            <div id="mensaje1"></div>
        
        </form>
        <p><a href="lista_banners.php">Regresar al listado</a></p>
    </div>

</body>    
</html>

<script>
    function recibe(){
        var nombre = $('#nombre').val();    
        var archivo = $('#archivo').val();
        
        if(nombre == "" || archivo == ""){
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else{
            document.forma01.method = 'post';
            document.forma01.action = 'salva_banners.php';
            document.forma01.submit();
        }
    }
    
</script>