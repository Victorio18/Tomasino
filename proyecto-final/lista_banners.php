<?php
    require "menu.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Banners</title>
    <link rel="stylesheet" href="style.css">

    <script src="js/jquery-3.3.1.min.js"></script>

    <script>
        function eliminaFilas(fila){
            confirmar = confirm("Desea eliminar el id " + fila);
           var nfila = "#" + fila;
            if(confirmar == true){
                $.ajax({
                    url : 'elimina_banners.php',
                    type : 'post',
                    dataType : 'text',
                    data : 'id=' + fila,
                    // data : 'id=50',
                    success : function(res){
                        if (res == 1) {
                            $(nfila).hide();
                        } else {
                            alert("Error en la eliminacion");
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
            }
        }

    </script>

</head>

<body>

    <div class="container">
        <div class="tema">Lista de banners</div>
        <div class="tema"><a href="alta_banners.php">Crear nuevo Registro</a></div>
        <table class="lista">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Eliminar</td>
                <td>Detalle</td>
                <td>Editar</td>
            </tr>
            <?php
            require "funciones/conecta.php";
            $con = conecta();
            $sql = "SELECT * FROM BANNERS WHERE STATUS = 1 AND ELIMINADO = 0";
            $res = $con->query($sql);
            $cont = 1;
            while ($row = $res->fetch_array()) {
                $id =        $row["id"];
                $nombre =    $row["nombre"];
                echo "<tr id = \"$id\">";
                echo "<td>";
                echo "$id";
                echo "</td>";
                echo "<td>";
                echo "$nombre";
                echo "</td>";
                echo "<td>";
                echo "<a href=\"javascript:void(0);\" onclick=\"eliminaFilas($id);\">";
                echo " Eliminar";
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href=\"detalle_banners.php?id=$id \">";
                echo "Ver detalle";
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href=\"edita_banners.php?id=$id\">";
                echo "Editar";
                echo "</a>";
                echo "</td>";
                echo "</tr>";
        
        
            }
            ?>
        </table>
    </div>
</body>

</html> 