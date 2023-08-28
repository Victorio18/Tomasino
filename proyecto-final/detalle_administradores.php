<?php
    require "menu.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        //elimina-administradores.php
        require "funciones/conecta.php";
        $con = conecta();
        //Recibe Valores
        $id = $_REQUEST['id'];
        //$sql = "DELETE FROM administradores WHERE id = $id";
        $sql = "SELECT * FROM administradores WHERE id = $id";
        $res = $con->query($sql);
        
        while($row = $res->fetch_array()){
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $correo = $row["correo"];
            $rol = $row["rol"];
            $status = $row["status"];
            $archivo = $row["archivo_n"];
            $rolImpreso = ($rol == '1')? 'Gerente' : 'Ejecutivo';
            $statusImpreso = ($status == '1')? 'Activo' : 'Inactivo';
            echo "<div class=\"detalle\">";
            echo "<h1>Detalle administradores</h1>";
            echo "<div class=\"profile\">";
            echo "<img src=\"archivos/$archivo\" alt=\"foto\">";
            echo "</div>";
            echo "<div class=\"detalle-desc\">";
            echo "<div class=\"detalle-wrap\">";
            echo "<p>Nombre: </p>";
            echo "<p>$nombre</p>";
            echo "</div>";
            echo "<div class=\"detalle-wrap\">";
            echo "    <p>Apellido: </p>";
            echo "    <p>$apellidos</p>";
            echo "</div>";
            echo "<div class=\"detalle-wrap\">";
            echo "    <p>Correo: </p>";
            echo "    <p>$correo</p>";
            echo "</div>";
            echo "<div class=\"detalle-wrap\">";
            echo "    <p>Rol: </p>";
            echo "    <p>$rolImpreso</p>";
            echo "</div>";
            echo "<div class=\"detalle-wrap\">";
            echo "    <p>Status: </p>";
            echo "    <p>$statusImpreso</p>";
            echo "</div>";
            echo "</div>";
            echo "  </div>";
        }
        ?>
        <a href="lista_administradores.php">Regresar a la lista</a>
    </div>

</body>

</html>