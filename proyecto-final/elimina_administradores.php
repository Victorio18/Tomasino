<?php
    //elimina-administradores.php

    require "funciones/conecta.php";

    $con = conecta();

    //Recibe Valores
    $id = $_REQUEST['id'];

    //$sql = "DELETE FROM administradores WHERE id = $id";

    $sql = "UPDATE administradores SET eliminado = 1 WHERE id = $id";

    $res = $con->query($sql);

    if(mysqli_affected_rows($con)> 0){ 
        echo 1;
    }else{
        echo 0;
    }

    // echo mysqli_affected_rows($con);

    //header("Location: lista_administradores.php");


?>
