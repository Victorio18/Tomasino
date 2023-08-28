<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/css-reset.css">
    <link rel="stylesheet" href="../style/style_front.css">
    <script src="https://kit.fontawesome.com/bce48df0a5.js" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<?php require "menu.php" ?>
<body>
    <div class="container">
    <form name="forma01" enctype="multipart/form-data">
        <h1>Contáctanos</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos">
            </div>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="correo" name="correo" placeholder="Correo">
            </div>
        
            <div class="line">
                <!-- <label class="newline" for="contraseña">Contraseña</label> -->
                <textarea name="comentarios" id="comentarios" cols="30" rows="10" placeholder="Comentarios..."></textarea>
            </div>
            <div class="boton"><input type="submit" onclick="recibe(); return false;" value="Enviar"></div>
            <div id="mensaje1"></div>
        
        </form>
    
    </div>
    
</body>
<?php
require "footer.php";
?>
</html>

<script>
    function recibe(){
        var nombre = $('#nombre').val();    
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var comentarios = $('#comentarios').val();
        
        if(nombre == "" || apellidos == "" || correo == "" || comentarios == ""){
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else{
            $('#mensaje1').html('Correo enviado');
            setTimeout("$('#mensaje1').html('');", 5000);

            document.forma01.method = 'post';
            document.forma01.action = 'enviarCorreo.php';
            document.forma01.submit();
        }
    }
</script>