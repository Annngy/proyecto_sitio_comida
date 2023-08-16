
<?php
include_once "funciones.php";
if (!isset($_POST["status"])) {
    exit("No hay status");
}
include_once "funciones.php";
if (!isset($_POST["id_pedido"])) {
    exit("No hay id_pedido");
}

actualizaStatuspedido($_POST["status"],$_POST["id_pedido"]);
header("Location: detallePedido.php");
