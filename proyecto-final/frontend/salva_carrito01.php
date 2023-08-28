<?php 
session_start();
if(isset($_SESSION['idC'])){
    $idC = $_SESSION['idC'];
    $nombre = $_SESSION['nombreC'];
    }
require "../funciones/conecta.php";
$con = conecta();

//Recibe variables
$idProducto = $_REQUEST['id'];
$cantidad = $_REQUEST['cantidad'];

// echo $cantidad;
    
    $sql = "SELECT id from pedidos where id_usuario = $idC and status = 0";  
    
    $res = $con->query($sql);
    $filas = mysqli_num_rows($con->query($sql));

// echo $filas;
if ($filas > 0) {
    $row = $res->fetch_array();
    $idPedido = $row["id"];
    $sql = "select id_producto, sum(cantidad) from pedidos_productos, productos where pedidos_productos.id_pedido = $idPedido and id_producto = productos.id and id_producto = $idProducto";
    $res = $con->query($sql);
    $row = $res->fetch_array();
    $cantidadOriginal = $row["sum(cantidad)"];

    if (isset($cantidadOriginal)) {
        // $row = $res->fetch_array();
        // $cantidadOriginal = $row["sum(cantidad)"];
        $cantidadAcumulada = $cantidadOriginal + $cantidad;
        $sql = "UPDATE pedidos_productos SET cantidad = $cantidadAcumulada where id_producto = $idProducto";
        $res = $con->query($sql);
    } else {
        $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad) VALUES ('$idPedido', '$idProducto', '$cantidad')";
        $res = $con->query($sql);
    }
} else {
    $sql = "INSERT INTO pedidos (usuario_n,  id_usuario) VALUES ('$nombre', '$idC')";
    $ingresar = $con->query($sql);
    $sql = "SELECT id from pedidos where id_usuario = $idC and status = 0";
    $res = $con->query($sql);
    $row = $res->fetch_array();
    $idPedido = $row["id"];
    $sql = "select id_producto, sum(cantidad) from pedidos_productos, productos where pedidos_productos.id_pedido = $idPedido and id_producto = productos.id and id_producto = $idProducto";
    $res = $con->query($sql);
    $row = $res->fetch_array();
    $cantidadOriginal = $row["sum(cantidad)"];

    if (isset($cantidadOriginal)) {
        // $row = $res->fetch_array();
        // $cantidadOriginal = $row["sum(cantidad)"];
        $cantidadAcumulada = $cantidadOriginal + $cantidad;
        $sql = "UPDATE pedidos_productos SET cantidad = $cantidadAcumulada where id_producto = $idProducto";
        $res = $con->query($sql);
    } else {
        $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad) VALUES ('$idPedido', '$idProducto', '$cantidad')";
        $res = $con->query($sql);
    }
}

  $sql ="SELECT sum(cantidad) from pedidos_productos, productos where pedidos_productos.id_pedido = $idPedido and id_producto = productos.id";
  $res = $con->query($sql);
  $row = $res->fetch_array();
  $cantidadTotal = $row["sum(cantidad)"];
    echo $cantidadTotal;


?>