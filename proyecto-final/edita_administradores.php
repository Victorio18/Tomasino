<?php
    require "menu.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de administradores</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<?php
//edita_administradores.php

require "funciones/conecta.php";

$con = conecta();

//Recibe valores 
$id = $_REQUEST['id'];

$sql = "SELECT * FROM administradores WHERE id = $id";

$res = $con->query($sql);
$row = $res->fetch_array();
$id_row = $row["id"];
$nombre = $row["nombre"];
$apellidos = $row["apellidos"];
$correo = $row["correo"];
$rol = $row["rol"];
$status = $row["status"];
$rolImpreso = ($rol == '1') ? 'Gerente' : 'Ejecutivo';
$statusImpreso = ($status == '1') ? 'Activo' : 'Inactivo';

?>


<body>
    <div class="container">

        <form name="forma01" class="form_edit" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $id_row; ?>">
            <h1>Edición de administradores</h1>
            <div class="line">
                <!-- <label class="newline" for="nombre">Nombre</label> -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="line">
                <!-- <label class="newline" for="apellidos">Apellidos</label> -->
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>">
            </div>
            <div class="line">
                <!-- <label class="newline" for="correo">Correo</label> -->
                <input type="email" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo; ?>">
                <span id="mensaje2"></span>
            </div>

            <div class="line">
                <!-- <label class="newline" for="contraseña">Contraseña</label> -->
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <div class="line">
                <!-- <label class="newline" for="rol">Rol</label> -->
                <select name="rol" id="rol">
                    <?php
                    $cargos = [
                        0 => 'Rol',
                        1 => 'Gerente',
                        2 => 'Ejecutivo'
                    ];
                    for ($i = 0; $i < 3; $i++) {
                        $selected = ($rol == $i) ? ' selected' : ' ';
                        echo '<option' . $selected . ' value=' . $i . '>' . $cargos[$i] . '</option>';
                    }
                    ?>
                    <?php
                    // if($rol == 1){
                    // echo '<option value="0">Rol</option>';
                    // echo '<option selected value="1">Gerente</option>';
                    // echo '<option value="2">Ejecutivo</option>';
                    // }
                    // else{
                    // echo '<option value="0">Rol</option>';
                    // echo '<option value="1">Gerente</option>';
                    // echo '<option selected value="2">Ejecutivo</option>';
                    // }

                    ?>
                </select>
            </div>
            <div class="line">
                <input type="file" name="archivo" id="archivo">
            </div>

            <div class="boton"><input class="boton_edit" type="submit" onclick="edita(); return false;" value="Editar"></div>
            <div id="mensaje1"></div>

        </form>
        <p><a href="lista_administradores.php">Regresar al listado</a></p>
    </div>
</body>

</html>

<script>
    $('#id').hide();

    function edita() {
        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var password = $('#pass').val();
        var rol = $('#rol').val();
        var archivo = $('#archivo').val();

        if (nombre == "" || apellidos == "" || correo == "" || rol == 0) {
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else {
            $.ajax({
                url: 'correoeditar_administradores.php',
                type: 'post',
                dataType: 'text',
                data: 'correo=' + correo + '&id=' + id,
                success: function(res) {
                    if (res == 0) {
                        $('#mensaje2').html('El correo ' + correo + ' ya existe');
                        setTimeout("$('#mensaje2').html('');", 5000);
                    } else {
                        document.forma01.method = 'post';
                        document.forma01.action = 'editarenbase_administradores.php';
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