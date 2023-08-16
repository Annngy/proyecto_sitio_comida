<?php
include_once "../mesero/funciones.php";
if (!isset($_POST["sku"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["nombre_producto"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["categoria"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["descripcion"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["precio"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["stock"])) {
    exit("No hay id_producto");
}
echo $_POST["categoria"];
actualizarProducto($_POST["nombre_producto"],$_POST["categoria"],$_POST["descripcion"],$_POST["precio"],$_POST["stock"],$_POST["sku"],);


    header("Location: producto.php");