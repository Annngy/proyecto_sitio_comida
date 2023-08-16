<?php

include_once "funciones.php";

if (!isset($_POST["total"])) {
    exit("No hay total");
}
if (!isset($_POST["id_pedido"])) {
    exit("No hay total");
}

if (!isset($_POST["id_mesero"])) {
    exit("No hay id_mesero");
}


insertarVenta($_POST["id_mesero"],$_POST["total"]);

$productos = obtenerPedidosEnCarrito($_POST["id_pedido"]);
foreach ($productos as $producto ) {

    insertarDetalleventa($producto->SKU,$producto->Precio);

}
header("Location: index.php");
