<?php
session_start();
if(isset($_SESSION['idU'])){
$idU = $_SESSION['idU'];
$nombre = $_SESSION['nombre'];
}
else{
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header-container">
        <header>
            <nav>
                <a href="bienvenido.php">
                    <div class="navbutton">INICIO</div>
                </a>

                <a href="lista_administradores.php"><div class="navbutton">
                    ADMINISTRADORES

                </div></a>


                <a href="lista_productos.php"><div class="navbutton">
                    PRODUCTOS
                </div></a>

                <a href="lista_banners.php"><div class="navbutton">
                    BANNERS
                </div></a>

                <a href="lista_pedidos.php"><div class="navbutton">
                    PEDIDOS
                </div></a>

                <div class="navbutton">
                    <p class="bienvenido">Bienvenido <?php echo $nombre; ?></p>
                </div>
                <a href="salir.php"><div class="navbutton">
                    CERRAR SESION
                </div></a>

                
            </nav>
        </header>
    </div>


</body>

</html>