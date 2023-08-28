<?php
    require "menu.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Banners</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        //detalle_banners.php
        require "funciones/conecta.php";
        $con = conecta();
        //Recibe Valores
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM banners WHERE id = $id";
        $res = $con->query($sql);
        
        while($row = $res->fetch_array()){
            $nombre = $row["nombre"];
            $status = $row["status"];
            $archivo = $row["archivo_n"];
            echo "<div class=\"detalle\">";
            echo "<h1>Detalle Banners</h1>";
            echo "<div class=\"profile\">";
            echo "<img src=\"archivos/$archivo\" alt=\"foto\">";
            echo "</div>";
            echo "<div class=\"detalle-desc\">";
            echo "<div class=\"detalle-wrap\">";
            echo "<p>Nombre: </p>";
            echo "<p>$nombre</p>";
            echo "</div>";
            echo "</div>";
            echo "  </div>";
        }
        ?>
        <a href="lista_banners.php">Regresar a la lista</a>
    </div>

</body>

</html>