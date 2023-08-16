<?php
include_once "funciones.php";
if (!isset($_POST["id_producto"])) {
    exit("No hay idProducto");
}

include_once "funciones.php";
if (!isset($_POST["id_pedido"])) {
    exit("No hay idPedido");
}

include_once "funciones.php";
if (!isset($_POST["comentarios"])) {
    exit("No hay comentario");
}

insertarDetallePedido($_POST["id_pedido"],$_POST["id_producto"],$_POST["comentarios"]);
header("Location: productos.php");
?>
