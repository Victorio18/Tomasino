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

<?php include "menu.php";?>
<body>
<div class="container">
    <form name="forma01" class="login">
            <h1>Iniciar Sesión</h1>
            <div class="line">
                <input type="text" id="user" name="user" placeholder="Nombre de usuario">
            </div>
    
            <div class="line">
                <input type="password" id="pass" name="pass" placeholder="Contraseña">
            </div>
    
            <div class="boton"><input type="submit" class="boton_login" onclick="login(); return false;" value="Iniciar sesión"></div>
            <div id="mensaje1"></div>
    
        </form>
</div>
</body>
<?php include "footer.php"?>
</html>

<script>
    function login(){
        var user = $('#user').val();
        var pass = $('#pass').val();
        if(user == "" || pass == ""){
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else{
            $.ajax({
                    url : 'validaCliente.php',
                    type : 'post',
                    dataType : 'text',  
                    data : 'user=' + user + '&pass=' + pass,
                    success : function(res){
                        if (res == 0) {
                            $('#mensaje1').html('No existe el usuario');
                            setTimeout("$('#mensaje1').html('');", 5000);
                        }
                        else{
                            window.location.href = 'productos.php';
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
        }
    }
</script>