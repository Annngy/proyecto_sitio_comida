
<?php
include_once "funciones.php";
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}
include_once "funciones.php";
if (!isset($_POST["id_pedido"])) {
    exit("No hay pedido");
}
echo "pedido".$_POST["id_pedido"];
echo "prod".$_POST["id_producto"];
quitarProductoDelCarrito($_POST["id_pedido"],$_POST["id_producto"]);
# Saber si redireccionamos a tienda o al carrito, esto es porque
# llamamos a este archivo desde la tienda y desde el carrito
if (isset($_POST["redireccionar_carrito"])) {
    header("Location: ver_pedido.php");
  } else {
    header("Location: detallePedido.php");
  }
