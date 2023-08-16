<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../index.php');
} else {
    if ($_SESSION['rol'] != 2) {
        header('location: ../index.php');
    }
}

$rol = $_SESSION['rol'];
$Id = $_SESSION['id'];
$Us = $_SESSION['nombre'];
$email = $_SESSION['correo'];
$Psw = $_SESSION['password'];
$status = $_SESSION['status_usuario'];


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pedido</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
</head>

<body>
<nav class="navbar is-warning" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" >
            <img src="../includes/encabezado.jpg" alt="Tienda de comida rápida" class="img-fluid"> </a>
            <button class="navbar-burger is-warning button" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="navbar-menu">
            
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="productos.php" class="button is-success">
                            <strong>Ver Menú &nbsp;</strong>
                        </a>
                    </div>
                </div>
                <div class="navbar-item">
                   
                </div>
            </div>

            </div>
        </div>
    </nav>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const boton = document.querySelector(".navbar-burger");
            const menu = document.querySelector(".navbar-menu");
            boton.onclick = () => {
                menu.classList.toggle("is-active");
                boton.classList.toggle("is-active");
            };
        });
    </script>

<?php
include_once "funciones.php";
$IdPedido = obtenerUltimoIdPedido();
foreach ($IdPedido as $idPedido ) {
$productos = obtenerPedidosEnCarrito($idPedido->id);

if (count($productos) <= 0) {

?>
    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Todavía no hay productos
                </h1>
                <h2 class="subtitle">
                    Visita el menú para agregar productos a tu pedido
                </h2>
                <a href="productos.php" class="button is-warning">Ver Menú</a>
            </div>
        </div>
    </section>
<?php } else { ?>
    <div class="columns">
        <div class="column">
            <h2 class="is-size-2">Pedido</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Comentarios</th>
                        <th>Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($productos as $producto) {
                        $total += $producto->Precio;
                    ?>
                        <tr>
                            <td><?php echo $producto->SKU ?></td>
                            <td><?php echo $producto->Nombre ?></td>
                            <td>$<?php echo number_format($producto->Precio, 2) ?></td>
                            <td><?php echo $producto->Comentario ?></td>
                            <td>
                            
                                <form action="eliminar_pedido.php" method="post">
                                    <input type="hidden" name="id_pedido" value="<?php echo $idPedido->id ?>">
                                    <input type="hidden" name="id_producto" value="<?php echo $producto->SKU ?>">
                                    <input type="hidden" name="redireccionar_carrito">
                                    <button class="button is-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        <?php } ?>
                        </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                        <td colspan="2" class="is-size-4">
                            $<?php echo number_format($total, 2) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <form action="termina_pedido.php" method="post">
                                    <input type="hidden" name="total" value="<?php echo $total ?>">
                                    <input type="hidden" name="id_pedido" value="<?php echo $idPedido->id ?>">
                                    <input type="hidden" name="id_mesero" value="<?php echo $Id ?>">
                                    <button   class="button is-success is-large"><i class="fa fa-check"></i>&nbsp;Terminar pedido</a>
                                    </button>
                                </form>
                                
          
        </div>
    </div>
<?php } ?>
<?php } ?>
</body>


</html>