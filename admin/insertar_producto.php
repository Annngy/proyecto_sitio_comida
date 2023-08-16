<?php
include_once "../mesero/funciones.php";

if (!isset($_POST["nombre_producto"])) {
    exit("No hay nombre_producto");
}
if (!isset($_POST["categoria"])) {
    exit("No hay categoria");
}
if (!isset($_POST["descripcion"])) {
    exit("No hay descripcion");
}
if (!isset($_POST["precio"])) {
    exit("No hay precio");
}
if (!isset($_POST["stock"])) {
    exit("No hay stock");
}



insertarProducto($_POST["nombre_producto"],$_POST["descripcion"],$_POST["precio"],
$_POST["stock"],$_POST["categoria"]);

header("Location: producto.php");