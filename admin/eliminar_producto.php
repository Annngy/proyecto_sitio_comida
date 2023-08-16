<?php
include_once "../mesero/funciones.php";
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}
echo "prod".$_POST["id_producto"];
eliminarProducto($_POST["id_producto"]);
# Saber si redireccionamos a tienda o al carrito, esto es porque
# llamamos a este archivo desde la tienda y desde el carrito

    header("Location: producto.php");