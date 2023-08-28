<?php
$para = $_REQUEST['correo'];
// $mensaje = $_REQUEST['comentarios'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$mensaje = "Mensaje de Librerias Tomasino: Para mas informes llame al 3312834126";

$nombreCompleto = $nombre. ' '.$apellidos;

$titulo    = 'Agradecemos su interes '.$nombreCompleto;
// $cabeceras = 'From: webmaster@example.com' . "\r\n" .
//     'Reply-To: webmaster@example.com' . "\r\n" .
//     'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje);
header("Location: index.php");
?>