<?php
    require "menu.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta administradores</title>
    <link rel="stylesheet" href="style.css">
    
    <script src="js/jquery-3.3.1.min.js"></script>
    
</head>

<body>

    <div class="container">
        <form name="forma01" enctype="multipart/form-data">
        <h1>Alta de administradores</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="line">
                <!-- <label class="newline" for="apellidos">Apellidos</label> -->
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos">
            </div>
            <div class="line">
                <!-- <label class="newline" for="correo">Correo</label> -->
                <input type="email" name="correo" id="correo" placeholder="Correo">
                <span id="mensaje2"></span>
            </div>
        
            <div class="line">
                <!-- <label class="newline" for="contraseña">Contraseña</label> -->
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <div class="line">
                <!-- <label class="newline" for="rol">Rol</label> -->
                <select name="rol" id="rol">
                    <option value="0">Rol</option>
                    <option value="1">Gerente</option>
                    <option value="2">Ejecutivo</option>
                </select>
            </div>
            <div class="line">  
                <input type="file" name="archivo" id="archivo">
            </div>
            <div class="boton"><input type="submit" onclick="recibe(); return false;" value="Registrar"></div>
            <div id="mensaje1"></div>
        
        </form>
        <p><a href="lista_administradores.php">Regresar al listado</a></p>
    </div>

</body>    
</html>

<script>
    function recibe(){
        var nombre = $('#nombre').val();    
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var password = $('#pass').val();
        var rol = $('#rol').val();
        var archivo = $('#archivo').val();
        
        if(nombre == "" || apellidos == "" || correo == "" || password == "" || rol == 0 || archivo == ""){
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else{
            $.ajax({
                    url : 'correo_administradores.php',
                    type : 'post',
                    dataType : 'text',
                    data : 'correo=' + correo,
                    success : function(res){
                        if (res == 0) {
                            $('#mensaje2').html('El correo '+ correo +' ya existe');
                            setTimeout("$('#mensaje2').html('');", 5000);
                        }
                        else{
                            document.forma01.method = 'post';
                            document.forma01.action = 'salva_administradores.php';
                            document.forma01.submit();
                           // alert("paso la prueba");
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
        }
    }
    
</script>