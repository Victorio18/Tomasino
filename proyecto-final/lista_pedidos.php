<?php
    require "menu.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pedidos</title>
    <link rel="stylesheet" href="style.css">

    <script src="js/jquery-3.3.1.min.js"></script>

</head>

<body>

    <div class="container">
        <div class="tema">Lista de pedidos </div><br>
        
        <!-- <div class="tema"><a href="alta_banners.php">Crear nuevo Registro</a></div> -->
        <table class="lista">
            <tr>
                <td>ID</td>
                <td>Fecha</td>
                <td>Usuario</td>
                <td>IDU</td>
                <td>Detalle</td>
            </tr>
            <?php
            require "funciones/conecta.php";
            $con = conecta();
            $sql = "SELECT * FROM PEDIDOS WHERE STATUS = 1";
            $res = $con->query($sql);
            $cont = 1;
            while ($row = $res->fetch_array()) {
                $id      =  $row["id"];
                $fecha   =  $row["fecha"];
                $usuario =  $row["usuario_n"];
                $idUser  =  $row["id_usuario"];
                echo "<tr id = \"$id\">";
                echo "<td>";
                echo "$id";
                echo "</td>";
                echo "<td>";
                echo "$fecha";
                echo "</td>";
                echo "<td>";
                echo "$usuario";
                echo "</td>";
                echo "<td>";
                echo "$idUser";
                echo "</td>";
                echo "<td>";
                echo "<a href=\"detalle_pedidos.php?id=$id \">";
                echo "Ver detalle";
                echo "</a>";
                echo "</td>";
                echo "</tr>";
        
        
            }
            ?>
        </table>
    </div>
</body>

</html>