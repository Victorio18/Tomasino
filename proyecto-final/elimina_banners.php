<?php
    //elimina-productos.php

    require "funciones/conecta.php";

    $con = conecta();

    //Recibe Valores
    $id = $_REQUEST['id'];

    $sql = "UPDATE banners SET eliminado = 1 WHERE id = $id";

    $res = $con->query($sql);

    if(mysqli_affected_rows($con)> 0){ 
        echo 1;
    }else{
        echo 0;
    }


?>
