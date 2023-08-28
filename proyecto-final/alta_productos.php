<?php
    require "menu.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Productos</title>
    <link rel="stylesheet" href="style.css">
    
    <script src="js/jquery-3.3.1.min.js"></script>
    
</head>

<body>

    <div class="container">
        <form name="forma01" enctype="multipart/form-data">
        <h1>Alta de productos</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="line">
                <!-- <label class="newline" for="apellidos">Apellidos</label> -->
                <input type="text" id="codigo" name="codigo" placeholder="Código">
                <span id="mensaje2"></span>
            </div>
            <div class="line">
                <!-- <label class="newline" for="correo">Correo</label> -->
                <input type="number" step="0.01" min=0 name="costo" id="costo" placeholder="Costo">
                
            </div>
        
            <div class="line">
                <!-- <label class="newline" for="contraseña">Contraseña</label> -->
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripción..."></textarea>
            </div>
            <div class="line">
                <!-- <label class="newline" for="rol">Rol</label> -->
                <input type="number" name="stock" id="stock" placeholder="Stock">
            </div>
            <div class="line">
                <input type="file" name="archivo" id="archivo">
            </div>
            <div class="boton"><input type="submit" onclick="recibe(); return false;" value="Registrar"></div>
            <div id="mensaje1"></div>
        
        </form>
        <p><a href="lista_productos.php">Regresar al listado</a></p>
    </div>

</body>    
</html>

<script>
    function recibe(){
        var nombre = $('#nombre').val();    
        var codigo = $('#codigo').val();
        var costo = $('#costo').val();
        var descripcion = $('#descripcion').val();
        var stock = $('#stock').val();
        var archivo = $('#archivo').val();
        
        if(nombre == "" || codigo == "" || costo == "" || descripcion == "" || stock == "" || archivo == ""){
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else{
            $.ajax({
                    url : 'codigo_productos.php',
                    type : 'post',  
                    dataType : 'text',
                    data : 'codigo=' + codigo,
                    success : function(res){
                        if (res == 0) {
                            $('#mensaje2').html('El código '+ codigo +' ya existe');
                            setTimeout("$('#mensaje2').html('');", 5000);
                        }
                        else{
                            document.forma01.method = 'post';
                            document.forma01.action = 'salva_productos.php';
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